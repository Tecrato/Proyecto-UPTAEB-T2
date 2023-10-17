<?php
	require('../../Model/Conexion.php');
	require('../../Model/Productos.php');
	$clase = new Producto();
	$resultado = $clase->search_luis();
	while ($row = $resultado->fetch_assoc()) {
        print_r($row);
        echo "<br>";
    };
?>