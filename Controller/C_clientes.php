<?php 
	include('../View/client.php');
	
?>
<?php
    require('../Model/Conexion.php');
    if (isset($_GET['p'])){
        $num = $_GET['p'];
    }
    // else {
    //     header('Location:clientes');
    // }
    require('../Model/Clientes.php');
    $result = new Cliente;
    $result = $result->search();
    include('../View/client.php');
    echo '<script>var type_page = "cliente";</script>';
?>