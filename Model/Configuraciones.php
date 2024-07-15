<?php
	class Configuracion extends DB {
        private $value;
        private $key;
		function __construct($key=null,$value=null) {
			DB::__construct();

            $this->value = $value;
            $this->key = $key;
		}

        function actualizar($usuario) {
            
            $query = "UPDATE configuraciones SET valor=:valor WHERE llave=:llave";
            $query = $this->conn->prepare($query);
            $query->bindParam(':valor',$this->value, PDO::PARAM_STR);
            $query->bindParam(':llave',$this->key, PDO::PARAM_STR);
            $query->execute();
			$this->add_bitacora($usuario,"Configuraciones","Modificar","Configuracion $this->key Modificada");

        }
        function search($n=0, $limite=9) {
            
            $query = "SELECT * FROM configuraciones ";
            if ($this->key != null) {
                $query = $query." WHERE llave=:llave";
            }
            
			$query .= " LIMIT :l OFFSET :n";
            $query = $this->conn->prepare($query);

            
            $n = $n*$limite;
			$query->bindParam(':l', $limite, PDO::PARAM_INT);
			$query->bindParam(':n', $n, PDO::PARAM_INT);
            if ($this->key != null) {
                $query->bindParam(':llave',$this->key, PDO::PARAM_INT);
            }
            $query->execute();
            $result = $query->fetchAll();
            return $result;
        }
        function COUNT() {
            $query = $this->conn->prepare("SELECT COUNT(*) as 'total' FROM configuraciones ");
            $query->execute();
            return $query->fetch()['total'];
        }
	}
?>