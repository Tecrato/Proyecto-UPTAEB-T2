<?php
	require('../../Model/Conexion.php');
	require('../../Model/Productos.php');
	$clase = new Producto();
	print_r ($clase->search_stock(4)['stock']);
?>