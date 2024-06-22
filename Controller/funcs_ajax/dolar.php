<?php
    session_start();
    require("../../Model/Conexion.php");
    require("../../Model/Configuraciones.php");

    
    if ($_POST['accion'] == 'set') {
        require("../funcs/verificar_admin_funcs.php");
        $clase = new Configuracion();
        $clase->setDolar($_POST['dolar']);
        $clase->actualizar();
        echo json_encode(['status' => 'success']);
        exit(0);
    } else if ($_POST['accion'] == 'get') {
        $clase = new Configuracion();
        echo json_encode(['status' => 'success', 'dolar' => $clase->getDolar()]);
    }

    echo json_encode(['status' => 'success']);
?>