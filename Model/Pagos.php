<?php
	class Pago extends DB {
		private $id;
		private $id_venta;
		private $metodo_de_pago;
		private $monto;
		function __construct($id=null, $id_venta=null, $metodo_de_pago=null, $monto=null){
			DB::__construct();
			$this->id = $id;
			$this->id_venta = $id_venta;
			$this->metodo_de_pago = $metodo_de_pago;
			$this->monto = $monto;
		}
		
		function search($n=0, $limite=9){
			$query = "SELECT * FROM pagos";
			return $this->conn->query($query)->fetchAll();
		}

		function agregar($usuario){
            $query = $this->conn->prepare('INSERT INTO pagos (id_venta,metodo_de_pago,monto) VALUES (:id_venta,:metodo_de_pago,:monto)');
            $query->bindParam(':id_venta',$this->id_venta);
            $query->bindParam(':metodo_de_pago',$this->metodo_de_pago);
            $query->bindParam(':monto',$this->monto);
            $query->execute();
			$this->add_bitacora($usuario,"Pagos","Registrar","Pago Registrado");
        }
		
	}
?>