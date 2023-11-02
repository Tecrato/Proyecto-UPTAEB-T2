<?php

    class Usuarios extends DB {
        // Que de momento solo busca, ya que solo se podra loguear al sistema
        function search($id=null, $lvl=null,$nombre=null,$correo=null,$password=null){
            $querys = [];
            $query = "SELECT * FROM usuarios WHERE";
            if ($id != null){
                $querys->array_push(" ID='$id'");
            }
            if ($nombre != null) {
                if (count($querys) > 0){
                    $querys->array_push(" AND");
                }
                $querys->array_push(" Nombre='$nombre'");
            }
            if ($correo != null) {
                if (count($querys) > 0){
                    $querys->array_push(" AND");
                }
                array_push($querys," correo='$correo'");
            }
            if ($password != null) {
                if (count($querys) > 0){
                    array_push($querys," AND");
                }
                array_push($querys," Contraseña='$password'");
            }
            if ($lvl != null) {
                if (count($querys) > 0){
                    $querys->array_push(" AND");
                }
                $querys->array_push(" id_rol='$lvl'");
            }

            if (count($querys) < 1) {
                $query = "SELECT * FROM usuarios";
            } else {
                foreach ($querys as $q) {
                    $query = $query . $q;
                }
            }
            $consulta = $this->conn->prepare($query);
            return $consulta->fetchAll();
        }
        function COUNT(){
            return $this->conn->query("SELECT COUNT(*) 'total' FROM usuarios")->fetchAll()['total'];
        }
    }

?>