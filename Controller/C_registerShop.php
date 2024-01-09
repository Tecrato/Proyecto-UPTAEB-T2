<?php 
	include("./funcs/verificar.php");
	echo '<script>var sesion_user_id = '.$_SESSION['user_id'].';</script>';
	echo '<script>var sesion_user_name = "'.$_SESSION['user_name'].'";</script>';
	include('../View/registerShop.php');
?>