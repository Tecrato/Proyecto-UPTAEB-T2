<?php
    require '../../Model/Conexion.php';
    require '../../Model/Productos.php';

	// echo "
	// <form method='POST' action='Controller/funcs_ajax/search.php'>
	// 	<input type='text' name='randomnautica' value='stock_producto' />
	// 	<input type='number' name='ID' value=15 />
	// 	<input type='submit'/>
	// </form>

	// ";
	
	
	// $c = new Usuario();
	// $resultado = $c->search();
	// print_r($resultado);
	
	// echo(False ? '10': '20');

	// echo '10';


	// $args = [
	// 	0 => 'tabla2',
	// 	1 => 'limit',
	// 	2 => 'offset',
	// ];

	// print_r($args);
	// $args2 = [
	// 	0 => 'limit',
	// 	1 => 'offset',
	// ]
	// $arg2 = 'id_cliente'

	// 'SELECT * FROM tabla1z INNER JOIN tabla2 b ON b.id = a.'.$arg2
	// "SELECT a.id ,a.monto_final, a.metodo_pago, b.nombre FROM registro_ventas a INNER JOIN clientes b ON b.id = a.id_cliente AND a.metodo_pago = 'Transferencia'";
    // $clase = new Producto();
    // $result = $clase->search();

    // for ($i=0; $i < count($result); $i++) { 
	// 	print_r('<br>');
	// 	print_r('<br>');
	// 	print_r('<br>');
	// 	print_r('<br>');
    // 	print_r($result[$i]);
    // }
    $a = null;
	print_r($a ? 'true' : 'false');


?>