<?php

    class Metodo_pago extends DB{
        private $id;
        private $nombre;

        function __construct($id=null, $nombre=null){           
            $this->id = $id;
            $this->nombre = $nombre;
            DB::__construct();

        }

        function agregar($usuario){
            $query = $this->conn->prepare("INSERT INTO metodo_pago VALUES(null, :nombre,1)");
            $query->bindParam(':nombre',$this->nombre);
            $query->execute();
			$this->add_bitacora($usuario,"Metodos de Pago","Registrar","Metodo de Pago Registrado");
        }
        function borrar($usuario) {
            $query = $this->conn->prepare("DELETE FROM metodo_pago WHERE ID=:id");
            $query->bindParam(':id',$this->id, PDO::PARAM_INT);
            $query->execute();
			$this->add_bitacora($usuario,"Marcas","Eliminar","Marca".$this->id." Eliminada");
        }

        function desactivar($usuario){
			$query = $this->conn->prepare('UPDATE metodo_pago SET active=0 WHERE id=:id');
			$query->bindParam(':id',$this->id);
			$query->execute();
			$this->add_bitacora($usuario,"Metodo de Pago","Eliminar","Metodo de Pago".$this->id. " Eliminado");
        }
        function search($n=0,$limite=9){
            $query = "SELECT * FROM metodo_pago";

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
        function actualizar($usuario){
            $query = 'UPDATE metodo_pago SET nombre=:nombre WHERE id=:id';
            $query = $this->conn->prepare($query);
            $query->bindParam(':nombre',$this->nombre);
            $query->bindParam(':id',$this->id);
            $query->execute();
			$this->add_bitacora($usuario,"Metodo de Pago","Modificar","Metodo de Pago ".$this->id." Modificado");
        }

        function COUNT(){
            return $this->conn->query("SELECT COUNT(*) 'total' FROM metodo_pago")->fetch()['total'];
        }
}

?>