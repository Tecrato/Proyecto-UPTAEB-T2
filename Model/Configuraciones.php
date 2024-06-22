<?php
	class Configuracion extends DB {
		function __construct(){
			DB::__construct();
		}

        function setDolar($dolar) {
            
            $query = "UPDATE configuracion SET dolar=:dolar";
            $consulta = $this->conn->prepare($query);
            $consulta->bindParam(':dolar',$dolar, PDO::PARAM_INT);
            return 1;
        }
        function getDolar() {
            
            $query = "SELECT * FROM configuracion WHERE llave='dolar'";
            $consulta = $this->conn->prepare($query);
            $consulta->execute();
            if ($consulta) {
                return intval($consulta->fetch()['valor']);
            }
            return 0;
        }
	}
?>