<?php

    class MARCA extends DB{
        private $id;
        private $nombre;

        function __construct($id=null, $nombre=null){           
            $this->id = $id;
            $this->nombre = $nombre;
            DB::__construct();

        }

        function agregar(){
            $query = $this->conn->prepare("INSERT INTO marcas VALUES(:nombre)");
            $query->bindParam(':nombre',$this->nombre, PDO::PARAM_STR);
            $query->execute();
        }
        function borrar() {
            $query = $this->conn->prepare("DELETE FROM marcas WHERE ID=:id");
            $query->bindParam(':id',$this->id, PDO::PARAM_INT);
            $query->execute();
        }
        function search($n=0,$limite=9){
            $query = "SELECT * FROM marcas";

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
        function actualizar(){
            $query = 'UPDATE unidades SET nombre=:nombre WHERE id=:id';
            $query = $this->conn->prepare($query);
            $query->bindParam(':nombre',$this->nombre);
            $query->bindParam(':id',$this->id);
            $query->execute();
        }

        function COUNT(){
            return $this->conn->query("SELECT COUNT(*) 'total' FROM marcas")->fetchAll()['total'];
        }
}

?>