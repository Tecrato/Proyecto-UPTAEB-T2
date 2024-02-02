<?php
	class Entrada extends DB{
        private $id;
        private $id_producto;
        private $id_proveedor;
        private $cantidad;
        private $fecha_compra;
        private $fecha_vencimiento;
        private $precio_compra;
        private $active;

        function __construct($id=null, $id_producto=null,$id_proveedor=null,$cantidad=null,$fecha_compra=null,$fecha_vencimiento=null,$precio_compra=null,$active=1){
            $this->id = $id;
            $this->id_producto = $id_producto;
            $this->id_proveedor = $id_proveedor;
            $this->cantidad = $cantidad;
            $this->fecha_compra = $fecha_compra;
            $this->fecha_vencimiento = $fecha_vencimiento;
            $this->precio_compra = $precio_compra;
            $this->active = $active;
            DB::__construct();
        }

		function agregar(){
			$query = $this->conn->prepare("INSERT INTO entradas VALUES(null, :id1, :id2, :cantidad, :fecha_compra, :fecha_vencimiento, :precio_compra, :cantidad, 1)");

			$query->bindParam(':id1',$this->id_producto);
			$query->bindParam(':id2',$this->id_proveedor);
			$query->bindParam(':cantidad',$this->cantidad);
			$query->bindParam(':fecha_compra',$this->fecha_compra);
			$query->bindParam(':fecha_vencimiento',$this->fecha_vencimiento);
			$query->bindParam(':precio_compra',$this->precio_compra);
			$query->bindParam(':cantidad',$this->cantidad);

			$query->execute();
		}

		function descontar(){

			$entradas = $this->search(0,10000,order:' fecha_vencimiento ASC');

			for ($i = 0; $this->cantidad >= 1; $i++) {
				$entrada = $entradas[$i];
				if ($entrada['existencia'] > $this->cantidad) {
					$query = "UPDATE entradas SET existencia=" . $entrada['existencia'] - $this->cantidad . " WHERE id=" . $entrada['id'];
					$this->conn->query($query);
					$this->cantidad = 0;
				} else {
					$query = "UPDATE entradas SET existencia=0 WHERE id=" . $entrada['id'];
					$this->conn->query($query);
					$this->cantidad -= $entrada['existencia'];
				}
			}
		}

		function desactivar() {
			$query = $this->conn->prepare('DELETE FROM productos WHERE id=:id');

			$query->bindParam(':id',$this->id);
			$query->execute();
		}

		function search($n=0,$limite=9, $order = ' id DESC '){
            $query = "SELECT 
                    a.id,
                    a.id_producto,
                    b.nombre producto,
                    a.id_proveedor,
                    c.nombre proveedor,
                    a.cantidad,
                    a.fecha_compra,
                    a.fecha_vencimiento,
                    a.precio_compra,
                    a.existencia
                    FROM entradas a 
                    INNER JOIN productos b ON b.id = a.id_producto
                    INNER JOIN proveedores c ON c.id = a.id_proveedor
                    WHERE a.active=:active ";

			$lista = [];

            if ($this->id){
            	array_push($lista,'id');
            }
            if ($this->id_producto){
                array_push($lista, 'id_producto');
            }
            if ($this->id_proveedor){
                array_push($lista, 'id_proveedor');
            }
            if ($lista) {
            	foreach ($lista as $e){
            		$query .= ' AND '.$e.'=:'.$e;
            	}
            }


            $n = $n*$limite;
			$query = $query . " ORDER BY $order ";
			$query = $query . " LIMIT :l OFFSET :n ";


            $consulta = $this->conn->prepare($query);

            $consulta->bindParam(':l',$limite, PDO::PARAM_INT);
            $consulta->bindParam(':n',$n, PDO::PARAM_INT);
            $consulta->bindParam(':active',$this->active, PDO::PARAM_INT);

            if ($this->id){
                $consulta->bindParam(':id',$this->id, PDO::PARAM_INT);
            }
			if ($this->id_producto) {
                $consulta->bindParam(':id_producto',$this->id_producto, PDO::PARAM_INT);
			}
			if ($this->id_proveedor) {
                $consulta->bindParam(':id_proveedor',$this->id_proveedor, PDO::PARAM_INT);
			}

            $consulta->execute();
            return $consulta->fetchAll();
		}

		function search_proveedor_from_product(){
			$query = $this->conn->prepare("SELECT id_proveedor, (SELECT razon_social FROM proveedores p WHERE p.id = entradas.id_proveedor) AS proveedor FROM entradas WHERE id_producto=:id GROUP BY id_proveedor LIMIT 50");

			$query->bindParam(':id',$this->id_producto);
			$query->execute();
			
			return $query->fetchAll();
		}
        function COUNT(){
            $query = $this->conn->prepare("SELECT COUNT(*) as 'total' FROM entradas WHERE active=:active");
			$query->bindParam(':active',$this->active, PDO::PARAM_INT);
            $query->execute();
            return $query->fetch()['total'];
        }
}
