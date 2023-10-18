<?php
	class Registro_ventas extends DB {
		function search($id=null,$order='id ASC'){
			$query = "SELECT * FROM registro_ventas";
			if ($id) {
				$query = $query . " WHERE id=$id";
			}
			$query = $query . " ORDER BY '$order'";
			return $this->conn->query($query);
		}
		function agregar($datos){
			
			$query = "INSERT INTO registro_ventas VALUES(null,".$datos['total'].",'".$datos['metodo']."','".$datos['fecha']."','".$datos['cliente']."','".$datos['vendedor']."')";
			$this->conn->query($query);
			
			$registro = $this->search(order:'id DESC')->fetch_assoc();

			$clase_f = new Factura();
			$clase_l = new Lote();
			for ($i=0; $i < count($datos['detalles']); $i++) { 
				$lista = $datos['detalles'][$i];
				$clase_f->agregar($registro['id'],$lista['id'],$lista['cantidad'],$lista['precio']);
			}
		}
	}
?>