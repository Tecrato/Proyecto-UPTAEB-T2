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
            $query = 'INSERT INTO bitacora(id_usuario,tabla,accion,detalles) VALUES(:usu,:ta,:acc,:de)';
            $query = $this->conn->prepare($query);
            $query->bindParam(':usu',$usuario);
            $query->bindParam(':ta',$tabla);
            $query->bindParam(':acc',$accion);
            $query->bindParam(':de',$detalles);
            $query->execute();
        }
        function searh_bitacora($id=null, $limite=9, $n=0) {
            $query = "SELECT * FROM bitacora";
            if ($id != null){
                $query .= " WHERE id_usuario=:id";
            }

            $n = $n*$limite;

            $query = $query . " LIMIT :l OFFSET :n";

            $consulta = $this->conn->prepare($query);
            if ($id != null){
                $consulta->bindParam(":id",$id, PDO::PARAM_INT);
            }
            $consulta->bindParam(':l',$limite, PDO::PARAM_INT);
            $consulta->bindParam(':n',$n, PDO::PARAM_INT);
            
            $consulta->execute();
            return $consulta->fetchAll();
        }
    }
    
    
?>