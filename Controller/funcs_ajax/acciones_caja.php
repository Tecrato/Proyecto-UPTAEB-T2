<?php
    session_start();
    require("../funcs/verificar_admin_funcs.php");
    require('../../Model/Conexion.php');
    require('../../Model/Cajas.php');


    if ($_POST['accion'] == 'abrir') {
        $clase = new Caja(null,$_SESSION['user_id'],$_POST['monto_inicial']);
        $clase->abrir();
    }
    else if ($_POST['accion'] == 'cerrar') {
        $clase = new Caja(null,$_SESSION['user_id']);
        $clase->cerrar();
    }
    else if ($_POST['accion'] == 'check') {
        $otra_clase_mas = new Caja(id_usuario:$_SESSION['user_id'], estado:0);
        $ultima_caja = $otra_clase_mas->buscar_ultima();
        if ($ultima_caja == NULL) {
            echo json_encode(['status' => 'error','estado'=>'no']);
            exit(0);
            die();
        }
        echo json_encode(['status' => 'active','estado'=>'si']);
    }
?>