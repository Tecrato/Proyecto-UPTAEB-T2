<?php
    namespace Shtechnologyx\Pt3\Model;
	class Registro_ventas extends Db_base{
        private $id;
        private $monto_final;
        private $id_cliente;
        private $id_usuario;
        private $id_caja;
        private $IVA;
        private $active;
        private $like_nombre_cliente;
        private $like_nombre_usuario;

        function __construct($id=null, $monto_final=null,$id_cliente=null,$id_usuario=null,$id_caja=null,$IVA=null,$active=null,$like_nombre_cliente=null,$like_nombre_usuario=null){
            $this->id = $id;
            $this->monto_final = $monto_final;
            $this->id_cliente = $id_cliente;
            $this->id_usuario = $id_usuario;
            $this->id_caja = $id_caja;
            $this->IVA = $IVA;
            $this->active = $active;
            $this->like_nombre_cliente = $like_nombre_cliente;
            $this->like_nombre_usuario = $like_nombre_usuario;
            Db_base::__construct();
            $this->tabla = "registro_ventas";
            $this->add_variables([
                "a.id" => $this->id,
                "a.monto_final" => $this->monto_final,
                "a.id_cliente" => $this->id_cliente,
                "a.id_caja" => $this->id_caja,
                "a.IVA" => $this->IVA,
                "a.active" => $this->active,
                "c.id_usuario" => $this->id_usuario
            ]);
            $this->add_variables_like([
                "b.nombre" => $this->like_nombre_cliente,
                "d.nombre" => $this->like_nombre_usuario
            ]);
            $this->joins = "
                INNER JOIN clientes b ON b.id = a.id_cliente
                INNER JOIN caja c ON c.id = a.id_caja
                INNER JOIN usuarios d ON d.id = c.id_usuario
            ";
            $this->select_query = "
            a.id,
            a.monto_final,
            a.fecha,
            b.nombre cliente_nombre,
            b.apellido cliente_apellido,
            b.documento cliente_documento,
            b.cedula cliente_cedula,
            d.nombre vendedor,
            a.IVA,
            c.id id_caja,
            a.active
            ";
        }
        public function agregar_venta($datos, $pagos, $credito, $fecha_inicio, $fecha_vencimiento,$monto_dolar) : int {
            try {

                $this->conn->beginTransaction();
                for ($i = 0; $i < count($datos); $i++) {
                    $lista = $datos[$i];
                    $clase_l = new Detalle_entrada(null, $lista->id_product);
                    if ($clase_l->descontar($lista->cantidad) != 1){
                        throw new Exception("Algo paso, nose", 1);
                    }
                }
                $this->conn->commit();

                $query = $this->conn->prepare("INSERT INTO registro_ventas (monto_final, id_cliente, id_caja, IVA, active) VALUES(:monto, :id1, :id2, :iva,:active)");
                $query->bindParam(':monto', $this->monto_final);
                $query->bindParam(':id1', $this->id_cliente, PDO::PARAM_INT);
                $query->bindParam(':id2', $this->id_caja, PDO::PARAM_INT);
                $query->bindParam(':iva', $this->IVA, PDO::PARAM_STR);
                $query->bindParam(':active', $this->active, PDO::PARAM_STR);
                $query->execute();


                $registro = $this->search(order: 'id DESC')[0];

                for ($i = 0; $i < count($datos); $i++) {
                    $lista = $datos[$i];
                    $clase_f = new Factura(null, $registro['id'], $lista->id_product, $lista->cantidad, $lista->precio);
                    $clase_f->agregar();
                }

                if ($credito == true) {
                    $clase5 = new Credito(null, $registro['id'], $fecha_vencimiento, $monto_dolar);
                    $clase5->agregar();
                }
                else {
                    for ($i = 0; $i < count($pagos); $i++) {
                        $lista = $pagos[$i];
                        $clase_f = new Pago(null, $registro['id'], $lista->metodo, $lista->monto);
                        $clase_f->agregar();
                    }
                }

                return 1;
            } catch (Exception $e) {
                $this->conn->rollBack();
                return 0;
            }
        }

        function desactivar(){
            $query = $this->conn->prepare("UPDATE registro_ventas SET active=0 WHERE id=:id");
			$query->bindParam(':id',$this->id, PDO::PARAM_INT);

			$query->execute();
        }
	}
?>