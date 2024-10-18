<?php
    // Con este codigo de destruye la session
    // No quedara nada
    session_start();
    require '../../Model/Conexion.php';
    require '../../Model/Usuarios.php';

    $usu = new Usuario($_SESSION['user_id']);
    $usu->logout($_SESSION['user_id']);

    session_destroy();
    header("Location:login"); // Y pal login
?>