<?php
	class Registro_ventas extends DB {
        private $id;
        private $monto_final;
        private $id_cliente;
        private $id_caja;
        private $IVA;
        private $active;

        function __construct($id=null, $monto_final=null,$id_cliente=null,$id_caja=null,$IVA=null,$active=null){
            $this->id = $id;
            $this->monto_final = $monto_final;
            $this->id_cliente = $id_cliente;
            $this->id_caja = $id_caja;
            $this->IVA = $IVA;
            $this->active = $active;
            DB::__construct();

        }
		function search($n=0,$limite=9,$order='id DESC'){
			$query = "SELECT 
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
            FROM registro_ventas a 
            INNER JOIN clientes b ON b.id = a.id_cliente
            INNER JOIN caja c ON c.id = a.id_caja
            INNER JOIN usuarios d ON d.id = c.id_usuario
            WHERE 1";

            $lista = [];
            
			if ($this->id != null){
				array_push($lista,'id');
			}
			if ($this->active != null){
				array_push($lista, 'active');
			}
			if ($lista) {
				foreach ($lista as $e){
					$query .= ' AND a.'.$e.'=:'.$e;
				}
			}

			$query .= " ORDER BY a.$order  LIMIT :l OFFSET :n";
            $query = $this->conn->prepare($query);

            $n = $n*$limite;
            $query->bindParam(':l',$limite, PDO::PARAM_INT);
            $query->bindParam(':n',$n, PDO::PARAM_INT);

            if ($this->id != null){
                $query->bindParam(':id',$this->id, PDO::PARAM_INT);
            }
            if ($this->active != null){
                $query->bindParam(':active',$this->active, PDO::PARAM_INT);
            }

            $query->execute();
            return $query->fetchAll();
		}
        function agregar($usuario, $datos, $pagos, $credito, $fecha_inicio, $fecha_vencimiento,$monto_dolar) {
            try {

                $this->conn->beginTransaction();
                for ($i = 0; $i < count($datos); $i++) {
                    $lista = $datos[$i];
                    $clase_l = new Entrada(null, $lista->id_product, cantidad: $lista->cantidad);
                    if ($clase_l->descontar() != 1){
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
                    $clase5->agregar($usuario);
                }
                else {
                    for ($i = 0; $i < count($pagos); $i++) {
                        $lista = $pagos[$i];
                        $clase_f = new Pago(null, $registro['id'], $lista->metodo, $lista->monto);
                        $clase_f->agregar($usuario);
                    }
                }

                $this->add_bitacora($usuario, "registrar_ventas", "agregar", "se agrego una venta");
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


        function COUNT(){
            $query = $this->conn->prepare("SELECT COUNT(*) as 'total' FROM registro_ventas");
            $query->execute();
            return $query->fetch()['total'];
        }
	}
?>