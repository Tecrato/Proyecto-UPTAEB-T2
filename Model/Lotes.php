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
		public function agregar($id_producto,$id_proveedor,$cantidad,$fecha_c,$fecha_v,$precio_compra){
            $query = "INSERT INTO lotes VALUES(null, $id_producto, $id_proveedor, $cantidad,'$fecha_c', '$fecha_v', $precio_compra, $cantidad)";
            
            $this->conn->query($query);
		}
        function borrar($id_proveedor=False,$id_producto=False) {

            if ($id_proveedor){
                $query = "DELETE FROM lotes WHERE id_proveedor=$id_proveedor";
            }
            if ($id_producto){
                $query = "DELETE FROM lotes WHERE id_producto=$id_producto";
            }
            else {
            	throw new Exception("Error, debe pasar el id de un proveedor o de un producto", 1);
            	
            }
            
            $this->conn->query($query);
        }
	}

?>