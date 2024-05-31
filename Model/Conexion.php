<?php
    class DB {

        public $conn;
        function __construct() {
            $this->conn = new PDO("mysql:host=localhost;dbname=proyecto_3","root","12345");
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        function __destruct() {
            $this->conn = null;
        }
        function add_bitacora($usuario,$tabla,$accion,$detalles) {
            $query = 'INSERT INTO bitacora(usuario,tabla,accion,detalles) VALUES(:usu,:ta,:acc,:de)';
            $query = $this->conn->prepare($query);
            $query->bindParam(':usu',$usuario);
            $query->bindParam(':ta',$tabla);
            $query->bindParam(':acc',$accion);
            $query->bindParam(':de',$detalles);
            $query->execute();
        }
    }
    
?>