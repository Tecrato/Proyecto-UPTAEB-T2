<?php
	class Categoria extends DB {
		public function search(){
			$query = "SELECT * FROM categoria";
			return $this->conn->query($query);
		}
	}
?>