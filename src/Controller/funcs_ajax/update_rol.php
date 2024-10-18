<?php
    session_start();
    require('../../Model/Conexion.php');
    require('../../Model/Usuarios.php');
    include("../funcs/verificar.php");

    $clase = new Usuario($_POST["id"],rol:$_POST["rol"]); 
    $clase->cambiar_rol();
?>
