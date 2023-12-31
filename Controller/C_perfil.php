<?php
    require('../Model/Conexion.php');
    include("../Model/Usuarios.php");

    if (isset($_GET['p'])){
        $num = $_GET['p'];
    }

    $result = new Usuarios;
    $result = $result->search();
    include('../View/perfil.php');
    echo '<script>var type_page = "usuario";</script>';
?>