<?php
	class Unidad extends DB {
		public function search(){
			$query = "SELECT * FROM unidades";
			return $this->conn->query($query);
		}
	}
?>