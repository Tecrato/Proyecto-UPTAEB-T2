<?php
	require('../../Model/Conexion.php');
	require('../../Model/Lotes.php');
	$clase = new Lote();
	// $resultado = $clase->search_luis();
	// while ($row = $resultado->fetch_assoc()) {
    //     print_r($row);
    //     echo "<br>";
    // };
    $nose = [
			"cliente" => "id_cliente",
			"fecha" => "fecha",
			"vendedor" => "eso",
			"total" => "dinero",
			"detalles de la factra" => [
				[ 
					"id_producto" => 1,
					"cantidad" =>  1,
					"precio total" =>  20,
				],
				[
					"id_producto" => 4,
					"cantidad" =>  10,
					"precio total" =>  19,
				]
			]
		];
	$json = json_encode($nose);
	$json = json_decode($json);

	$clase->descontar(1,20)

?>