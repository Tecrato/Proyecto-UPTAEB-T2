<?php
	class Registro_ventas extends DB {
		function search($id=null,$order='id ASC'){
			$query = "SELECT * FROM registro_ventas";
			if ($id) {
				$query = $query . " WHERE id=$id";
			}
			$query = $query . " ORDER BY $order";
			return $this->conn->query($query)->fetchAll();
		}
		function agregar($datos){
			
			$query = $this->conn->prepare("INSERT INTO registro_ventas (monto_final,metodo_pago, id_cliente, id_usuario, IVA) VALUES(?,?,?,?,?)");


			$query->bindParam(1,$datos->pTotal);
			$query->bindParam(2,$datos->TPago);
			$query->bindParam(3,$datos->idClient);
			$query->bindParam(4,$datos->idCasher);
			$query->bindParam(5,$datos->tIva);

			$query->execute();
			
			$registro = $this->search(order:'id DESC')[0];
			print_r($registro);

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