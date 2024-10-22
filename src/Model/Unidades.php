
<?php
	class Unidad extends DB {
		private $id;
		private $nombre;
        private $like;
		function __construct($id=null, $nombre=null, $like=""){
			DB::__construct();
			$this->id = $id;
			$this->nombre = $nombre;
            $this->like = $like;
		}
		
		function search($n=0, $limite=9){
			$query = "SELECT * FROM unidades WHERE nombre LIKE :como ";
			$lista = [];

            if ($this->id){
            	array_push($lista,'id');
            }
            if ($lista) {
            	foreach ($lista as $e){
            		$query .= ' AND '.$e.'=:'.$e;
            	}
            }
            $n = $n*$limite;
            

            $query = $query . " LIMIT :l OFFSET :n";
            $consulta = $this->conn->prepare($query);


            $consulta->bindParam(':l',$limite, PDO::PARAM_INT);
            $consulta->bindParam(':n',$n, PDO::PARAM_INT);
            $consulta->bindValue(':como','%'.$this->like.'%');
            
            if ($this->id != null){
                $consulta->bindParam(':id',$this->id, PDO::PARAM_INT);
            }
            $consulta->execute();
            return $consulta->fetchAll();
		}

		function agregar(){
            $query = $this->conn->prepare('INSERT INTO unidades (nombre) VALUES (:nombre)');
            $query->bindParam(':nombre',$this->nombre);
            $query->execute();
        }
		
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
        function COUNT(){
            return $this->conn->query("SELECT COUNT(*) 'total' FROM usuarios")->fetch()['total'];
        }
	}
?>