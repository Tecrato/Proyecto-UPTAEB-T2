<?php
    require '../../Model/Conexion.php';
    require '../../Model/Productos.php';


	// $clase = new Producto();
	// $result = $clase->stock_segun_categorias();
	// print_r($result);
	// echo "
	// <form method='POST' action='Controller/funcs_ajax/search.php'>
	// 	<input type='text' name='randomnautica' value='stock_producto' />
	// 	<input type='number' name='ID' value=15 />
	// 	<input type='submit'/>
	// </form>

	// ";
	// $consulta = $this->conn->prepare("SELECT 
	// a.id, 
	// b.nombre categoria,
	// c.nombre unidad,
	// a.nombre,
	// a.marca,
	// a.imagen,
	// (SELECT SUM(entradas.existencia) FROM entradas Where id_producto = a.id) as stock,
	// a.stock_min,
	// a.stock_max,
	// a.precio_venta,
	// a.IVA
	// FROM productos a 
	// INNER JOIN categoria b ON b.id = a.id_categoria 
	// INNER JOIN unidades c ON c.id = a.id_unidad
	// WHERE a.nombre LIKE :como AND
	// active = 1 
	// ");

	// $this->like = '%'.$this->like.'%';
    // $consulta->bindParam(':como',$this->like, PDO::PARAM_STR);
	
	
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

	// array_push($args, ['0' => 'id', '1' => '2']);
	// array_push($args, ['nose' => 'a']);
	// array_push($args, ['a' => 'new']);


	// foreach ($args as $key) {
	// 	print_r($key);
	// }

	// print_r(array_keys($args));

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
    // $a = null;
	// print_r($a ? 'true' : 'false');

    // Generar una semilla aleatoria
    $semilla = rand(); // Opcionalmente, puedes usar mt_rand() en lugar de rand()
    
    // Usar la semilla para generar una cadena alfanumérica aleatoria
    $longitud = 10; // Define la longitud de la cadena
    $cadena_aleatoria = substr(str_shuffle(str_repeat($semilla, $longitud)), 0, $longitud);
	echo $cadena_aleatoria.'<br>';

	$var = '8aaa';
	if ($var and !preg_match("/^[a-z][a-z0-9]{2,20}$/", $var)){
		throw new Exception('El id esta mal');
	}
?>