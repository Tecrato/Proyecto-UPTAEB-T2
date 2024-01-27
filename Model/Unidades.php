<?php
	class Unidad extends DB {
		private $id;
		private $nombre;
		function __construct($id=null, $nombre=null){
			DB::__construct();
			$this->id = $id;
			$this->nombre = $nombre;
		}
		function search($n=0, $limite=9){
			$query = "SELECT * FROM unidades";
			return $this->conn->query($query)->fetchAll();
		}
	}
?>