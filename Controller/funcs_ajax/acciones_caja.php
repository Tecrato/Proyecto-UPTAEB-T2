<?php
    session_start();
    require("./verificar_admin_funcs.php");
    require('../../Model/Conexion.php');
    require('../../Model/Cajas.php');


    if ($_POST['accion'] == 'abrir') {
        $clase = new Caja(null,$_SESSION['user_id'],$_POST['monto_inicial']);
        $clase->abrir();
    }
    else if ($_POST['accion'] == 'cerrar') {
        $clase = new Caja(null,$_SESSION['user_id']);
        $clase->abrir();
    }
?>