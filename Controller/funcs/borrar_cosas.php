<?php
    session_start();
    require("./verificar_admin_funcs.php");
    require('../../Model/Conexion.php');
    $tipo = $_POST['tipo']; // Depende de que es lo que queramos borrar

    
    if ($tipo == 'producto'){
        require('../../Model/Productos.php');
        $clase = new Producto($_POST['ID']); // Llama al modelo y le manda la instruccion
        // $imagen = $clase->search()[0]['imagen'];

        // if ($imagen != "banner_productos.png"){
        //     print_r(realpath("../../Media/imagenes/".$imagen));
        //     unlink("../../Media/imagenes/".$imagen);
        // }
        $clase->toggle_active();
    }
    elseif ($tipo == 'proveedor'){
        require('../../Model/Proveedores.php');
        require('../../Model/Entradas.php');
        require('../../Model/Productos.php');
        
        $clase = new Proveedor($_POST['ID']); // Llama al modelo y le manda la instruccion
        $clase->desactivar($_SESSION['user_id']);

        header('Location:../../Proveedores');
    }
    elseif ($tipo == 'cliente'){
        require('../../Model/Clientes.php');
        $clase = new Cliente($_POST['ID']);
        $clase->desactivar($_SESSION['user_id']);

        header('Location:../../Clientes');
    }
    elseif ($tipo == 'usuarios'){
        require('../../Model/Usuarios.php');
        $clase = new Usuario($_POST['ID']);
        $clase->borrar($_SESSION['user_id']);

        header('Location:../../Administrar_perfil');
    }
    elseif ($tipo == 'ventas'){
        require('../../Model/Registro de ventas.php');
        $clase = new Registro_ventas($_POST['ID']);
        $clase->desactivar();

        header('Location:../../Ventas');
    }
    elseif ($tipo == 'entradas'){
        require('../../Model/Entradas.php');
        $clase = new Entrada($_POST['ID']);
        $clase->borrar();

    }
    elseif ($tipo === 'unidad'){
        require('../../Model/Unidades.php');
        $clase = new Unidad($_POST["ID"]);
        $clase->borrar($_SESSION['user_id']);
    }
    elseif ($tipo === 'marca'){
        require('../../Model/Marcas.php');
        $clase = new Marca($_POST["ID"]);
        $clase->borrar($_SESSION['user_id']);
    }
    elseif ($tipo === 'categoria'){
        require('../../Model/Categorias.php');
        $clase = new Categoria($_POST["ID"]);
        $clase->borrar($_SESSION['user_id']);
    }
    elseif ($tipo === 'metodo_pago'){
        require('../../Model/Metodos_pagos.php');
        $clase = new Metodo_pago($_POST["ID"]);
        $clase->desactivar($_SESSION['user_id']);
    }
    elseif ($tipo === 'permiso'){
        require('../../Model/Permisos.php');
        $clase = new Permiso($_POST["ID"]);
        $clase->borrar($_SESSION['user_id']);
    }
?>