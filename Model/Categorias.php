<?php
	class Categoria extends DB {

		private $id;
		private $nombre;
		private $descripcion;

		public function __construct($id=null, $nombre=null, $descripcion=null){
			DB::__construct();
			$this->id = $id;
			$this->nombre = $nombre;
			$this->descripcion = $descripcion;
		}

		public function search($n=0){
			return $this->conn->query("SELECT * FROM categoria")->fetchAll();
		}
	}
?>