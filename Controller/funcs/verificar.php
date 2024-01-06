<?php
    // Este es el codigo fusible de la pagina
    // Si alguien que no esta logueado entra, pal login
    session_start();
    if (!isset($_SESSION['user_name'])) {
        header('Location:login');
    }
?>