<?php
// class frontOld{
//     $page = "login"; // default
//     $type = "view"; // default

//     if (isset($_GET['page'])){
//         $page = $_GET['page'];
//     }
//     if (isset($_GET['type'])){
//         $type = $_GET['type'];
//     }
    
//     if ($type == "view"){
//         require_once('Controller/C_'.$page.'.php');
//         exit(0);
//     }
//     else if ($type == "funcion"){
//         require_once('Controller/funcs/'.$page.'.php');
//         exit(0);
//     }
//     else if ($type == "funcion_ajax"){
//         require_once('Controller/funcs_ajax/'.$page.'.php');
//         exit(0);
//     }
// }

// FRONT BY ANONYMOUS01J
session_start();
$ruta = isset($_GET['c'])? $_GET['c']: "CLogin/viewLogin";

$partes = explode("/", $ruta);

$nomClase = ucfirst($partes['0']);

$metodo = isset($partes['1'])? $partes['1']: "viewLogin";

$url = "Controlador/".$partes['0'].".php";

if (file_exists($url)) {

	require_once $url;

	$instancia = new $nomClase();

	if (method_exists($instancia, $metodo)) {
		
		$instancia->$metodo();
	}else{
		echo "NO EXISTE EL METODO";
	}

}else{
	echo "NO EXISTE EL CONTROLADOR";
}

