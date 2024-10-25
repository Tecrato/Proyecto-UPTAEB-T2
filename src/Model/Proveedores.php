<?php

    class Proveedor extends Db_base{
        private $id;
        private $nombre;
        private $razon_social;
        private $rif;
        private $telefono;
        private $correo;
        private $direccion;
        private $active;
        private $like;


        function __construct($id=null, $nombre=null,$razon_social=null,$rif=null,$telefono=null,$correo=null,$direccion=null,$active=null,$like=''){
            $this->id = $id;
            $this->nombre = $nombre;
            $this->razon_social = $razon_social;
            $this->rif = $rif;
            $this->telefono = $telefono;
            $this->correo = $correo;
            $this->direccion = $direccion;
            $this->active = $active;
            $this->like = $like;
            Db_base::__construct();
            $this->add_variables([
                "id" => $this->id,
                "nombre" => $this->nombre,
                "razon_social" => $this->razon_social,
                "rif" => $this->rif,
                "telefono" => $this->telefono,
                "correo" => $this->correo,
                "direccion" => $this->direccion,
                "active" => $this->active,
            ]);
            $this->add_variables_like([
                "razon_social" => $this->like,
            ]);
            $this->tabla = 'proveedores';
        }

        // con esta funcion se elimina un elemento dependiendo de su id
        function desactivar() {
			$query = $this->conn->prepare('UPDATE proveedores SET active=0 WHERE id=:id');

			$query->bindParam(':id',$this->id);
			$query->execute();
        }
    }
?>