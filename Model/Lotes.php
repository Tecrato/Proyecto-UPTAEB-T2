<?php
	class Lote extends DB {
		// public function search_for_producto($id_producto){
		// 	$query = "SELECT * FROM lotes WHERE id_producto="$id_producto;
		// 	return $this->conn->query($query);
		// }
		// public function search_for_proveedor($id_proveedor){
		// 	$query = "SELECT * FROM lotes WHERE id_proveedor="$id_proveedor;
		// 	return $this->conn->query($query);
		// };;;;;

		public function search_with_producto_and_proveedor($id_producto,$id_proveedor){
			$query = "SELECT * FROM lotes WHERE id_producto=$id_producto AND id_proveedor=$id_proveedor";
			return $this->conn->query($query);
		}
	}

?>