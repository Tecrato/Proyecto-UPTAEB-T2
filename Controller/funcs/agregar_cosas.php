<?php
    session_start();
    require("./verificar_admin_funcs.php");
    require 'subir_imagen.php';
    $tipo = $_POST['tipo']; // Depende de que es lo que queramos insertar
    
    require('../../Model/Conexion.php');
    if ($tipo === 'producto'){
        if ($_FILES['imagen1']['name'] != "") {
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
            $nick = "banner_productos.png";
        }
        
        require('../../Model/Productos.php');
        $clase = new Producto(null,$_POST["categoria"],$_POST["unidad"],$_POST["marca"],$_POST["valor_unidad"],$_POST["nombre"],$nick,$_POST["stock_min"],$_POST["stock_max"],$_POST["precio_venta"],$_POST["IVA"],$_POST["codigo"]); // Llama al modelo y le manda la instruccion
        if ($clase->err){
            echo ("$clase->err");
            exit();
        }
        try {
            print_r($clase->agregar());
        } catch (Exception $e) {
            print_r($e);
            unlink('../../Media/imagenes/'."producto_".$_POST['nombre']);
        }


        // header('Location:../../Productos'); // Y vuelve a la pagina donde estaba antes
    }

    elseif ($tipo === 'lote'){
        require('../../Model/Entradas.php');
        $clase = new Entrada(null,$_POST["ID"],$_POST["proveedor"],$_POST["cantidad"],$_POST["fecha_c"],$_POST["fecha_v"],$_POST["precio_compra"]); // Llama al modelo y le manda la instruccion
        $clase->agregar($_SESSION['user_id']);
        // header('Location:../../Productos'); // Y vuelve a la pagina donde estaba antes
    }

    elseif ($tipo === 'proveedor'){
        require('../../Model/Proveedores.php');
        $clase = new Proveedor(null,$_POST["nombre"],$_POST["razon_social"],$_POST["T-D"]."-".$_POST["rif"],$_POST["TLFNO"],$_POST["correo"],$_POST["direccion"]); // Llama al modelo y le manda la instruccion
        $clase->agregar($_SESSION['user_id']);
        // header('Location:../../Proveedores'); // Y vuelve a la pagina donde estaba antes
    }
    elseif ($tipo === 'cliente'){
        require('../../Model/Clientes.php');
        $clase = new Cliente(null,$_POST["nombre"],$_POST["cedula"],$_POST["apellido"],$_POST["documento"],$_POST["direccion"],$_POST["TLFNO"]); 
        $clase->agregar($_SESSION['user_id']);
        // header('Location:../../Clientes'); // Y vuelve a la pagina donde estaba antes
    }
    elseif ($tipo === 'usuarios'){
        require('../../Model/Usuarios.php');
        $hash = password_hash($_POST["password"],PASSWORD_DEFAULT);
        $clase = new Usuario(null,$_POST["nombre"],$_POST["correo"],$hash,$_POST["rol"],substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789'), 0, 20)); 
        $clase->agregar($_SESSION['user_id']);
        header('Location:../../Administrar_perfil'); // Y vuelve a la pagina donde estaba antes
    }
    elseif ($tipo === 'proveedor'){
        require('../../Model/Proveedores.php');
        $clase = new Proveedor(null,$_POST["nombre"],$_POST["razon_social"],$_POST["rif"],$_POST["telefono"],$_POST["correo"],$_POST["direccion"]); // Llama al modelo y le manda la instruccion
        $clase->agregar($_SESSION['user_id']);
        header('Location:../../Proveedores'); // Y vuelve a la pagina donde estaba antes
    }
    elseif ($tipo === 'unidad'){
        require('../../Model/Unidades.php');
        $clase = new Unidad(null,$_POST["nombre"]); // Llama al modelo y le manda la instruccion
        $clase->agregar($_SESSION['user_id']);
        // header('Location:../../Productos'); // Y vuelve a la pagina donde estaba antes
    }
    elseif ($tipo === 'marca'){
        require('../../Model/Marcas.php');
        $clase = new Marca(null,$_POST["nombre"]); // Llama al modelo y le manda la instruccion
        $clase->agregar($_SESSION['user_id']);
        // header('Location:../../Productos'); // Y vuelve a la pagina donde estaba antes
    }
    elseif ($tipo === 'categoria'){
        require('../../Model/Categorias.php');
        $clase = new Categoria(null,$_POST["nombre"]); // Llama al modelo y le manda la instruccion
        $clase->agregar($_SESSION['user_id']);
        // header('Location:../../Productos'); // Y vuelve a la pagina donde estaba antes
    }
    elseif ($tipo === 'metodo_pago'){
        require('../../Model/Metodos_pagos.php');
        $clase = new Metodo_pago(null,$_POST["nombre"]); // Llama al modelo y le manda la instruccion
        $clase->agregar($_SESSION['user_id']);
        // header('Location:../../Productos'); // Y vuelve a la pagina donde estaba antes
    }
    elseif ($tipo === 'Credito'){
        require('../../Model/Credito.php');
        $clase = new Credito(null,$_POST["ID"],$_POST["ID_cliente"],$_POST["ID_rv"],$_POST["fecha_limite"],$_POST["monto_final"]); // Llama al modelo y le manda la instruccion
        $clase->agregar($_SESSION['user_id']);
        // header('Location:../../Productos'); // Y vuelve a la pagina donde estaba antes
    }

    
?>