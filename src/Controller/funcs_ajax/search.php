<?php
    // Con este archivo se buscan datos de ciertas maneras, dependiendo de lo que pase como "randomnautica"

// use PSpell\Config;

    require('Model/Conexion.php');
    require('Model/Usuarios.php');
    include("Controller/funcs/verificar.php");
    require('Model/Permisos.php');
    require('Model/Bitacora.php');
    require('Model/Db_base.php');


    $limite = isset($_POST['limite']) ? intval($_POST['limite']) : 50;
    $n = (isset($_POST['n']) and $_POST['n'] != "") ? intval($_POST['n']) : 0;



    $other_class = new Permiso(null,$_SESSION['user_id'],$_POST['randomnautica'],'buscar');
    $result = $other_class->search();


    if ($_POST['randomnautica'] == "caja") {
        require('Model/Cajas.php');
        $clase = new Caja(
            id_usuario:(isset($_POST['id_usuario']) ? $_POST['id_usuario'] : null),
            
        );
    }
    elseif ($_POST['randomnautica'] == "categorias") {
        require('Model/Categorias.php');
        $clase = new Categoria(
            id:(isset($_POST['ID']) ? $_POST['ID'] : null),
            nombre:(isset($_POST['nombre']) ? $_POST['nombre'] : null),
            like:(isset($_POST['like']) ? $_POST['like'] : '')
        );
    }
    elseif ($_POST['randomnautica'] == "clientes") {
        require('Model/Clientes.php');
        $clase = new Cliente(
            id:(isset($_POST['ID']) ? $_POST['ID'] : null),
            like_nombre:(isset($_POST['like_nombre']) ? $_POST['like_nombre'] : ''),
            like_cedula:(isset($_POST['like_cedula']) ? $_POST['like_cedula'] : ''),
        );
    }
    elseif ($_POST['randomnautica'] == "credito") {
        require('Model/Credito.php');
        $clase = new Credito(
            id:(isset($_POST['ID']) ? $_POST['ID'] : null),
        );
    }
    elseif ($_POST['randomnautica'] == "configuraciones") {
        require('Model/Configuraciones.php');
        $clase = new Configuracion(
            key:(isset($_POST['llave']) ? $_POST['llave'] : null)
        );
    }
    elseif ($_POST['randomnautica'] == "marcas") {
        require('Model/Marcas.php');
        $clase = new Marca(
            id:(isset($_POST['id']) ? $_POST['id'] : null),
            nombre:(isset($_POST['nombre']) ? $_POST['nombre'] : null),
            like:(isset($_POST['like']) ? $_POST['like'] : '')
        );
    }
    elseif ($_POST['randomnautica'] == "metodo_pago") {
        require('Model/Metodos_pagos.php');
        $clase = new Metodo_pago();
    }
    

    elseif ($_POST['randomnautica'] === 'notificaciones'){
        require('Model/Notificaciones.php');
        $clase = new Notificacion(
            id:(isset($_POST['ID']) ? $_POST['ID'] : null),
            status:(isset($_POST['status']) ? $_POST['status'] : null),
        );
    }
    elseif ($_POST['randomnautica'] == "permiso") {  
        $clase = new Permiso(id_usuario:(isset($_POST['ID']) ? $_POST['ID'] : null));
    }
    elseif ($_POST['randomnautica'] == "productos") {
        require('Model/Productos.php');
        $clase = new Producto(
            id:(isset($_POST['ID']) ? $_POST['ID'] : null),
            nombre:(isset($_POST['nombre']) ? $_POST['nombre'] : null),
            active:(isset($_POST['active']) ? !$_POST['active'] : null),
            like:(isset($_POST['like']) ? $_POST['like'] : '')
        );
    }
    elseif ($_POST['randomnautica'] == "unidades") {
        require('Model/Unidades.php');
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
        require('Model/Registro de ventas.php');
        $clase = new Registro_ventas();
    }
    elseif ($_SESSION['rol_num'] > 1 and count($result) <= 0) {
        echo json_encode(['status' => 'error','error'=>'Permiso '.$_POST['randomnautica'].' Error (bueno ps)']);
        exit(0);
        die();
    }


    elseif ($_POST['randomnautica'] == "entradas") {
        require('Model/Detalles_entradas.php');
        $clase = new Detalle_entrada(
            id_producto: (isset($_POST['id_producto']) ? $_POST['id_producto']: null),
        );
    }
    elseif ($_POST['randomnautica'] == "proveedores") {
        require('Model/Proveedores.php');
        $clase = new Proveedor(
            id:(isset($_POST['ID']) ? $_POST['ID'] : null),
            like:(isset($_POST['like']) ? $_POST['like'] : ''),
            active:(isset($_POST['active']) ? $_POST['active'] : 1)
        );
    }
    elseif ($_POST['randomnautica'] == "capital") {  
        require('Model/Capital.php');
        $clase = new Capital();
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
        $result = $clase->search(n:$n,limite:$limite);
    }

    $json = [
        'total' => $count,
        'lista'=> $result
    ];
    $json = json_encode($json);
    echo($json);
?>