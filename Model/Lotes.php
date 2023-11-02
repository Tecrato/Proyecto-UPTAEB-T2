<?php
	class Lote extends DB{

		function agregar($id_producto, $id_proveedor, $cantidad, $fecha_c, $fecha_v, $precio_compra){
			$query = $this->conn->prepare("INSERT INTO lotes VALUES(null, :id_producto, :id_proveedor, :cantidad,:fecha_c, :fecha_v, :precio_compra, :cantidad)");
			$query->bindParam(':id_producto',$id_producto);
			$query->bindParam(':id_proveedor',$id_proveedor);
			$query->bindParam(':cantidad',$cantidad);
			$query->bindParam(':fecha_c',$fecha_c);
			$query->bindParam(':fecha_v',$fecha_v);
			$query->bindParam(':precio_compra',$precio_compra);
			$query->bindParam(':cantidad',$cantidad);

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
		function descontar($id_producto, $cantidad){

			$lotes = $this->search(null, $id_producto, 'fecha_vencimiento ASC');

			for ($i = 0; $cantidad > 0; $i++) {
				$lote = $lotes[$i];
				if ($lote['existencia'] > $cantidad) {
					$query = "UPDATE lotes SET existencia=" . $lote['existencia'] - $cantidad . " WHERE id=" . $lote['id'];
					$this->conn->query($query);
					$cantidad = 0;
				} else {
					$query = "UPDATE lotes SET existencia=0 WHERE id=" . $lote['id'];
					$this->conn->query($query);
					$cantidad -= $lote['existencia'];
				}
			}
		}
		function borrar($id_proveedor = False, $id_producto = False){

			if ($id_proveedor) {
				$query = $this->conn->prepare("DELETE FROM lotes WHERE id_proveedor=:id_proveedor");
				$query->bindParam(':id_proveedor',$id_proveedor);
			} elseif ($id_producto) {
				$query = $this->conn->prepare("DELETE FROM lotes WHERE id_producto=:id_producto");
				$query->bindParam(':id_producto',$id_producto);
			} else {
				throw new Exception("Error, debe pasar el id de un proveedor o de un producto", 1);
			}

			$query->execute();
		}
}
