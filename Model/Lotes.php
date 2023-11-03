<?php
	class Lote extends DB{
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
			$query = $this->conn->prepare("INSERT INTO lotes VALUES(null, ?, ?, ?,?, ?, ?, ?)");
			$query->bindParam(1,$this->id_producto);
			$query->bindParam(2,$this->id_proveedor);
			$query->bindParam(3,$this->cantidad);
			$query->bindParam(4,$this->fecha_c);
			$query->bindParam(5,$this->fecha_v);
			$query->bindParam(6,$this->precio_compra);
			$query->bindParam(7,$this->cantidad);

			$query->execute();
		}
		function search($id = null, $id_producto = null, $order = 'id DESC'){
			$query = "SELECT * FROM lotes";
			if ($id) {
				$query = $query . " WHERE id=$id";
			}
			if ($id_producto) {
				$query = $query . " WHERE id_producto=$id_producto";
			}
			$query = $query . " ORDER BY $order";

			return $this->conn->query($query)->fetchAll();
		}

		function search_with_producto_and_proveedor($id_producto, $id_proveedor){
			$query = "SELECT * FROM lotes WHERE id_producto=$id_producto AND id_proveedor=$id_proveedor";
			return $this->conn->query($query)->fetchAll();
		}

		function search_proveedor_from_product($id_producto)
		{
			$query = "SELECT id_proveedor, (SELECT razon_social FROM proveedores WHERE lotes.id_proveedor = id) AS proveedor FROM lotes WHERE id_producto = $id_producto GROUP BY id_proveedor";
			return $this->conn->query($query)->fetchAll();
		}

		function search_modal_details($id_producto){
			$query = $this->conn->query("SELECT imagen,nombre,marca,(SELECT nombre FROM categoria WHERE productos.id_categoria = id) AS categoria,(SELECT SUM(existencia) FROM lotes WHERE productos.id = id_producto GROUP BY id_producto) AS existencia,precio_venta FROM productos WHERE id = $id_producto");
			return $query->fetchAll();
		}
		function descontar(){

			$lotes = $this->search(null, $this->id_producto, 'fecha_vencimiento ASC');

			for ($i = 0; $this->cantidad > 0; $i++) {
				$lote = $lotes[$i];
				if ($lote['existencia'] > $this->cantidad) {
					$query = "UPDATE lotes SET existencia=" . $lote['existencia'] - $this->cantidad . " WHERE id=" . $lote['id'];
					$this->conn->query($query);
					$this->cantidad = 0;
				} else {
					$query = "UPDATE lotes SET existencia=0 WHERE id=" . $lote['id'];
					$this->conn->query($query);
					$this->cantidad -= $lote['existencia'];
				}
			}
		}
		function borrar(){

			if ($this->id_proveedor != null) {
				$query = $this->conn->prepare("DELETE FROM lotes WHERE id_proveedor=:id_proveedor");
				$query->bindParam(':id_proveedor',$this->id_proveedor, PDO::PARAM_INT);
			} elseif ($this->id_producto != null) {
				$query = $this->conn->prepare("DELETE FROM lotes WHERE id_producto=:id_producto");
				$query->bindParam(':id_producto',$this->id_producto, PDO::PARAM_INT);
			} else {
				throw new Exception("Error, debe pasar el id de un proveedor o de un producto", 1);
			}

			$query->execute();
		}
}
