<?php
    namespace Shtechnologyx\Pt3\Model;
    use PDO;

    class Cliente extends Db_base {
        private $id;
        private $nombre;
        private $cedula;
        private $documento;
        private $apellido;
        private $telefono;
        private $direccion;
        private $like_nombre;
        private $like_cedula;

        function __construct($id=null, $nombre=null,$cedula=null,$apellido=null,$documento=null,$direccion=null,$telefono=null,$like_nombre='',$like_cedula=''){
            $this->id = $id;
            $this->nombre = $nombre;
            $this->cedula = $cedula;
            $this->documento = $documento;
            $this->apellido = $apellido;
            $this->telefono = $telefono;
            $this->direccion = $direccion;
            $this->like_nombre = $like_nombre;
            $this->like_cedula = $like_cedula;
            Db_base::__construct();
            $this->tabla = "clientes";
            $this->add_variables([
                "a.id" => $this->id,
                "a.nombre" => $this->nombre,
                "a.cedula" => $this->cedula,
                "a.documento" => $this->documento,
                "a.apellido" => $this->apellido,
                "a.telefono" => $this->telefono,
                "a.direccion" => $this->direccion,
            ]);
            $this->add_variables_like([
                "a.nombre" => $this->like_nombre,
                "a.cedula" => $this->like_cedula
            ]);
        }

        function desactivar(){
			$query = $this->conn->prepare('UPDATE clientes SET active=0 WHERE id=:id');
			$query->bindParam(':id',$this->id);
			$query->execute();
        }

    }
?>