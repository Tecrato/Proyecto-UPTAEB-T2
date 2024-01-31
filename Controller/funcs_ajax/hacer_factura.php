<?php
	require('../../Model/Conexion.php');
	require('../../Model/Entradas.php');
	require('../../Model/Registro de ventas.php');
	require('../../Model/Facturas.php');


	$var = json_decode($_POST['jsonString']);
	// print_r($var->IVA);

	$clase2 = new Registro_ventas(null,$var->monto_final,$var->metodo_pago,$var->id_cliente,$var->id_usuario,$var->IVA);
	$clase2->agregar($var->detalles);
	echo 'hola';
?>