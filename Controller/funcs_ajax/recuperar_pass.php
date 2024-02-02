<?php
	$correo = $_GET['email'];

    require('../../Model/Conexion.php');
    require('../../Model/Usuarios.php');

    $clase = new Usuario(correo:$correo);
    $clave = $clase->search()[0]['password'];
	print_r($clave);
	$var = exec('mandar_correo.py "'.$correo.'" "Tu contraseña para el sistema Minimarket es es: '.$clave.'"');
	var_dump($var);
?>
