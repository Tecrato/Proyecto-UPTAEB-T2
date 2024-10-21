<?php
    session_start();
    require("./verificar_admin_funcs.php");
    require('../../Model/Conexion.php');
    require('../../Model/Permisos.php');
    require('../../Model/Bitacora.php');
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
        print_r(file_exists('../../Media/imagenes/'.$_POST['old_img']));
        if ($_FILES['imagen1']['name'] != "") {
            if (file_exists('../../Media/imagenes/'.$_POST['old_img'])) {
                unlink('../../Media/imagenes/'.$_POST['old_img']);
            }
            print_r('../../Media/imagenes/'.$_POST['old_img']);
            $imagen = $_FILES['imagen1'];
            $nick = "producto_".$_POST['nombre'] . "_" . $imagen['name'];
            $img_err = subir_imagen($imagen,$nick);
            if ($img_err != false){
                if ($img_err != 3){
                    unlink('../../Media/imagenes/'.$nick);
                }
                die();
            }
        }
        else {
            $imagen = null;
            $nick = null;
        }

        require('../../Model/Productos.php');
        $clase = new Producto($_POST['ID'],$_POST["categoria"],$_POST["unidad"],$_POST["marca"],$_POST["valor_unidad"],$_POST["nombre"],$nick,$_POST["stock_min"],$_POST["stock_max"],$_POST["precio_venta"],$_POST["IVA"],$_POST["codigo"]); // Llama al modelo y le manda la instruccion

        try {
            $clase->actualizar();
        } catch (Exception $e) {
            echo $e;
            die();
        }
    }
    elseif ($tipo === 'proveedor'){
        require('../../Model/Proveedores.php');
        $clase = new Proveedor($_POST["ID"],$_POST["nombre"],$_POST["razon_social"],$_POST["T-D"]."-".$_POST["rif"],$_POST["TLFNO"],$_POST["correo"],$_POST["direccion"]); // Llama al modelo y le manda la instruccion
        $clase->actualizar();
    }
    elseif ($tipo === 'cliente'){
        require('../../Model/Clientes.php');
        $clase = new Cliente($_POST["ID"],$_POST["nombre"],$_POST["cedula"],$_POST["apellido"],$_POST["documento"],$_POST["direccion"],$_POST["TLFNO"]);
        $clase->actualizar();
    }
    elseif ($tipo === 'usuario'){
        require('../../Model/Usuarios.php');
        $pass = isset($_POST["password"]) ? password_hash($_POST["password"],PASSWORD_DEFAULT) : null;
        $clase = new Usuario($_POST["ID"],$_POST["nombre"],$_POST["correo"],$pass,isset($_POST["rol"]) ? $_POST["rol"] : null, $_POST["semilla"]); 
        $clase->actualizar();

        if (isset($_POST['self'])) {
            session_start();
            $_SESSION['user_name'] = $_POST["nombre"];
            $_SESSION['user_id'] = $_POST["ID"];
        }

        header('Location:../../Administrar_perfil'); // Y vuelve a la pagina donde estaba antes
    }
    elseif ($tipo === 'marca'){
        require('../../Model/Marcas.php');
        $clase = new Marca($_POST["ID"],$_POST["nombre"]);
        $clase->actualizar();
    }
    elseif ($tipo === 'unidad'){
        require('../../Model/Unidades.php');
        $clase = new Unidad($_POST["ID"],$_POST["nombre"]);
        $clase->actualizar();
    }
    elseif ($tipo === 'categoria'){
        require('../../Model/Categorias.php');
        $clase = new Categoria($_POST["ID"],$_POST["nombre"]);
        $clase->actualizar();
    }
    elseif ($tipo === 'metodo_pago'){
        require('../../Model/Metodos_pagos.php');
        $clase = new Metodo_pago($_POST["ID"],$_POST["nombre"]);
        $clase->actualizar();
    }
    elseif ($tipo === 'configuraciones'){
        require('../../Model/Configuraciones.php');
        $clase = new Configuracion($_POST["llave"],$_POST["valor"]);
        $clase->actualizar();
    }
    
    $clase2 = new Bitacora(null,$_SESSION['user_id'],$tipo,"Modificar","Modificado ".$tipo);
    $clase2->agregar();
    
    echo json_encode(['status' => 'active']);
?>