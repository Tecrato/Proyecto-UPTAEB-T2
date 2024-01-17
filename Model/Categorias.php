<?php
	class Categoria extends DB {

		private $id;
		private $nombre;
		private $descripcion;

		function __construct($id=null, $nombre=null, $descripcion=null){
			DB::__construct();
			$this->id = $id;
			$this->nombre = $nombre;
			$this->descripcion = $descripcion;
		}

        function search($n=0,$limite=100){
            // Al igual que la clase anterior, puede buscar segun muchos valores o solo algunos
            $query = "SELECT * FROM categoria";

            if ($this->id != null){
                $query = $query." WHERE id=:id";
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

	}
?>