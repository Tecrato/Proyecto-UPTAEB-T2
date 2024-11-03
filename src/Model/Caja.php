<?php
    namespace Shtechnologyx\Pt3\Model;
    use PDO;

    class Caja extends Db_base{

        private $id;
        private $id_usuario;
        private $monto_inicial;
        private $monto_final;
        private $estado;
        private $between_fecha;
        private $like_nombre_usuario;

        function __construct($id = null, $id_usuario = null, $monto_inicial = null, $monto_final = null, $estado = null, $between_fecha = null, $like_nombre_usuario = null){
            $this->id = $id;
            $this->id_usuario = $id_usuario;
            $this->monto_inicial = $monto_inicial;
            $this->monto_final = $monto_final;
            $this->estado = $estado;
            $this->between_fecha = $between_fecha;
            $this->like_nombre_usuario = $like_nombre_usuario;
            Db_base::__construct();
            $this->tabla = "caja";
            $this->add_variables([
                "a.id" => $this->id,
                "a.id_usuario" => $this->id_usuario,
                "a.monto_inicial" => $this->monto_inicial,
                "a.monto_final" => $this->monto_final,
                "a.estado" => $this->estado
            ]);
            $this->add_variables_like([
                "b.nombre" => $this->like_nombre_usuario
            ]);
            $this->add_variables_interval([
                "a.fecha" => $this->between_fecha
            ]);
            $this->select_query = "
                a.id,
                a.id_usuario,
                b.nombre nombre_usuario,
                a.monto_inicial,
                a.monto_final,
                a.estado,
                a.fecha,
                a.fecha_cierre,
                a.total_ventas,
                (SELECT SUM(rv.monto_final) FROM registro_ventas rv WHERE rv.id_caja=a.id) as total_cierre,
                a.monto_credito
            ";
            $this->joins = "
                INNER JOIN usuarios b ON b.id = a.id_usuario
            ";
        }

        function abrir(){
            $query = $this->conn->prepare("INSERT INTO caja(id_usuario,monto_inicial,monto_final,estado) VALUES(:id_usuario, :monto_inicial, 0, 0)");
            $query->bindValue(':id_usuario', $this->id_usuario, PDO::PARAM_INT);
            $query->bindValue(':monto_inicial', $this->monto_inicial);
            $query->execute();
        }

        function set_id($id){
            $this->id = $id;
        }

        function set_monto_inicial($monto){
            $this->monto_inicial = $monto;
        }

        function set_monto_final($monto){
            $this->monto_final = $monto;
        }

        function set_estado($estado){
            $this->estado = $estado;
        }

        function get_id(){
            return $this->id;
        }

        function get_monto_inicial(){
            return $this->monto_inicial;
        }

        function get_monto_final(){
            return $this->monto_final;
        }

        function get_estado(){
            return $this->estado;
        }

        function cerrar(){

            $caja = new Caja(id: $this->id, estado: 0);
            $caja = $this->search()[0];
            if (count($caja) == 0) {
                return [];
            }
            $stmt = $this->conn->prepare('CALL AsignarTotalVentasDia(:id)');
            $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);
            $stmt->execute();
            // $query = $this->conn->prepare('UPDATE caja SET monto_final=:mf, estado=0 WHERE id = :id');
            // $query->bindValue(':id',$caja->id);
            // $query->bindValue(':mf',$this->monto_final);
            // $query->execute();
            // $this->add_bitacora($this->id_usuario,"Caja","Cerrar","Caja cerrada");
        }

        function totalMetodosPago(){
            $consulta = $this->conn->prepare('SELECT 
                                            mp.nombre AS nombre,
                                            COALESCE(SUM(sub.monto), 0) AS monto
                                            FROM metodo_pago mp
                                            LEFT JOIN (SELECT p.id_metodo_pago,p.monto
                                            FROM pagos p
                                            JOIN registro_ventas rv ON p.id_venta = rv.id
                                            WHERE rv.id_caja = :id) sub ON mp.id = sub.id_metodo_pago
                                            GROUP BY mp.nombre');
            $consulta->bindValue(':id', $this->id, PDO::PARAM_INT);
            $consulta->execute();
            return $consulta->fetchAll();
        }
        function pagosPorDivisa(){
            $consulta = $this->conn->prepare('SELECT 
                                                c.nombre AS nombre,
                                                c.apellido AS apellido,
                                                p.fecha AS fechaPago,
                                                rv.id AS idFactura,
                                                p.monto AS Monto,
                                                mp.nombre AS Metodo_Pago,
                                                (SELECT 
                                                    SUM(p.monto)
                                                FROM pagos p
                                                JOIN registro_ventas rv ON p.id_venta = rv.id
                                                JOIN metodo_pago mp ON p.id_metodo_pago = mp.id
                                                WHERE rv.id_caja = :id 
                                                AND mp.nombre = "divisa") AS totalRecaudado
                                            FROM pagos p
                                            JOIN registro_ventas rv ON p.id_venta = rv.id
                                            JOIN clientes c ON rv.id_cliente = c.id
                                            JOIN metodo_pago mp ON p.id_metodo_pago = mp.id
                                            WHERE rv.id_caja = :id 
                                            AND mp.nombre = "divisa"');
            $consulta->bindValue(':id', $this->id, PDO::PARAM_INT);
            $consulta->execute();
            return $consulta->fetchAll();
        }
        function pagosPorTransferencia(){
            $consulta = $this->conn->prepare('SELECT 
                                                c.nombre AS nombre,
                                                c.apellido AS apellido,
                                                p.fecha AS fechaPago,
                                                rv.id AS idFactura,
                                                p.monto AS Monto,
                                                mp.nombre AS Metodo_Pago,
                                                (SELECT 
                                                    SUM(p.monto)
                                                FROM pagos p
                                                JOIN registro_ventas rv ON p.id_venta = rv.id
                                                JOIN metodo_pago mp ON p.id_metodo_pago = mp.id
                                                WHERE rv.id_caja = :id 
                                                AND mp.nombre = "transferencia") AS totalRecaudado
                                            FROM pagos p
                                            JOIN registro_ventas rv ON p.id_venta = rv.id
                                            JOIN clientes c ON rv.id_cliente = c.id
                                            JOIN metodo_pago mp ON p.id_metodo_pago = mp.id
                                            WHERE rv.id_caja = :id 
                                            AND mp.nombre = "transferencia"');
            $consulta->bindValue(':id', $this->id, PDO::PARAM_INT);
            $consulta->execute();
            return $consulta->fetchAll();
        }
        function pagosPorEfectivo(){
            $consulta = $this->conn->prepare('SELECT 
                                                c.nombre AS nombre,
                                                c.apellido AS apellido,
                                                p.fecha AS fechaPago,
                                                rv.id AS idFactura,
                                                p.monto AS Monto,
                                                mp.nombre AS Metodo_Pago,
                                                (SELECT 
                                                    SUM(p.monto)
                                                FROM pagos p
                                                JOIN registro_ventas rv ON p.id_venta = rv.id
                                                JOIN metodo_pago mp ON p.id_metodo_pago = mp.id
                                                WHERE rv.id_caja = :id 
                                                AND mp.nombre = "efectivo") AS totalRecaudado
                                            FROM pagos p
                                            JOIN registro_ventas rv ON p.id_venta = rv.id
                                            JOIN clientes c ON rv.id_cliente = c.id
                                            JOIN metodo_pago mp ON p.id_metodo_pago = mp.id
                                            WHERE rv.id_caja = :id 
                                            AND mp.nombre = "efectivo"');
            $consulta->bindValue(':id', $this->id, PDO::PARAM_INT);
            $consulta->execute();
            return $consulta->fetchAll();
        }
        function totalRecaudado(){
            $consulta = $this->conn->prepare('SELECT 
                                                (SELECT 
                                                    SUM(p.monto)
                                                FROM pagos p
                                                JOIN registro_ventas rv ON p.id_venta = rv.id
                                                JOIN metodo_pago mp ON p.id_metodo_pago = mp.id
                                                WHERE rv.id_caja = :id 
                                                AND mp.nombre = "transferencia") AS totalRecaudadoTransferencia,
                                                
                                                (SELECT 
                                                    SUM(p.monto)
                                                FROM pagos p
                                                JOIN registro_ventas rv ON p.id_venta = rv.id
                                                JOIN metodo_pago mp ON p.id_metodo_pago = mp.id
                                                WHERE rv.id_caja = :id 
                                                AND mp.nombre = "divisa") AS totalRecaudadoDivisa,
                                                
                                                (SELECT 
                                                    SUM(p.monto)
                                                FROM pagos p
                                                JOIN registro_ventas rv ON p.id_venta = rv.id
                                                JOIN metodo_pago mp ON p.id_metodo_pago = mp.id
                                                WHERE rv.id_caja = :id 
                                                AND mp.nombre = "efectivo") AS totalRecaudadoEfectivo
                                            FROM pagos p
                                            LIMIT 1;');
            $consulta->bindValue(':id', $this->id, PDO::PARAM_INT);
            $consulta->execute();
            return $consulta->fetchAll();
        }
        
}
