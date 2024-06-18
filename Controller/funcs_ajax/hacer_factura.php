<?php
    session_start();
    require("../funcs/verificar_admin_funcs.php");
	require('../../Model/Conexion.php');
	require('../../Model/Entradas.php');
	require('../../Model/Registro de ventas.php');
	require('../../Model/Facturas.php');
	require('../../Model/Pagos.php');


	$var = json_decode($_POST['jsonString']);
	// print_r($var->IVA);

	
	$clase2 = new Registro_ventas(null,$var->monto_final,$var->id_cliente,$var->id_usuario,$var->IVA);
	$clase2->agregar($_SESSION['user_id'], $var->detalles, $var->pagos);
	echo 'hola';
?>