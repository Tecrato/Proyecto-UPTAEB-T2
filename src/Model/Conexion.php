<?php
    namespace Shtechnologyx\Pt3\Model;
    use PDO;

    class Conexion{
        public $conn;
        function __construct(){
            $this->conn = new PDO('mysql:host=' . $GLOBALS['db_host'] . ';dbname=' . $GLOBALS['db_name'], $GLOBALS['db_user'], $GLOBALS['db_pass']);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        function __destruct(){
            $this->conn = null;
        }
    }
?>