<?php
    namespace Shtechnologyx\Pt3\Model;
    use PDO;

    class Tipo_empaquetado extends Db_base{
        private $id;
        private $nombre;
        private $like;

        function __construct($id=null,$nombre=null,$like=''){
            $this->id = $id;
            $this->nombre = $nombre;
            Db_base::__construct();
            $this->add_variables([
                "id"=> $this->id,
                "nombre"=> $this->id_unidad,
            ]);
            $this->add_variables_like([
                "nombre" => $this->like
            ]);
            $this->tabla = 'tipo_empaquetado';
        }
    }
?>