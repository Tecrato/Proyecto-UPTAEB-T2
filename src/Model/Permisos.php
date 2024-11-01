<?php
    namespace Shtechnologyx\Pt3\Model;
    use PDO;
    class Permisos extends Db_base{
        private $id;
        private $id_usuario;
        private $tabla_query;
        private $permiso;

        function __construct($id=null, $id_usuario=null, $tabla=null, $permiso=null){           
            $this->id = $id;
            $this->id_usuario = $id_usuario;
            $this->tabla_query = $tabla;
            $this->permiso = $permiso;
            Db_base::__construct();
            $this->tabla = "permisos";
            $this->add_variables([
                "a.id" => $this->id,
                "a.id_usuario" => $this->id_usuario,
                "a.tabla" => $this->tabla_query,
                "a.permiso" => $this->permiso,
            ]);
        }
}

?>