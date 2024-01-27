<?php
    if ($_SESSION['rol'] != 'Administrador') {
        header('Location: ../../Inicio');
    }
?>