<?php
    namespace Shtechnologyx\Pt3\Model;
    use PDO;

	class Configuracion extends Conexion {
        private $value;
        private $key;
		function __construct($key=null,$value=null) {
			Conexion::__construct();

            $this->value = $value;
            $this->key = $key;
		}

        function actualizar() {
            
            $query = "UPDATE configuraciones SET valor=:valor WHERE llave=:llave";
            $query = $this->conn->prepare($query);
            $query->bindValue(':valor',$this->value, PDO::PARAM_STR);
            $query->bindValue(':llave',$this->key, PDO::PARAM_STR);
            $query->execute();

        }
        function search($n=0, $limite=9) {
            
            $query = "SELECT * FROM configuraciones ";
            if ($this->key != null) {
                $query = $query." WHERE llave=:llave";
            }
            
			$query .= " LIMIT :l OFFSET :n";
            $query = $this->conn->prepare($query);

            
            $n = $n*$limite;
			$query->bindValue(':l', $limite, PDO::PARAM_INT);
			$query->bindValue(':n', $n, PDO::PARAM_INT);
            if ($this->key != null) {
                $query->bindValue(':llave',$this->key, PDO::PARAM_INT);
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