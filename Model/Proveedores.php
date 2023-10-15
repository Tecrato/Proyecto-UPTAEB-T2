<?php

    // require('Conexion.php');
    class Proveedor extends DB{

        // esta funcion agrega a la tabla productos un objeto con los valores que se le estan pasando
        function agregar($nombre,$razon_social,$rif,$telefono,$correo,$direccion) {
            
            $query = "INSERT INTO proveedores VALUES(null,'$nombre', '$razon_social', '$rif', $telefono, '$correo', '$direccion')";
            
            $this->conn->query($query);
        }

        // con esta funcion se elimina un elemento dependiendo de su id
        function DELETE($id) {

            $query = "DELETE FROM proveedores WHERE ID=$id";
            
            $this->conn->query($query);
        }

        // Con esta funcion podremos cambiar un producto segun su ID con los valores que le pasemos
        function UPDATE($id,$nombre,$razon_social,$rif,$telefono,$correo,$direccion){
            
            $query = "UPDATE proveedores SET nombre='$nombre', razon_social='$razon_social', rif='$rif', telefono=$telefono, correo='$correo', direccion='$direccion'";
            $query = $query . " WHERE ID=$id";
        
            return $this->conn->query($query); //$conn->fetch_assoc() // Y devuelve el resultado al controlador
        }

        // Con esta otra funcion se busca entre los productos en la base de datos
        function search($id=null,$nombre=null,$rif=null,$telefono=null,$correo=null,$direccion=null,$n=0){
            // Al igual que la clase anterior, puede buscar segun muchos valores o solo algunos
            $querys = [];
            $query = "SELECT * FROM proveedores WHERE";
            if ($id != null){
                array_push($querys," ID='$id'");
            }
            if ($nombre != null) {
                if (count($querys) > 0){
                    array_push($querys," AND");
                }
                array_push($querys," Nombre='$nombre'");
            }
            if ($rif != null) {
                if (count($querys) > 0){
                    array_push($querys," AND");
                }
                array_push($querys," rif='$rif'");
            }
            if ($telefono != null) {
                if (count($querys) > 0){
                    array_push($querys," AND");
                }
                array_push($querys," telefono='$telefono'");
            }
            if ($correo != null) {
                if (count($querys) > 0){
                    array_push($querys," AND");
                }
                array_push($querys," correo='$correo'");
            }
            if ($direccion != null) {
                if (count($querys) > 0){
                    array_push($querys," AND");
                }
                array_push($querys," direccion='$direccion'");
            }

            if (count($querys) < 1) { // Si no hay condiciones se obtienen 9 resultados dependiento de en que pagina esta el usuario
                $n = 9*$n;
                $query = "SELECT * FROM proveedores LIMIT 9 OFFSET $n";
            } else { // Sino
                foreach ($querys as $q) { // Se pasa con los filtros
                    $query = $query . $q;
                }
            }
            
            return $this->conn->query($query);
        }
        function search_like($nombre){
            $query = "SELECT * FROM proveedores WHERE nombre LIKE '%$nombre%'";

            
            return $this->conn->query($query);
        }
        function COUNT(){
            return $this->conn->query("SELECT COUNT(*) 'total' FROM proveedores")->fetch_assoc()['total'];
        }
    }
?>