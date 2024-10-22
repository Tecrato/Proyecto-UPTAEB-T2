<?php

    class Marca extends DB{
        private $id;
        private $nombre;
        private $like;

        function __construct($id=null, $nombre=null, $like=""){
            $this->id = $id;
            $this->nombre = $nombre;
            $this->like = $like;
            DB::__construct();

        }

        function agregar(){
            $query = $this->conn->prepare("INSERT INTO marcas VALUES(null, :nombre)");
            $query->bindParam(':nombre',$this->nombre);
            $query->execute();
        }
        function borrar() {
            $query = $this->conn->prepare("DELETE FROM marcas WHERE ID=:id");
            $query->bindParam(':id',$this->id, PDO::PARAM_INT);
            $query->execute();
        }
        function search($n=0,$limite=9){
            $query = "SELECT * FROM marcas WHERE nombre LIKE :como ";

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
        function actualizar(){
            $query = 'UPDATE marcas SET nombre=:nombre WHERE id=:id';
            $query = $this->conn->prepare($query);
            $query->bindParam(':nombre',$this->nombre);
            $query->bindParam(':id',$this->id);
            $query->execute();
        }

        function COUNT(){
            return $this->conn->query("SELECT COUNT(*) 'total' FROM marcas")->fetch()['total'];
        }
}

?>