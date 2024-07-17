<?php
session_start();
require("../funcs/verificar_admin_funcs.php");
require('../../Model/Conexion.php');
require('../../Model/Cajas.php');


if ($_POST['accion'] == 'abrir') {
    $clase = new Caja(null, $_POST['user_id'], $_POST['monto_inicial']);
    $clase->abrir();
} else if ($_POST['accion'] == 'cerrar') {
    $otra_clase_mas = new Caja(id: $_POST['id_caja'], estado: 0);
    $ultima_caja = $otra_clase_mas->search();
    print_r($ultima_caja);
    if (count($ultima_caja) == 0) {
        echo json_encode(['status' => 'error', 'estado' => 'no']);
        exit(0);
        die();
    }
    $clase = new Caja(id: $_POST['id_caja']);
    $clase->cerrar();
    echo json_encode(['status' => 'active', 'estado' => 'si']);
} else if ($_POST['accion'] == 'check') {
    $otra_clase_mas = new Caja(id_usuario: $_SESSION['user_id'], estado: 0);
    $ultima_caja = $otra_clase_mas->buscar_ultima();
    if ($ultima_caja == NULL) {
        echo json_encode(['status' => 'error', 'estado' => 'no']);
        exit(0);
        die();
    } else if ($ultima_caja['estado'] == 1) {
        echo json_encode(['status' => 'error', 'estado' => 'no']);
        exit(0);
        die();
    }
    echo json_encode(['status' => 'active', 'estado' => 'si']);
}
