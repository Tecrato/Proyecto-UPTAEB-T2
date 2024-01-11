<?php
	class Entrada extends DB{
        private $id;
        private $id_producto;
        private $id_proveedor;
        private $cantidad;
        private $fecha_c;
        private $fecha_v;
        private $precio_compra;

        function __construct($id=null, $id_producto=null,$id_proveedor=null,$cantidad=null,$fecha_c=null,$fecha_v=null,$precio_compra=null){
            $this->id = $id;
            $this->id_producto = $id_producto;
            $this->id_proveedor = $id_proveedor;
            $this->cantidad = $cantidad;
            $this->fecha_c = $fecha_c;
            $this->fecha_v = $fecha_v;
            $this->precio_compra = $precio_compra;
            DB::__construct();
        }

		function agregar(){
			$query = $this->conn->prepare("INSERT INTO entradas VALUES(null, :id1, :id2, :cantidad, :fecha_c, :fecha_v, :precio_compra, :cantidad)");

			$query->bindParam(':id1',$this->id_producto);
			$query->bindParam(':id2',$this->id_proveedor);
			$query->bindParam(':cantidad',$this->cantidad);
			$query->bindParam(':fecha_c',$this->fecha_c);
			$query->bindParam(':fecha_v',$this->fecha_v);
			$query->bindParam(':precio_compra',$this->precio_compra);
			$query->bindParam(':cantidad',$this->cantidad);

			$query->execute();
		}
		function descontar(){

			$lotes = $this->search(null, $this->id_producto, 'fecha_vencimiento ASC');

			for ($i = 0; $this->cantidad > 0; $i++) {
				$lote = $lotes[$i];
				print_r($this->cantidad);
				print_r($lote.'\n');
				if ($lote['existencia'] > $this->cantidad) {
					$query = "UPDATE entradas SET existencia=" . $lote['existencia'] - $this->cantidad . " WHERE id=" . $lote['id'];
					$this->conn->query($query);
					$this->cantidad = 0;
				} else {
					$query = "UPDATE entradas SET existencia=0 WHERE id=" . $lote['id'];
					$this->conn->query($query);
					$this->cantidad -= $lote['existencia'];
				}
			}
		}
		function borrar(){

			if ($this->id_proveedor != null) {
				$query = $this->conn->prepare("DELETE FROM entradas WHERE id_proveedor=:id_proveedor");
				$query->bindParam(':id_proveedor',$this->id_proveedor, PDO::PARAM_INT);
			} elseif ($this->id_producto != null) {
				$query = $this->conn->prepare("DELETE FROM entradas WHERE id_producto=:id_producto");
				$query->bindParam(':id_producto',$this->id_producto, PDO::PARAM_INT);
			} else {
				throw new Exception("Error, debe pasar el id de un proveedor o de un producto", 1);
			}

			$query->execute();
		}
		function search($n=0,$limite=9, $order = 'id DESC'){
			$query = "SELECT * FROM entradas";

            if ($this->id != null){
                $query = $query." WHERE id=:id";
            }
			elseif ($this->id_producto != null) {
				$query = $query . " WHERE id_producto=:id_producto";
			}
            $n = $n*$limite;
			$query = $query . " ORDER BY $order";
            $query = $query . " LIMIT :l OFFSET :n";


            $consulta = $this->conn->prepare($query);

            $consulta->bindParam(':l',$limite, PDO::PARAM_INT);
            $consulta->bindParam(':n',$n, PDO::PARAM_INT);
            if ($this->id != null){
                $consulta->bindParam(':id',$this->id, PDO::PARAM_INT);
            }
			elseif ($this->id_producto != null) {
                $consulta->bindParam(':id_producto',$this->id_producto, PDO::PARAM_INT);
			}

            $consulta->execute();
            return $consulta->fetchAll();
		}

		function search_with_producto_and_proveedor(){
			$query = $this->conn->prepare("SELECT * FROM entradas WHERE id_producto=:id1 AND id_proveedor=:id2");

			$query->bindParam(':id1',$this->id_producto);
			$query->bindParam(':id2',$this->id_proveedor);

			$query->execute();
			
			return $query->fetchAll();
		}

		function search_proveedor_from_product()
		{
			$query = $this->conn->prepare("SELECT id_proveedor, (SELECT razon_social FROM proveedores WHERE entradas.id_proveedor=:id) AS proveedor FROM entradas WHERE id_producto=:id GROUP BY id_proveedor");

			$query->bindParam(':id',$this->id_producto);
			$query->execute();
			
			return $query->fetchAll();
		}

		function search_modal_details(){
			$query = $this->conn->prepare("SELECT imagen,nombre,marca,(SELECT nombre FROM categoria WHERE productos.id_categoria = id) AS categoria,(SELECT SUM(existencia) FROM entradas WHERE productos.id = :id GROUP BY :id) AS existencia,precio_venta FROM productos WHERE id = :id");

			$query->bindParam(':id',$this->id_producto);
			$query->execute();

			return $query->fetchAll();
		}
}
