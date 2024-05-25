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

        function agregar(){
            
            $query = $this->conn->prepare("INSERT INTO categoria VALUES(null, :nombre, :descripcion)");

            $query->bindParam(':nombre',$this->nombre);
            $query->bindParam(':descripcion',$this->descripcion);

            $query->execute();
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
            function borrar() {

                $query = $this->conn->prepare("DELETE FROM categoria WHERE ID=:id");
                
                $query->execute([':id'=>$this->id]);
            }

            
            $consulta->execute();
            return $consulta->fetchAll();
        }

	}
?>