<?php
    if ($_SESSION['rol_num'] > 2) {
        header('Location: ../../Inicio');
        die();
    }
?>