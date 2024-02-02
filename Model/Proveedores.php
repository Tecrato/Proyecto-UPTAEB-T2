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
        private $active;
        private $like;


        function __construct($id=null, $nombre=null,$razon_social=null,$rif=null,$telefono=null,$correo=null,$direccion=null,$active=1,$like=''){
            $this->id = $id;
            $this->nombre = $nombre;
            $this->razon_social = $razon_social;
            $this->rif = $rif;
            $this->telefono = $telefono;
            $this->correo = $correo;
            $this->direccion = $direccion;
            $this->active = $active;
            $this->like = $like;
            DB::__construct();

        }

        // esta funcion agrega a la tabla productos un objeto con los valores que se le estan pasando
        function agregar() {
            
            $query = $this->conn->prepare("INSERT INTO proveedores VALUES(null, :nombre, :razon, :rif, :tel, :correo, :dir,1)");

            $query->bindParam(':nombre',$this->nombre);
            $query->bindParam(':razon',$this->razon_social);
            $query->bindParam(':rif',$this->rif);
            $query->bindParam(':tel',$this->telefono);
            $query->bindParam(':correo',$this->correo);
            $query->bindParam(':dir',$this->direccion);
            $query->execute();
        }

        // con esta funcion se elimina un elemento dependiendo de su id
        function desactivar() {
			$query = $this->conn->prepare('UPDATE proveedores SET active=0 WHERE id=:id');

			$query->bindParam(':id',$this->id);
			$query->execute();
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
            $query = "SELECT * FROM proveedores WHERE active=:active AND razon_social LIKE :como";

            if ($this->id != null){
                $query = $query." AND id=:id";
            }
            $n = $n*$limite;

            $query = $query . " LIMIT :l OFFSET :n";

            $consulta = $this->conn->prepare($query);

            $consulta->bindParam(':active',$this->active, PDO::PARAM_INT);
            $consulta->bindParam(':l',$limite, PDO::PARAM_INT);
            $consulta->bindParam(':n',$n, PDO::PARAM_INT);
            if ($this->id != null){
                $consulta->bindParam(':id',$this->id, PDO::PARAM_INT);
            }
            $this->like = '%'.$this->like.'%';
            $consulta->bindParam(':como',$this->like, PDO::PARAM_STR);

        
            $consulta->execute();
            return $consulta->fetchAll();
        }
        
        function COUNT(){
            $query = $this->conn->prepare("SELECT COUNT(*) as 'total' FROM proveedores WHERE active=:active");
			$query->bindParam(':active',$this->active, PDO::PARAM_INT);
            $query->execute();
            return $query->fetch()['total'];
        }
    }
?>