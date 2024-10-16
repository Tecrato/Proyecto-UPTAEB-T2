<?php
    class DB {

        public $conn;
        function __construct() {
            $this->conn = new PDO("mysql:host=localhost;dbname=proyecto","root");
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
        function search_bitacora($id=null, $limite=9, $n=0, $order=" id DESC") {
            $query = "SELECT
                    b.id,
                    (SELECT nombre FROM usuarios WHERE usuarios.id = b.id_usuario) as nombre,
                    b.tabla,
                    b.accion,
                    b.fecha,
                    b.detalles
                    FROM bitacora b
                    INNER JOIN usuarios u ON b.id_usuario = u.id";
            if ($id != null){
                $query .= " WHERE id_usuario=:id";
            }

            $n = $n*$limite;

			$query .= " ORDER BY ".$order ;
            $query .= " LIMIT :l OFFSET :n";

            $consulta = $this->conn->prepare($query);
            if ($id != null){
                $consulta->bindParam(":id",$id, PDO::PARAM_INT);
            }
            $consulta->bindParam(':l',$limite, PDO::PARAM_INT);
            $consulta->bindParam(':n',$n, PDO::PARAM_INT);
            
            $consulta->execute();
            return $consulta->fetchAll();
        }
        function COUNT() {
            $query = $this->conn->prepare("SELECT COUNT(*) as 'total' FROM bitacora");
            $query->execute();
            return $query->fetch()['total'];
            
        }
        function COUNT_user($user) {
            $query = $this->conn->prepare("SELECT COUNT(*) as 'total' FROM bitacora WHERE id_usuario=:id");
            $query->bindParam(":id",$user, PDO::PARAM_INT);
            $query->execute();
            return $query->fetch()['total'];
            
        }
    }
    
    
?>