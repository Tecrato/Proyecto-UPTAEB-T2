<?php
    require('../Model/Conexion.php');
    require("../Model/Usuarios.php");


    if (isset($_GET['p'])){
        $num = $_GET['p'];
    }else {
        $num = 0;
    }

    $result = new Usuarios;
    $result = $result->search();

    include('../View/perfil.php');
    
    echo '<script>var type_page = "usuario";</script>';
?>