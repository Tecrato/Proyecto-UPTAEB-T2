<?php
	class Categoria extends DB {
		public function search($n=0){
			$query = "SELECT * FROM categoria";
			return $this->conn->query($query)->fetchAll();
		}
	}
?>