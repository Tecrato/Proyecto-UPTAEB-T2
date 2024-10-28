
<?php
	class Unidad extends Db_base {
		private $id;
		private $nombre;
        private $like;
		function __construct($id=null, $nombre=null, $like=""){
			$this->id = $id;
			$this->nombre = $nombre;
            $this->like = $like;
            Db_base::__construct();
            $this->add_variables([
                "id" => $this->id,
                "nombre" => $this->nombre,
            ]);
            $this->add_variables_like([
                "nombre" => $this->like
            ]);
            $this->tabla = 'unidades';
		}
		
	}
?>