<?php
    session_start();
    require("../funcs/verificar_admin_funcs.php");
	require('../../Model/Conexion.php');
	require('../../Model/Entradas.php');
	require('../../Model/Registro de ventas.php');
	require('../../Model/Facturas.php');
	require('../../Model/Pagos.php');
	require('../../Model/Cajas.php');
	require('../../Model/Credito.php');


	$var = json_decode($_POST['jsonString']);

	$otra_clase_mas = new Caja(id_usuario:$_SESSION['user_id'], estado:0);
	$ultima_caja = $otra_clase_mas->buscar_ultima();
	print_r($ultima_caja);
	if ($ultima_caja == NULL) {
		echo json_encode(['status' => 'error','error'=>'Caja Error (sus-pechoso)']);
        exit(0);
        die();
	}
	print_r("en contr mewdio");
	print_r($ultima_caja);
	$clase2 = new Registro_ventas(null,$var->monto_final,$var->id_cliente, $ultima_caja['0'],$var->IVA);
	print_r("en contr mewdio-abajoo");
	print_r($var);
	$result = $clase2->agregar($_SESSION['user_id'], $var->detalles, $var->pagos, $var->credito, $var->fecha_inicio_credito, $var->fecha_cierre_credito);
	
	print_r("en contr mewdio-abajoo");
	print_r($result);
	if ($result == 1) {
		echo json_encode(['status' => 'active']);
	} else {
		echo json_encode(['status' => 'error','error'=>'Te ganaron']);
	}
?>