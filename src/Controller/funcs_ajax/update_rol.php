<?php
    session_start();
    require('../../Model/Conexion.php');
    require('../../Model/Usuarios.php');
    require('../../Model/Bitacora.php');
    include("../funcs/verificar.php");

    $clase = new Usuario($_POST["id"],rol:$_POST["rol"]); 
    $clase->cambiar_rol();
    $clase2 = new Bitacora(null,$_SESSION['user_id'],"Usuarios","Modificar","Usuario ".$_POST["nombre"]." Cambiado de rol");
    $clase2->agregar();
?>
