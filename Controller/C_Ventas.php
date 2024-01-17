<?php 
	include("./funcs/verificar.php");
    require('../Model/Conexion.php');

    echo '<script>var sesion_user_id = '.$_SESSION['user_id'].';</script>';
    echo '<script>var sesion_user_name = "'.$_SESSION['user_name'].'";</script>';
    
    if (isset($_GET['p'])){
        $num = $_GET['p'];
    }else {
        $num = 0;
    }

    require('../Model/Registro de ventas.php');
    $result = new Registro_ventas();
    $result = $result->search(n:$num);

	include('../View/registerShop.php');


    echo '<script>var page = '.$num.';</script>';
?>