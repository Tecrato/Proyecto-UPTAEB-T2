<?php
    session_start();
    require("Controller/funcs/verificar_admin_funcs.php");
	use Shtechnologyx\Pt3\model\Conexion;
	use Shtechnologyx\Pt3\model\Entrada;
	use Shtechnologyx\Pt3\model\Registro_ventas;
	use Shtechnologyx\Pt3\model\Factura;
	use Shtechnologyx\Pt3\model\Pago;
	use Shtechnologyx\Pt3\model\Caja;
	use Shtechnologyx\Pt3\model\Credito;
	use Shtechnologyx\Pt3\model\Bitacora;


	$var = json_decode($_POST['jsonString']);

	$otra_clase_mas = new Caja(id_usuario:$_SESSION['user_id'], estado:0);
	$ultima_caja = $otra_clase_mas->search()[0];
	if ($ultima_caja == NULL or count($ultima_caja) == 0) {
		echo json_encode(['status' => 'error','error'=>'Caja Error']);
        exit(0);
        die();
	}
	$clase2 = new Registro_ventas(
		id:null,
		monto_final:$var->monto_final,
		id_cliente:$var->id_cliente, 
		id_caja:$ultima_caja['id'],
		IVA:$var->IVA,
		active:$var->active
	);
	$result = $clase2->agregar_venta($var->detalles, $var->pagos, $var->credito, $var->fecha_inicio_credito, $var->fecha_cierre_credito,$var->monto_dolar);

	$clase3 = new Bitacora(null,$_SESSION['user_id'],"Caja","Cerrar","Caja cerrada");
    $clase3->agregar();
	
	if ($result == 1) {
		echo json_encode(['status' => 'active']);
	} else {
		echo json_encode(['status' => 'error','error'=>'Te ganaron']);
	}
?>