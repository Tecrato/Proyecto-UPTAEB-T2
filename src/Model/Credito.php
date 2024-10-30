<?php
    namespace Shtechnologyx\Pt3\Model;
    use PDO;

    class Credito extends Db_base{
       private $id;
       private $id_rv;
       private $fecha_limite;
       private $monto_final;
       private $status;
       private $like_nombre_cliente;
       private $like_nombre_usuario;
       private $between_fecha;
       
       function __construct($id=null,$id_rv=null,$fecha_limite=null,$monto_final=null,$status=null,$like_nombre_cliente=null,$like_nombre_usuario=null, $between_fecha=null){
            $this->id = $id;
            $this->id_rv = $id_rv;
            $this->fecha_limite = $fecha_limite;
            $this->monto_final = $monto_final;
            $this->status = $status;
            $this->like_nombre_cliente = $like_nombre_cliente;
            $this->like_nombre_usuario = $like_nombre_usuario;
            $this->between_fecha = $between_fecha;
            Db_base::__construct();
            $this->tabla = "credito";
            $this->add_variables([
                "a.id" => $this->id,
                "a.id_rv" => $this->id_rv,
                "a.fecha_limite" => $this->fecha_limite,
                "a.monto_final" => $this->monto_final,
                "a.status" => $this->status
            ]);
            $this->add_variables_like([
                "c.nombre" => $this->like_nombre_cliente,
                "u.nombre" => $this->like_nombre_usuario
            ]);
            $this->add_variables_interval([
                "b.fecha" => $this->between_fecha
            ]);
            $this->select_query = "
            a.id,
            b.id id_rv,
            b.fecha fecha_inicio,
            a.fecha_limite,
            a.monto_final,
            c.nombre nombre_cliente,
            c.apellido apellido_cliente,
            a.status,
            u.nombre nombre_usuario
            ";
            $this->joins = "
            INNER JOIN registro_ventas b ON a.id_rv = b.id
            INNER JOIN caja j ON b.id_caja = j.id
            INNER JOIN usuarios u ON j.id_usuario = u.id
            INNER JOIN clientes c ON b.id_cliente = c.id
            ";
        }

        function desactivar(){
            $query = $this->conn->prepare('UPDATE credito SET active=0 WHERE id=:id');
            $query->bindParam(':id',$this->id);
            $query->execute();
        }


        function pagar($pagos){
            $query = $this->conn->prepare("UPDATE credito SET status=0 WHERE id_rv=:id");
            $query->bindParam(':id',$this->id_rv);
            $query->execute();
            
            for ($i = 0; $i < count($pagos); $i++) {
                $lista = $pagos[$i];
                $clase_f = new Pago(null, $this->id_rv, $lista["metodo"], $lista['monto']);
                $clase_f->agregar();
            }
        }
    }
?>