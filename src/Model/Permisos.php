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

        function agregar(){
            $query = $this->conn->prepare("INSERT INTO permisos(id_usuario,tabla,permiso) VALUES(:id_usuario,:tabla,:permiso)");
            $query->bindParam(':id_usuario',$this->id_usuario);
            $query->bindParam(':tabla',$this->tabla);
            $query->bindParam(':permiso',$this->permiso);
            $query->execute();
        }
        function borrar() {
            $query = $this->conn->prepare("DELETE FROM permisos WHERE id_usuario=:id_usuario AND tabla=:tabla AND permiso=:permiso");
            $query->bindParam(':id_usuario',$this->id_usuario);
            $query->bindParam(':tabla',$this->tabla);
            $query->bindParam(':permiso',$this->permiso);
            $query->execute();
        }
        function search($n=0,$limite=9){
            $query = "SELECT a.id, a.id_usuario, b.nombre as nombre, a.tabla, a.permiso FROM permisos as a
            INNER JOIN usuarios as b ON a.id_usuario=b.id
            WHERE 1";

            $lista=[];
            if ($this->id){
            	array_push($lista,'id');
            }
            if ($this->id_usuario){
                array_push($lista, 'id_usuario');
            }
            if ($this->tabla){
                array_push($lista, 'tabla');
            }
            if ($this->permiso){
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
            if ($this->id_usuario != null){
                $consulta->bindParam(':id_usuario',$this->id_usuario, PDO::PARAM_INT);
            }
            if ($this->tabla != null){
                $consulta->bindParam(':tabla',$this->tabla, PDO::PARAM_STR);
            }
            if ($this->permiso != null){
                $consulta->bindParam(':permiso',$this->permiso, PDO::PARAM_STR);
            }
            $consulta->execute();
            return $consulta->fetchAll();
        }

        function COUNT(){
            return $this->conn->query("SELECT COUNT(*) 'total' FROM permisos")->fetch()['total'];
        }
}

?>