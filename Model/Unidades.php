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

		function agregar($usuario){
            $query = $this->conn->prepare('INSERT INTO unidades (nombre) VALUES (:nombre)');
            $query->bindParam(':nombre',$this->nombre);
            $query->execute();
			$this->add_bitacora($usuario,"Unidades","Registrar","Unidad Registrada");
        }
		
		function borrar($usuario, $id){
            $query = $this->conn->prepare('DELETE FROM unidades WHERE id = :id');
            $query->bindParam(':id',$this->id);
            $query->execute();
			$this->add_bitacora($usuario,"Unidades","Eliminar","Unidad"." $id". " Eliminada");
        }

		function actualizar($usuario, $id){
            $query = 'UPDATE unidades SET nombre=:nombre WHERE id=:id';
            $query = $this->conn->prepare($query);
            $query->bindParam(':nombre',$this->nombre);
            $query->bindParam(':id',$this->id);
            $query->execute(); 
			$this->add_bitacora($usuario,"Unidades","Modificar","Unidad "."$id"." Modificada");
        }
	}
?>