<?php
	class Registro_ventas extends DB {
		function search($id=null,$order='id ASC'){
			$query = "SELECT * FROM registro_ventas";
			if ($id) {
				$query = $query . " WHERE id=$id";
			}
			$query = $query . " ORDER BY $order";
			return $this->conn->query($query);
		}
		function agregar($datos){
			
			$query = "INSERT INTO registro_ventas (monto_final,`metodo de pago`, id_cliente, id_usuario, IVA) VALUES(".$datos->pTotal.",'".$datos->TPago."',".$datos->idClient.",'".$datos->idCasher."',".$datos->tIva.")";
			$this->conn->query($query);
			
			$registro = $this->search(order:'id DESC')->fetch_assoc();

			$clase_f = new Factura();
			$clase_l = new Lote();
			for ($i=0; $i < count($datos->details); $i++) { 
				$lista = $datos->details[$i];
				$clase_l->descontar($lista->idProduct,$lista->cantidad);
				$clase_f->agregar($registro['id'],$lista->idProduct,$lista->cantidad,$lista->precioT);
			}
		}
	}
?>