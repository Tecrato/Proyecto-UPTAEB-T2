<?php
session_start();
require("../funcs/verificar_admin_funcs.php");
require('../../Model/Conexion.php');
require('../../Model/Cajas.php');
require('../../Model/Permisos.php');



if ($_POST['accion'] == 'abrir') {

    $other_class = new Permiso(null,$_SESSION['user_id'],'caja','agregar');
    $result = $other_class->search();
    if ($_SESSION['rol_num'] > 1 and count($result) <= 0) {
        echo json_encode(['status' => 'error','error'=>'Permiso Error (bueno ps)']);
        exit(0);
        die();
    }
    $otra_clase_mas = new Caja(id_usuario: $_POST['user_id'], estado: 0);
    $ultima_caja = $otra_clase_mas->buscar_ultima();

    if (count($ultima_caja) > 0) {
        echo json_encode(['status' => 'error', 'estado' => 'mas cajas no']);
        exit(0);
        die();
    }
    $clase = new Caja(null, $_POST['user_id'], $_POST['monto_inicial']);
    $clase->abrir();
} else if ($_POST['accion'] == 'cerrar') {
    $other_class = new Permiso(null,$_SESSION['user_id'],'caja','modificar');
    $result = $other_class->search();
    if ($_SESSION['rol_num'] > 1 and count($result) <= 0) {
        echo json_encode(['status' => 'error','error'=>'Permiso Error (bueno ps)']);
        exit(0);
        die();
    }

    $otra_clase_mas = new Caja(id: $_POST['id_caja'], estado: 0);
    $ultima_caja = $otra_clase_mas->search();
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
