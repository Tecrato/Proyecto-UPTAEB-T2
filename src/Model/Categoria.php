<?php
    namespace Shtechnologyx\Pt3\Model;
    use PDO;

	class Categoria extends Db_base {

		private $id;
		private $nombre;
        private $like;

		function __construct($id=null, $nombre=null, $like = ""){
			$this->id = $id;
			$this->nombre = $nombre;
            $this->like = $like;
            Db_base::__construct();
            $this->tabla = "categoria";
            $this->add_variables([
                "id" => $this->id,
                "nombre" => $this->nombre,
                "like" => $this->like,
            ]);
            $this->add_variables_like([
                "nombre" => $this->like
            ]);
		}
	}
?>