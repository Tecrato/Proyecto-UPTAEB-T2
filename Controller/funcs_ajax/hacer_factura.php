<?php
	require('../../Model/Conexion.php');
	require('../../Model/Lotes.php');
	require('../../Model/Registro de ventas.php');
	require('../../Model/Facturas.php');
	$clase = new Lote();
	$clase2 = new Registro_ventas();

	$var = json_decode($_POST['jsonString']);

	echo "Aparentemente";

	print_r($var);

	$clase2->agregar($var);

?>