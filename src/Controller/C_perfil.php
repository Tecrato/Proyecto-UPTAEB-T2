<?php
    require('../Model/Conexion.php');
    require('../Model/Usuarios.php');
    include("./funcs/verificar.php");


    $result = new Usuario();
    $result = $result->search();
    $tu = new Usuario(id:$_SESSION['user_id']);
    $tu = $tu->search()[0];

    include('../View/perfil.php');
?>