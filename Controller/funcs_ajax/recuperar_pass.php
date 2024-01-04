<?php
	$co = $_GET['email'];
	$var = exec('mandar_correo.py "'.$co.'" "testo cambiado"');
	var_dump($var);
?>
