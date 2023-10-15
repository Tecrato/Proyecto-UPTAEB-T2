<?php
	class Categoria extends DB {
		public function search(){
			$query = "SELECT * FROM ";
			return $this->conn->query($query);
		}
	}
?>