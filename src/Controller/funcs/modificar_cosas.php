<?php
    session_start();
    require('Model/Conexion.php');
    require('Model/Permisos.php');
    require('Model/Bitacora.php');
    require('Model/Db_base.php');
    require("Controller/funcs/verificar_admin_funcs.php");
    require 'subir_imagen.php';
    $tipo = $_POST['tipo']; // Depende de que es lo que queramos actualizar

    $other_class = new Permiso(null,$_SESSION['user_id'],$tipo,'modificar');
    $result = $other_class->search();

    if ($_SESSION['rol_num'] > 1 and count($result) <= 0) {
        echo json_encode(['status' => 'error','error'=>'Permiso Error (bueno ps)']);
        exit(0);
        die();
    }

    if ($tipo === 'producto'){
        if ($_FILES['imagen1']['name'] != "") {
            if (file_exists('Media/imagenes/'.$_POST['old_img'])) {
                unlink('Media/imagenes/'.$_POST['old_img']);
            }
            print_r('Media/imagenes/'.$_POST['old_img']);
            $imagen = $_FILES['imagen1'];
            $nick = "producto_".$_POST['nombre'] . "_" . $imagen['name'];
            $img_err = subir_imagen($imagen,$nick);
            if ($img_err != false){
                if ($img_err != 3){
                    unlink('Media/imagenes/'.$nick);
                }
                die();
            }
        }
        else {
            $imagen = null;
            $nick = null;
        }

        require('Model/Productos.php');
        $clase = new Producto(
            $_POST['ID'],
            isset($_POST['categoria']) ? $_POST['categoria'] : null,
            isset($_POST['unidad']) ? $_POST['unidad'] : null,
            isset($_POST['marca']) ? $_POST['marca'] : null,
            isset($_POST['valor_unidad']) ? $_POST['valor_unidad'] : null,
            isset($_POST['nombre']) ? $_POST['nombre'] : null,
            $nick,
            isset($_POST['stock_min']) ? $_POST['stock_min'] : null,
            isset($_POST['stock_max']) ? $_POST['stock_max'] : null,
            isset($_POST['precio_venta']) ? $_POST['precio_venta'] : null,
            isset($_POST['IVA']) ? $_POST['IVA'] : null,
            isset($_POST['codigo']) ? $_POST['codigo'] : null,
            1,
            isset($_POST['algoritmo']) ? $_POST['algoritmo'] : null
        );

        try {
            $clase->actualizar();
        } catch (Exception $e) {
            echo $e;
            echo json_encode(['status' => 'error','error'=>'No es posible actualizar el producto']);
            die();
        }
    }
    elseif ($tipo === 'proveedor'){
        require('Model/Proveedores.php');
        $clase = new Proveedor(
            $_POST['ID'],
            isset($_POST['nombre']) ? $_POST['nombre'] : null,
            isset($_POST['razon_social']) ? $_POST['razon_social'] : null,
            isset($_POST['T-D']) ? $_POST['T-D'] : null,
            isset($_POST['rif']) ? $_POST['rif'] : null,
            isset($_POST['TLFNO']) ? $_POST['TLFNO'] : null,
            isset($_POST['correo']) ? $_POST['correo'] : null,
            isset($_POST['direccion']) ? $_POST['direccion'] : null
        );
        $clase->actualizar();
    }
    elseif ($tipo === 'cliente'){
        require('Model/Clientes.php');
        $clase = new Cliente(
            $_POST['ID'],
            isset($_POST['nombre']) ? $_POST['nombre'] : null,
            isset($_POST['cedula']) ? $_POST['cedula'] : null,
            isset($_POST['apellido']) ? $_POST['apellido'] : null,
            isset($_POST['documento']) ? $_POST['documento'] : null,
            isset($_POST['direccion']) ? $_POST['direccion'] : null,
            isset($_POST['TLFNO']) ? $_POST['TLFNO'] : null
        );
        $clase->actualizar();
    }
    elseif ($tipo === 'usuario'){
        require('Model/Usuarios.php');
        $pass = isset($_POST["password"]) ? password_hash($_POST["password"],PASSWORD_DEFAULT) : null;
        $clase = new Usuario(
            $_POST['ID'],
            isset($_POST['nombre']) ? $_POST['nombre'] : null,
            isset($_POST['correo']) ? $_POST['correo'] : null,
            $pass,
            isset($_POST['rol']) ? $_POST['rol'] : null,
            isset($_POST['semilla']) ? $_POST['semilla'] : null
        );
        $clase->actualizar();

        if (isset($_POST['self'])) {
            session_start();
            $_SESSION['user_name'] = $_POST["nombre"];
            $_SESSION['user_id'] = $_POST["ID"];
        }

        header('Location:Administrar_perfil'); // Y vuelve a la pagina donde estaba antes
    }
    elseif ($tipo === 'marca'){
        require('Model/Marcas.php');
        $clase = new Marca(
            $_POST['ID'],
            isset($_POST['nombre']) ? $_POST['nombre'] : null
        );
        $clase->actualizar();
    }
    elseif ($tipo === 'unidad'){
        require('Model/Unidades.php');
        $clase = new Unidad(
            $_POST['ID'],
            isset($_POST['nombre']) ? $_POST['nombre'] : null
        );
        $clase->actualizar();
    }
    elseif ($tipo === 'categoria'){
        require('Model/Categorias.php');
        $clase = new Categoria(
            $_POST['ID'],
            isset($_POST['nombre']) ? $_POST['nombre'] : null
        );
        $clase->actualizar();
    }
    elseif ($tipo === 'metodo_pago'){
        require('Model/Metodos_pagos.php');
        $clase = new Metodo_pago(
            $_POST['ID'],
            isset($_POST['nombre']) ? $_POST['nombre'] : null
        );
        $clase->actualizar();
    }
    elseif ($tipo === 'configuraciones'){
        require('Model/Configuraciones.php');
        $clase = new Configuracion(
            $_POST["llave"],
            $_POST["valor"]
        );
        $clase->actualizar();
    }
    
    $clase2 = new Bitacora(null,$_SESSION['user_id'],$tipo,"Modificar","Modificado ".$tipo);
    $clase2->agregar();
    
    echo json_encode(['status' => 'active']);
?>