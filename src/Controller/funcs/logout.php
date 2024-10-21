<?php
    // Con este codigo de destruye la session
    // No quedara nada
    session_start();
    require '../../Model/Conexion.php';
    require '../../Model/Usuarios.php';
    require '../../Model/Bitacora.php';

    $usu = new Usuario($_SESSION['user_id']);
    $usu->logout();

    $clase2 = new Bitacora(null,$_SESSION['user_id'],"Usuarios","Logout","Usuario ".$_SESSION['user_name']." des-logueado");
    $clase2->agregar();

    session_destroy();
    header("Location:login"); // Y pal login
?>