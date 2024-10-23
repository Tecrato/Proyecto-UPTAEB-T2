<?php
// require_once __DIR__ . '../../../vendor/autoload.php';
require("../../vendor/autoload.php");


    // require('../Model/Conexion.php');
    // require('../Model/Usuarios.php');
    // include("./funcs/verificar.php");
    
    use Shtechnologyx\Pt3\Model\Usuario;
    // use Shtechnologyx\Pt3\Controller\funcs\verificar;;
    use Shtechnologyx\Pt3\Model\Producto;
    use Shtechnologyx\Pt3\Model\Cliente;
    use Shtechnologyx\Pt3\Model\Proveedor;
    use Shtechnologyx\Pt3\Model\Registro_ventas;

    $result = new Producto(active:1);
    $result = $result->search(limite: 5,order: ' id DESC');

    $cliente = new Cliente();
    $cliente = $cliente->COUNT();

    $proveedor = new Proveedor();
    $proveedor = $proveedor->COUNT();

    $factura = new Registro_ventas();
    $factura = $factura->COUNT();

    include('../View/index.php');



?>