<?php
    session_start();
    require("../funcs/verificar_admin_funcs.php");
	require('../../Model/Conexion.php');
	require('../../Model/Entradas.php');
	require('../../Model/Registro de ventas.php');
	require('../../Model/Facturas.php');
	require('../../Model/Pagos.php');
	require('../../Model/Cajas.php');


	$var = json_decode($_POST['jsonString']);
	// print_r($var->IVA);

	$otra_clase_mas = new Caja(id_usuario:$_SESSION['user_id'], estado:1);
	$ultima_caja = $otra_clase_mas->buscar_ultima();
	if ($ultima_caja == NULL) {
		echo json_encode(['status' => 'error','error'=>'Caja Error (sus-pechoso)']);
        exit(0);
        die();
	}
	
	$clase2 = new Registro_ventas(null,$var->monto_final,$var->id_cliente, $ultima_caja,$var->IVA);
	$clase2->agregar($_SESSION['user_id'], $var->detalles, $var->pagos);
	echo json_encode(['status' => 'eso','error'=>'Caja funciona (bienvenido)']);
?>