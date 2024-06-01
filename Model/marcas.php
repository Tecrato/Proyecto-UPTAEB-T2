<?php

    class Marca extends DB{
        private $id;
        private $nombre;

        function __construct($id=null, $nombre=null){           
            $this->id = $id;
            $this->nombre = $nombre;
            DB::__construct();

        }

        function agregar($usuario){
            $query = $this->conn->prepare("INSERT INTO marcas VALUES(null, :nombre)");
            $query->bindParam(':nombre',$this->nombre);
            $query->execute();
			$this->add_bitacora($usuario,"Marcas","Registrar","Marca Registrada");
        }
        function borrar($usuario, $id) {
            $query = $this->conn->prepare("DELETE FROM marcas WHERE ID=:id");
            $query->bindParam(':id',$this->id, PDO::PARAM_INT);
            $query->execute();
			$this->add_bitacora($usuario,"Marcas","Eliminar","Marca"." $id". " Eliminada");
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
        function actualizar($usuario, $id){
            $query = 'UPDATE marcas SET nombre=:nombre WHERE id=:id';
            $query = $this->conn->prepare($query);
            $query->bindParam(':nombre',$this->nombre);
            $query->bindParam(':id',$this->id);
            $query->execute();
			$this->add_bitacora($usuario,"Marcas","Modificar","Marca "."$id"." Modificada");
        }

        function COUNT(){
            return $this->conn->query("SELECT COUNT(*) 'total' FROM marcas")->fetchAll()['total'];
        }
}

?>