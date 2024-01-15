<?php
    class DB {

        public $conn;
        function __construct() {
            $this->conn = new PDO("mysql:host=localhost;dbname=proyecto","root");
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

    }
    
?>