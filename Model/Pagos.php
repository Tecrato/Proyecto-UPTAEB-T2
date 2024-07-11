<?php
	class Pago extends DB {
		private $id;
		private $id_venta;
		private $id_metodo_pago;
		private $monto;
		function __construct($id=null, $id_venta=null, $id_metodo_pago=null, $monto=null){
			DB::__construct();
			$this->id = $id;
			$this->id_venta = $id_venta;
			$this->id_metodo_pago = $id_metodo_pago;
			$this->monto = $monto;
		}
		
		function search($n=0, $limite=9, $order=' p.id DESC '){
			$query = "SELECT
			p.monto as monto,
			mp.nombre as metodo
			FROM pagos as p
			JOIN metodo_pago as mp ON mp.id=p.id_metodo_pago
			WHERE 1
			"; 
	
			$lista = [];
	
			if ($this->id != null){
				array_push($lista,'id');
			}
			if ($this->id_metodo_pago != null){
				array_push($lista, 'id_metodo_pago');
			}
			if ($this->id_venta != null){
				array_push($lista, 'id_venta');
			}
			if ($lista) {
				foreach ($lista as $e){
					$query .= ' AND p.'.$e.'=:'.$e;
				}
			}
			$query .= " ORDER BY $order  LIMIT :l OFFSET :n";
			$query = $this->conn->prepare($query);
	
            $n = $n*$limite;
			$query->bindParam(':l', $limite, PDO::PARAM_INT);
			$query->bindParam(':n', $n, PDO::PARAM_INT);
			if ($this->id != null) {
				$query->bindParam(':id', $this->id, PDO::PARAM_INT);
			}
			if ($this->id_metodo_pago != null){
				$query->bindParam(':id_metodo_pago', $this->id_metodo_pago, PDO::PARAM_INT);
			}
			if ($this->id_venta != null){
				$query->bindParam(':id_venta', $this->id_venta, PDO::PARAM_INT);
			}
	
			$query->execute();
			return $query->fetchAll();
		}

		function agregar($usuario){
            $query = $this->conn->prepare('INSERT INTO pagos (id_venta,id_metodo_pago,monto) VALUES (:id_venta,:id_metodo_pago,:monto)');
            $query->bindParam(':id_venta',$this->id_venta);
            $query->bindParam(':id_metodo_pago',$this->id_metodo_pago);
            $query->bindParam(':monto',$this->monto);
            $query->execute();
        }
		
	}
?>