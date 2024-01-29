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
            
            $query = $this->conn->prepare("INSERT INTO proveedores VALUES(null, :nombre, :razon, :rif, :tel, :correo, :dir)");

            $query->bindParam(':nombre',$this->nombre);
            $query->bindParam(':razon',$this->razon_social);
            $query->bindParam(':rif',$this->rif);
            $query->bindParam(':tel',$this->telefono);
            $query->bindParam(':correo',$this->correo);
            $query->bindParam(':dir',$this->direccion);
            $query->execute();
        }

        // con esta funcion se elimina un elemento dependiendo de su id
        function borrar() {

            $query = $this->conn->prepare("DELETE FROM proveedores WHERE ID=:id");
            
            $query->execute([':id'=>$this->id]);
        }

        // Con esta funcion podremos cambiar un producto segun su ID con los valores que le pasemos
        function actualizar(){
            
            $query = $this->conn->prepare("UPDATE proveedores SET nombre=:nombre, razon_social=:razon, rif=:rif, telefono=:tel, correo=:correo, direccion=:dir WHERE ID=:id");
        
            $query->bindParam(':nombre',$this->nombre);
            $query->bindParam(':razon',$this->razon_social);
            $query->bindParam(':rif',$this->rif);
            $query->bindParam(':tel',$this->telefono);
            $query->bindParam(':correo',$this->correo);
            $query->bindParam(':dir',$this->direccion);
            $query->bindParam(':id',$this->id);
            $query->execute();
        }

        // Con esta otra funcion se busca entre los productos en la base de datos
        function search($n=0,$limite=9){
            $query = "SELECT * FROM proveedores";

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
        
        function search_like(){
            $query = $this->conn->prepare("SELECT * FROM proveedores WHERE nombre LIKE '%:nombre%'");
            $query->bindParam(':nombre',$this->nombre);

            $query->execute();
            return $query->fetchAll();
        }
        function COUNT(){
            return $this->conn->query("SELECT COUNT(*) 'total' FROM proveedores")->fetch()['total'];
        }
    }
?>