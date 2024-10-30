<?php
    // Con este archivo se buscan datos de ciertas maneras, dependiendo de lo que pase como "randomnautica"
    
    use Shtechnologyx\Pt3\model\Db_base;
    use Shtechnologyx\Pt3\model\Usuario;
    include("Controller/funcs/verificar.php");
    use Shtechnologyx\Pt3\model\Permisos;
    use Shtechnologyx\Pt3\model\Bitacora;
    
    
    $limite = isset($_POST['limite']) ? intval($_POST['limite']) : 50;
    $n = (isset($_POST['n']) and $_POST['n'] != "") ? intval($_POST['n']) : 0;
    $order = isset($_POST['order']) ? $_POST['order'] : " id ASC ";
    
    $other_class = new Permisos(null,$_SESSION['user_id'],$_POST['randomnautica'],'buscar');
    $result = $other_class->search();
    
    use Shtechnologyx\Pt3\model\Caja;
    use Shtechnologyx\Pt3\model\Capital;
    use Shtechnologyx\Pt3\Model\Notificacion;
    use Shtechnologyx\Pt3\Model\Categoria;
    use Shtechnologyx\Pt3\Model\Marca;
    use Shtechnologyx\Pt3\Model\Unidad;
    use Shtechnologyx\Pt3\Model\Cliente;
    use Shtechnologyx\Pt3\Model\Proveedor;
    use Shtechnologyx\Pt3\Model\Configuracion;
    use Shtechnologyx\Pt3\Model\Entrada;
    use Shtechnologyx\Pt3\Model\Detalle_entrada;
    use Shtechnologyx\Pt3\Model\Producto;
    use Shtechnologyx\Pt3\Model\Metodo_pago;
    use Shtechnologyx\Pt3\Model\Registro_ventas;
    use Shtechnologyx\Pt3\Model\Credito;
    use Shtechnologyx\Pt3\Model\Backup;
use Shtechnologyx\Pt3\Model\Tipo_empaquetado;

    if ($_POST['randomnautica'] == "caja") {
        $clase = new Caja(
            id_usuario:(isset($_POST['id_usuario']) ? $_POST['id_usuario'] : null),
        );
    }
    elseif ($_POST['randomnautica'] == "categorias") {
        $clase = new Categoria(
            id:(isset($_POST['ID']) ? $_POST['ID'] : null),
            nombre:(isset($_POST['nombre']) ? $_POST['nombre'] : null),
            like:(isset($_POST['like']) ? $_POST['like'] : '')
        );
    }
    elseif ($_POST['randomnautica'] == "clientes") {
        $clase = new Cliente(
            id:(isset($_POST['ID']) ? $_POST['ID'] : null),
            like_nombre:(isset($_POST['like_nombre']) ? $_POST['like_nombre'] : ''),
            like_cedula:(isset($_POST['like_cedula']) ? $_POST['like_cedula'] : ''),
        );
    }
    elseif ($_POST['randomnautica'] == "credito") {
        $clase = new Credito(
            id:(isset($_POST['ID']) ? $_POST['ID'] : null),
        );
    }
    elseif ($_POST['randomnautica'] == "configuraciones") {
        $clase = new Configuracion(
            key:(isset($_POST['llave']) ? $_POST['llave'] : null)
        );
    }
    elseif ($_POST['randomnautica'] == "marcas") {
        $clase = new Marca(
            id:(isset($_POST['id']) ? $_POST['id'] : null),
            nombre:(isset($_POST['nombre']) ? $_POST['nombre'] : null),
            like:(isset($_POST['like']) ? $_POST['like'] : '')
        );
    }
    elseif ($_POST['randomnautica'] == "metodo_pago") {
        $clase = new Metodo_pago();
    }
    elseif ($_POST['randomnautica'] == "empaquetado") {
        $clase = new Tipo_empaquetado(
            like:(isset($_POST['like']) ? $_POST['like'] : '')
        );
    }
    elseif ($_POST['randomnautica'] === 'notificaciones'){
        // require('Model/Notificaciones.php');
        $clase = new Notificacion(
            id:(isset($_POST['ID']) ? $_POST['ID'] : null),
            status:(isset($_POST['status']) ? $_POST['status'] : null),
        );
    }
    elseif ($_POST['randomnautica'] == "permiso") {  
        $clase = new Permisos(id_usuario:(isset($_POST['ID']) ? $_POST['ID'] : null));
    }
    elseif ($_POST['randomnautica'] == "productos") {
        $clase = new Producto(
            id:(isset($_POST['ID']) ? $_POST['ID'] : null),
            nombre:(isset($_POST['nombre']) ? $_POST['nombre'] : null),
            active:(isset($_POST['active']) ? $_POST['active'] : null),
            like_nombre:(isset($_POST['like_nombre']) ? $_POST['like_nombre'] : '')
        );
    }
    elseif ($_POST['randomnautica'] == "unidades") {
        $clase = new Unidad(
            id:(isset($_POST['id']) ? $_POST['id'] : null),
            nombre:(isset($_POST['nombre']) ? $_POST['nombre'] : null),
            like:(isset($_POST['like']) ? $_POST['like'] : '')
        );
    }
    elseif ($_POST['randomnautica'] == "usuario") {
        $clase = new Usuario(
            id:(isset($_POST['ID']) ? $_POST['ID'] : null),
            rol:(isset($_POST['rol']) ? $_POST['rol'] : null),
        );
    }
    elseif ($_POST['randomnautica'] == "ventas") {
        $clase = new Registro_ventas();
    }
    elseif ($_SESSION['rol_num'] > 1 and count($result) <= 0) {
        echo json_encode(['status' => 'error','error'=>'Permiso '.$_POST['randomnautica'].' Error (bueno ps)']);
        exit(0);
        die();
    }


    elseif ($_POST['randomnautica'] == "entradas") {
        $clase = new Entrada(
            id:(isset($_POST['ID']) ? $_POST['ID'] : null),
            id_proveedor:(isset($_POST['id_proveedor']) ? $_POST['id_proveedor'] : null),
            fecha_compra:(isset($_POST['fecha_compra']) ? $_POST['fecha_compra'] : null),
            codigo:(isset($_POST['codigo']) ? $_POST['codigo'] : null),
            detalles:(isset($_POST['detalles']) ? $_POST['detalles'] : null),
        );
    }
    elseif ($_POST['randomnautica'] == "detalles_entradas") {
        $clase = new Detalle_entrada(
            id:(isset($_POST['ID']) ? $_POST['ID'] : null),
            id_entrada:(isset($_POST['id_entrada']) ? $_POST['id_entrada'] : null),
            id_producto:(isset($_POST['id_producto']) ? $_POST['id_producto'] : null),
            mercancia:(isset($_POST['mercancia']) ? $_POST['mercancia'] : null),
            tamaño_mercancia:(isset($_POST['tamaño_mercancia']) ? $_POST['tamaño_mercancia'] : null),
            fecha_vencimiento:(isset($_POST['fecha_vencimiento']) ? $_POST['fecha_vencimiento'] : null),
            precio_compra:(isset($_POST['precio_compra']) ? $_POST['precio_compra'] : null),
            existencia:(isset($_POST['existencia']) ? $_POST['existencia'] : null),
            cantidad:(isset($_POST['cantidad']) ? $_POST['cantidad'] : null),
        );
    }
    elseif ($_POST['randomnautica'] == "proveedores") {
        $clase = new Proveedor(
            id:(isset($_POST['ID']) ? $_POST['ID'] : null),
            like:(isset($_POST['like']) ? $_POST['like'] : ''),
            active:(isset($_POST['active']) ? $_POST['active'] : 1)
        );
    }
    elseif ($_POST['randomnautica'] == "capital") {
        $clase = new Capital();
    }
    elseif ($_POST['randomnautica'] == "backup") {  
        require('Model/Backup.php');
        $clase = new Backup();
    }
    elseif ($_POST['randomnautica'] == "bitacora") {
        $clase = new Bitacora(
            id:(isset($_POST['ID']) ? $_POST['ID'] : null),
            id_usuario:(isset($_POST['id_usuario']) ? $_POST['id_usuario'] : null),
            tabla:(isset($_POST['tabla']) ? $_POST['tabla'] : null),
            accion:(isset($_POST['accion']) ? $_POST['accion'] : null),
        );
    }

    
    $count = $clase->COUNT();

    if (isset($_POST['subFunction'])) {
        if ($_POST['subFunction'] == 'count') {
            $result = $count;
        }
        else if ($_POST['subFunction'] == 'detallesCapital') {
            $result = $clase->detallesCapital();
        }
    }
    else {
        $result = $clase->search($n,$limite, $order);
    }

    $json = [
        'total' => $count,
        'lista'=> $result
    ];
    $json = json_encode($json);
    echo($json);
?>