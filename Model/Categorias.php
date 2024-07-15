<?php
	class Categoria extends DB {

		private $id;
		private $nombre;

		function __construct($id=null, $nombre=null){
			DB::__construct();
			$this->id = $id;
			$this->nombre = $nombre;
		}

        function agregar($usuario){
            $query = $this->conn->prepare("INSERT INTO categoria VALUES(null, :nombre)");
            $query->bindParam(':nombre',$this->nombre);
            $query->execute();
			$this->add_bitacora($usuario,"Categorias","Registrar","Categoria Registrada");
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

        function borrar($usuario){
            $query = $this->conn->prepare('DELETE FROM categoria WHERE id = :id');
            $query->bindParam(':id',$this->id);
            $query->execute();
			$this->add_bitacora($usuario,"Categorias","Eliminar","Categoria".$this->id." Eliminada");
        }

        function actualizar($usuario){
            $query = 'UPDATE categoria SET nombre=:nombre WHERE id=:id';
            $query = $this->conn->prepare($query);
            $query->bindParam(':nombre',$this->nombre);
            $query->bindParam(':id',$this->id);
            $query->execute(); 
			$this->add_bitacora($usuario,"Categorias","Modificar","Categoria ".$this->id." Modificada");
        }

        function COUNT(){
            return $this->conn->query("SELECT COUNT(*) 'total' FROM usuarios")->fetch()['total'];
        }
	}
?>