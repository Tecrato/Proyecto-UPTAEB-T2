<?php

    class Cliente extends Db_base{
        private $id;
        private $nombre;
        private $cedula;
        private $documento;
        private $apellido;
        private $telefono;
        private $direccion;
        private $active;
        private $like_nombre;
        private $like_cedula;

        function __construct($id=null, $nombre=null,$cedula=null,$apellido=null,$documento=null,$telefono=null,$direccion=null,$active=null,$like_nombre='',$like_cedula=''){
            $this->id = $id;
            $this->nombre = $nombre;
            $this->cedula = $cedula;
            $this->documento = $documento;
            $this->apellido = $apellido;
            $this->telefono = $telefono;
            $this->direccion = $direccion;
            $this->active = $active;
            $this->like_nombre = $like_nombre;
            $this->like_cedula = $like_cedula;
            Db_base::__construct();
            $this->add_variables([
                "id"=> $this->id,
                "nombre"=> $this->nombre,
                "cedula"=> $this->cedula,
                "documento"=> $this->documento,
                "apellido"=> $this->apellido,
                "telefono"=> $this->telefono,
                "direccion"=> $this->direccion,
                "active"=> $this->active,
            ]);
            $this->add_variables_like([
                "nombre" => $this->like_nombre,
                "cedula" => $this->like_cedula
            ]);
            $this->tabla = 'clientes';
            $this->select_query = "
                a.id,
                a.nombre,
                a.cedula,
                a.documento,
                a.apellido,
                a.telefono,
                a.direccion
            ";

        }
    }
?>