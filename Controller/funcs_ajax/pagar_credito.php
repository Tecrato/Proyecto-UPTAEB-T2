<?php
    require('../../Model/Conexion.php');
    require('../../Model/Usuarios.php');
    include("../funcs/verificar.php");
    require_once("../../Model/Credito.php");
    require_once("../../Model/Pagos.php");


    print_r($_POST);
    $clase = new Credito(null,id_rv:$_POST["id_rv"]);

    $clase->pagar($_SESSION['user_id'],$_POST["pagos"]);

    echo json_encode(['status' => 'active']);
?>