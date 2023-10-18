<?php
	class Factura extends DB {
		function search($id=null,$id_registro=null,$order='id DESC'){
			$query = "SELECT * FROM factura";
			if ($id) {
				$query = $query . " WHERE id=$id";
			}
			if ($id_producto) {
				$query = $query . " WHERE registro_ventas=$id_registro";
			}
			$query = $query . " ORDER BY '$order'";

			return $this->conn->query($query);
		}

		function agregar($registro,$id_producto,$cantidad, $vendedor){
            $query = "INSERT INTO factura VALUES($registro, $id_producto, $cantidad, $vendedor)";
            
            $this->conn->query($query);
		}
        function borrar($id_registro=False) {

            if ($id_registro){
                $query = "DELETE FROM lotes WHERE id_registro_ventas=$id_registro";
            }
            else {
            	throw new Exception("Error, debe pasar el id del registro asociado", 1);
            	
            }
            
            $this->conn->query($query);
        }
	}

?>