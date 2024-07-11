<?php
    // Con este codigo de destruye la session
    // No quedara nada
    session_start();
    require '../../Model/Conexion.php';
    require '../../Model/Usuarios.php';

    $usu = new Usuario($_SESSION['user_id']);
    $usu->logout();

    $d = new DB();
    $d->add_bitacora($_SESSION['user_id'],"deslogin","des-logueado","el usuario ".$_SESSION['user_name']." se des-logueo");
    session_destroy();
    header("Location:login"); // Y pal login
?>