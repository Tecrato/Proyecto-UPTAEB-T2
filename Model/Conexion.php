<?php
    class DB {

        public $conn;
        function __construct() {
            $this->conn = new PDO("mysql:host=localhost;dbname=proyecto_2","root","12345");
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        function __destruct() {
            $this->conn = null;
        }
    }
    
?>