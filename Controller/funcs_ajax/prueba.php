<?php
    require '../../Model/Conexion.php';
    require '../../Model/Usuarios.php';

	// echo "
	// <form method='POST' action='Controller/funcs_ajax/search.php'>
	// 	<input type='text' name='randomnautica' value='stock_producto' />
	// 	<input type='number' name='ID' value=15 />
	// 	<input type='submit'/>
	// </form>

	// ";
	
	$c = new Usuarios();
	$resultado = $c->search();
	print_r($resultado);
?>