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
    
?>