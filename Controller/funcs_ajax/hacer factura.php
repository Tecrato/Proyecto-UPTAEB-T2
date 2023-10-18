<?php
	require('../../Model/Conexion.php');
	require('../../Model/Lotes.php');
	require('../../Model/Registro de ventas.php');
	require('../../Model/Facturas.php');

	$json = json_encode($nose);
	$json = json_decode($json);

	// $clase->descontar(1,20)
	$clase2->agregar($nose);
?>