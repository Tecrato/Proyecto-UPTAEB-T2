<?php

    class Permiso extends DB{
        private $id;
        private $id_usuario;
        private $tabla;
        private $permiso;

        function __construct($id=null, $id_usuario=null, $tabla=null, $permiso=null){           
            $this->id = $id;
            $this->id_usuario = $id_usuario;
            $this->tabla = $tabla;
            $this->permiso = $permiso;
            DB::__construct();

        }

        function agregar($usuario){
            $query = $this->conn->prepare("INSERT INTO permisos(id_usuario,tabla,permiso) VALUES(null, :id_usuario,:tabla,:permiso)");
            $query->bindParam(':id_usuario',$this->id_usuario);
            $query->bindParam(':tabla',$this->tabla);
            $query->bindParam(':permiso',$this->permiso);
            $query->execute();
			$this->add_bitacora($usuario,"Permisos","Registrar","Permiso Registrado");
        }
        function borrar($usuario) {
            $query = $this->conn->prepare("DELETE FROM permisos WHERE id=:id");
            $query->bindParam(':id',$this->id, PDO::PARAM_INT);
            $query->execute();
			$this->add_bitacora($usuario,"Permisos","Eliminar","Permiso".$this->id. " Eliminado");
        }
        function search($n=0,$limite=9){
            $query = "SELECT * FROM permisos WHERE 1";

            if ($this->id){
            	array_push($lista,'id');
            }
            if ($this->id_usuario){
                array_push($lista, 'id_usuario');
            }
            if ($this->estado){
                array_push($lista, 'tabla');
            }
            if ($this->estado){
                array_push($lista, 'permiso');
            }
            if ($lista) {
            	foreach ($lista as $e){
            		$query .= ' AND a.'.$e.'=:'.$e;
            	}
            }

            $n = $n*$limite;
            

            $query = $query . " LIMIT :l OFFSET :n";
            $consulta = $this->conn->prepare($query);


            $consulta->bindParam(':l',$limite, PDO::PARAM_INT);
            $consulta->bindParam(':n',$n, PDO::PARAM_INT);
            
            if ($this->id != null){
                $consulta->bindParam(':id',$this->id, PDO::PARAM_INT);
            }
            if ($this->id != null){
                $consulta->bindParam(':id_usuario',$this->id, PDO::PARAM_INT);
            }
            if ($this->id != null){
                $consulta->bindParam(':tabla',$this->id, PDO::PARAM_INT);
            }
            if ($this->id != null){
                $consulta->bindParam(':permiso',$this->id, PDO::PARAM_INT);
            }
            $consulta->execute();
            return $consulta->fetchAll();
        }

        function COUNT(){
            return $this->conn->query("SELECT COUNT(*) 'total' FROM permisos")->fetchAll()['total'];
        }
}

?>