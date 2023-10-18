<?php
	require('../../Model/Conexion.php');
	require('../../Model/Lotes.php');
	require('../../Model/Registro de ventas.php');
	require('../../Model/Facturas.php');
	$clase = new Lote();
	$clase2 = new Registro_ventas();
	// $resultado = $clase->search_luis();
	// while ($row = $resultado->fetch_assoc()) {
    //     print_r($row);
    //     echo "<br>";
    // };
    $nose = [
			"cliente" => 1,
			"fecha" => null,
			"vendedor" => 1,
			"total" => 20,
			"metodo" => "tarjeta",
			"detalles" => [
				[ 
					"id" => 1,
					"cantidad" =>  3,
					"precio" =>  20,
				],
				[
					"id" => 4,
					"cantidad" =>  4,
					"precio" =>  19,
				]
			]
		];
	$json = json_encode($nose);
	$json = json_decode($json);

	// $clase->descontar(1,20)
	$clase2->agregar($nose);

?>