<?php
	class Unidad extends DB {
		public function search($n=0){
			$query = "SELECT * FROM unidades";
			return $this->conn->query($query)->fetchAll();
		}
	}
?>