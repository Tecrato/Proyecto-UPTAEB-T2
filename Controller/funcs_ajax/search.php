<?php
    // Con este archivo se buscan datos de ciertas maneras, dependiendo de lo que pase como "randomnautica"

// use PSpell\Config;

    require('../../Model/Conexion.php');
    require('../../Model/Usuarios.php');
    include("../funcs/verificar.php");
    require('../../Model/Permisos.php');


    $limite = isset($_GET['limite']) ? intval($_GET['limite']) : 50;
    $n = (isset($_GET['n']) and $_GET['n'] != "") ? intval($_GET['n']) : 0;



    $other_class = new Permiso(null,$_SESSION['user_id'],$_GET['randomnautica'],'buscar');
    $result = $other_class->search();


    if ($_GET['randomnautica'] == "productos") {
        require('../../Model/Productos.php');
        $clase = new Producto(
            id:(isset($_GET['ID']) ? $_GET['ID'] : null),
            nombre:(isset($_GET['nombre']) ? $_GET['nombre'] : null),
            active:(isset($_GET['active']) ? $_GET['active'] : null),
            like:(isset($_GET['like']) ? $_GET['like'] : '')
        );
    }
    elseif ($_GET['randomnautica'] == "categorias") {
        require('../../Model/Categorias.php');
        $clase = new Categoria();
    }
    elseif ($_GET['randomnautica'] == "unidades") {
        require('../../Model/Unidades.php');
        $clase = new Unidad();
    }
    elseif ($_GET['randomnautica'] == "marcas") {
        require('../../Model/Marcas.php');
        $clase = new Marca();
    }
    elseif ($_GET['randomnautica'] == "bitacora") {
        $clase = new DB();
    }
    elseif ($_GET['randomnautica'] == "ventas") {
        require('../../Model/Registro de ventas.php');
        $clase = new Registro_ventas();
    }
    elseif ($_GET['randomnautica'] == "metodo_pago") {
        require('../../Model/Metodos_pagos.php');
        $clase = new Metodo_pago();
    }
    elseif ($_GET['randomnautica'] == "usuario") {
        $clase = new Usuario(
            id:(isset($_GET['ID']) ? $_GET['ID'] : null),
            rol:(isset($_GET['rol']) ? $_GET['rol'] : null),
        );
    }
    elseif ($_GET['randomnautica'] == "clientes") {
        require('../../Model/Clientes.php');
        $clase = new Cliente(
            id:(isset($_GET['ID']) ? $_GET['ID'] : null),
            like_nombre:(isset($_GET['like_nombre']) ? $_GET['like_nombre'] : ''),
            like_cedula:(isset($_GET['like_cedula']) ? $_GET['like_cedula'] : ''),
            
        );
    }
    elseif ($_GET['randomnautica'] == "configuraciones") {
        require('../../Model/Configuraciones.php');
        $clase = new Configuracion(
            key:(isset($_GET['llave']) ? $_GET['llave'] : null)
        );
    }
    
    elseif ($_GET['randomnautica'] == "permiso") {  
        $clase = new Permiso(id_usuario:(isset($_GET['ID']) ? $_GET['ID'] : null));
    }

    elseif ($_GET['randomnautica'] == "caja") {
        require('../../Model/Cajas.php');
        $clase = new Caja(
            id_usuario:(isset($_GET['id_usuario']) ? $_GET['id_usuario'] : null),
            
        );
    }
    elseif ($_GET['randomnautica'] === 'notificaciones'){
        require('../../Model/Notificaciones.php');
        $clase = new Notificacion(
            id:(isset($_GET['ID']) ? $_GET['ID'] : null),
            status:(isset($_GET['status']) ? $_GET['status'] : null),
    );
    }
    elseif ($_GET['randomnautica'] == "credito") {
        require('../../Model/Credito.php');
        $clase = new Credito(
            id:(isset($_GET['ID']) ? $_GET['ID'] : null),
        );
    }
    elseif ($_SESSION['rol_num'] > 1 and count($result) <= 0) {
        echo json_encode(['status' => 'error','error'=>'Permiso '.$_GET['randomnautica'].' Error (bueno ps)']);
        exit(0);
        die();
    }


    elseif ($_GET['randomnautica'] == "entradas") {
        require('../../Model/Entradas.php');
        $clase = new Entrada(
            id_producto: isset($_GET['id_producto']) ? $_GET['id_producto']: null,
            id_proveedor: isset($_GET['id_proveedor']) ? $_GET['id_proveedor']: null,
            active:(isset($_GET['active']) ? $_GET['active'] : 1));
    }
    elseif ($_GET['randomnautica'] == "proveedores") {
        require('../../Model/Proveedores.php');
        $clase = new Proveedor(
            id:(isset($_GET['ID']) ? $_GET['ID'] : null),
            like:(isset($_GET['like']) ? $_GET['like'] : ''),
            active:(isset($_GET['active']) ? $_GET['active'] : 1)
        );
    }
    elseif ($_GET['randomnautica'] == "capital") {  
        require('../../Model/Capital.php');
        $clase = new Capital();
    }

    
    $count = $clase->COUNT();

    if (isset($_GET['subFunction'])) {
        if ($_GET['subFunction'] == 'bitacora') {
            if (isset($_GET['ID'])){
                $count = $clase->COUNT_user($_GET['ID']);
            }
            $result = $clase->search_bitacora(id:(isset($_GET['ID']) ? $_GET['ID'] : null),n:$n,limite:$limite);
        }
        else if ($_GET['subFunction'] == 'count') {
            $result = $clase->COUNT();
        }
        else if ($_GET['subFunction'] == 'detallesCapital') {
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