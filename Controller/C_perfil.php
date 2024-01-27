<?php
    include("./funcs/verificar.php");
    require('../Model/Conexion.php');
    require("../Model/Usuarios.php");


    if (isset($_GET['p'])){
        $num = $_GET['p'];
    }else {
        $num = 0;
    }


    $result = new Usuario();
    $result = $result->search();
    $tu = new Usuario(id:$_SESSION['user_id']);
    $tu = $tu->search()[0];

    include('../View/perfil.php');

    echo '<script>var type_page = "usuario";</script>';
?>