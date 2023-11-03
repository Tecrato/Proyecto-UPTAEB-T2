<?php

    // require('Conexion.php');
    class Proveedor extends DB{
        private $id;
        private $nombre;
        private $razon_social;
        private $rif;
        private $telefono;
        private $correo;
        private $direccion;

        function __construct($id=null, $nombre=null,$razon_social=null,$rif=null,$telefono=null,$correo=null,$direccion=null){
            $this->id = $id;
            $this->nombre = $nombre;
            $this->razon_social = $razon_social;
            $this->rif = $rif;
            $this->telefono = $telefono;
            $this->correo = $correo;
            $this->direccion = $direccion;
            DB::__construct();

        }

        // esta funcion agrega a la tabla productos un objeto con los valores que se le estan pasando
        function agregar() {
            
            $query = $this->conn->prepare("INSERT INTO proveedores VALUES(null,?, ?, ?, ?, ?, ?)");

            $query->bindParam(1,$this->nombre);
            $query->bindParam(2,$this->razon_social);
            $query->bindParam(3,$this->rif);
            $query->bindParam(4,$this->telefono);
            $query->bindParam(5,$this->correo);
            $query->bindParam(6,$this->direccion);
            $query->execute();
        }

        // con esta funcion se elimina un elemento dependiendo de su id
        function DELETE($id) {

            $query = $this->conn->prepare("DELETE FROM proveedores WHERE ID=:id");
            
            $query->execute([':id'=>$id]);
        }

        // Con esta funcion podremos cambiar un producto segun su ID con los valores que le pasemos
        function UPDATE(){
            
            $query = $this->conn->prepare("UPDATE proveedores SET nombre=?, razon_social=?, rif=?, telefono=?, correo=?, direccion=? WHERE ID=?");
        
            $query->bindParam(1,$this->nombre);
            $query->bindParam(2,$this->razon_social);
            $query->bindParam(3,$this->rif);
            $query->bindParam(4,$this->telefono);
            $query->bindParam(5,$this->correo);
            $query->bindParam(6,$this->direccion);
            $query->bindParam(7,$this->id);
            $query->execute();
        }

        function search_detalles_producto($id){
            
            $query = "SELECT nombre,(SELECT SUM(restante) FROM lotes Where id_proveedor = p.id) as stock,(SELECT MIN(fecha_vencimiento) FROM lotes Where id_proveedor = p.id) as fecha_vencimiento FROM `proveedores` as p WHERE p.id=$id ORDER BY nombre";
        
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
            
            $consulta = $this->conn->query($query);
            return $consulta->fetchAll();
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