<?php
	$co = $_GET['email'];
	$var = exec('mandar_correo.py "'.$co.'" "testo cambiado"');
	prin_r($var);
?>
