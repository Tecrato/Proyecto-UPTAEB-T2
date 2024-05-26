<?php
	class Unidad extends DB {
		private $id;
		private $nombre;
		function __construct($id=null, $nombre=null){
			DB::__construct();
			$this->id = $id;
			$this->nombre = $nombre;
		}
		function search($n=0, $limite=9){
			$query = "SELECT * FROM unidades";
			return $this->conn->query($query)->fetchAll();
		}
		function agregar(){
            $query = $this->conn->prepare('INSERT INTO unidades (nombre) VALUES (:nombre)');
            $query->bindParam(':nombre',$this->nombre);
            $query->execute();
        }
		# y una funcion para borrar
		function borrar(){
            $query = $this->conn->prepare('DELETE FROM unidades WHERE id = :id');
            $query->bindParam(':id',$this->id);
            $query->execute();
        }
		function actualizar(){
            $query = 'UPDATE unidades SET nombre=:nombre WHERE id=:id';
            $query = $this->conn->prepare($query);
            $query->bindParam(':nombre',$this->nombre);
            $query->bindParam(':id',$this->id);
            $query->execute(); 
        }
	}
?>