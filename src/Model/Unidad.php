<?php
    namespace Shtechnologyx\Pt3\Model;
    use PDO;

	class Unidad extends Db_base {
		private $id;
		private $nombre;
        private $like;
		function __construct($id=null, $nombre=null, $like=""){
            $this->id = $id;
			$this->nombre = $nombre;
            $this->like = $like;
            
            Db_base::__construct();
            $this->tabla = 'unidades';
            $this->add_variables([
                "a.id" => $this->id,
                "a.nombre" => $this->nombre,
            ]);
            
            $this->add_variables_like([
                "a.nombre" => $this->like
            ]);
		}

	}
?>