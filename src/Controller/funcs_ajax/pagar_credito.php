<?php
    require('../../Model/Conexion.php');
    require('../../Model/Usuarios.php');
    include("../funcs/verificar.php");
    require_once("../../Model/Credito.php");
    require_once("../../Model/Pagos.php");
    require('../../Model/Permisos.php');

    $other_class = new Permiso(null,$_SESSION['user_id'],"credito",'modificar');
    $result = $other_class->search();


    if ($_SESSION['rol_num'] > 1 and count($result) <= 0) {
        echo json_encode(['status' => 'error','error'=>'Permiso credito Error (bueno ps)']);
        exit(0);
        die();
    }


    print_r($_POST);
    $clase = new Credito(null,id_rv:$_POST["id_rv"]);

    $clase->pagar($_POST["pagos"]);

    $clase2 = new Bitacora(null,$_SESSION['user_id'],"Credito","Pagado","Credito pagado");
    $clase2->agregar();

    echo json_encode(['status' => 'active']);
?>