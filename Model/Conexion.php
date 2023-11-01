<?php

    // Aca estaran las clases de las tablas de las bases de datos

    // cada funcion en las clases tendran un '$query' que representa el codigo SQL que ejecutaran
    // '$conn' representa la base de datos
    // al usar '$conn->query()' estamos realizando una operacion SQL por lo que le pasamos la variable $query anteriormente mencionada


    class DB {

        public $conn;
        function __construct() {
        $servidor ="localhost";
        $usuario="root";
        $contrasenia="";
        $this->conn = new PDO("mysql:host=$servidor;dbname=proyecto",$usuario,$contrasenia);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // $sql= "SELECT * FROM usuarios WHERE";
        // $conect->exec($sql);

        // $sentencia=$conect->prepare($sql);

        // $sentencia->execute();

        // $resultado=$sentencia->fetchAll();

        // $stmt->bindParam();
                // binvalue;

        }

}

        // // Con esta clase se hará la coenccion a la base de datos.

        // // Todas las otras clases la tomaran como herencia

        // public $conn;
        // function __construct() {
        //     $this->conn = new mysqli('localhost' ,'root', '', 'proyecto');
        //     if ($this->conn->connect_error) {
        //         die("Error en la conexión: " . $conn->connect_error);
        //     }
        // }
        // // y este codigo es para que cuando ya no se utilize se desconecte la base de datos

        // // Intente optimizarla lo mas que pude
        // // Este no es mi lenguaje

        // function __destruct(){
        //     $this->conn->close();
        // }
    
?>