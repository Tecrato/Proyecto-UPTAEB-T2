<?php
	class Capital extends DB {

		private $id;
		private $monto;
        private $descripcion;

		function __construct($id=null, $descripcion=null, $monto=null){
			DB::__construct();
			$this->id = $id;
			$this->monto = $monto;
            $this->descripcion = $descripcion;
		}

        function agregar($usuario) {
            $query = $this->conn->prepare("INSERT INTO movimientos_capital (monto, descripcion) VALUES(:monto, :descripcion)");
            $query->bindParam(':monto', $this->monto);
            $query->bindParam(':descripcion', $this->descripcion);
            $query->execute();
            $this->add_bitacora($usuario,"movimientos_capital","Registrar","Capital Cambiado");
        }
        function search($n=0,$limite=100){
            // Al igual que la clase anterior, puede buscar segun muchos valores o solo algunos
            $query = "SELECT * FROM movimientos_capital WHERE 1";

			$lista = [];

            if ($this->id){
            	array_push($lista,'id');
            }
            if ($lista) {
            	foreach ($lista as $e){
            		$query .= ' AND a.'.$e.'=:'.$e;
            	}
            }
            $n = $n*$limite;

            $query = $query . " LIMIT :l OFFSET :n";

            $consulta = $this->conn->prepare($query);

            $consulta->bindParam(':l',$limite, PDO::PARAM_INT);
            $consulta->bindParam(':n',$n, PDO::PARAM_INT);
            if ($this->id != null){
                $consulta->bindParam(':id',$this->id, PDO::PARAM_INT);
            }    
            $consulta->execute();
            return $consulta->fetchAll();
        }
        function detallesCapital(){
            $query = $this->conn->prepare('SELECT * FROM detalles_capital;');
            $query->execute();
            return $query->fetchAll();

	}
    function COUNT(){
        return $this->conn->query("SELECT COUNT(*) 'total' FROM movimientos_capital")->fetch()['total'];
    }
}
?>