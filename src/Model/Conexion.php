<?php
    namespace Shtechnologyx\Pt3\Model;
    use PDO;

    class Conexion{
        public $conn;
        function __construct(){
            require_once("Controller/variables.php");
            $this->conn = new PDO('mysql:host=' . $GLOBALS['db_host'] . ';dbname=' . $GLOBALS['db_name'], $GLOBALS['db_user'], $GLOBALS['db_pass']);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        function __destruct(){
            $this->conn = null;
        }
        
        function getVars() {
            return [
                'db_host' => $GLOBALS['db_host'],
                'db_user' => $GLOBALS['db_user'],
                'db_pass' => $GLOBALS['db_pass'],
                'db_name' => $GLOBALS['db_name'],
            ];
        }
    }
?>