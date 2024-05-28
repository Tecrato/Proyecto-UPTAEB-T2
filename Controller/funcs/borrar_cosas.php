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
        $clase->desactivar();

        header('Location:../../Proveedores'); // Y vuelve a la pagina donde estaba antes
    }
    elseif ($tipo == 'cliente'){
        require('../../Model/Clientes.php');
        $clase = new Cliente($_POST['ID']); // Llama al modelo y le manda la instruccion
        $clase->desactivar();

        header('Location:../../Clientes'); // Y vuelve a la pagina donde estaba antes
    }
    elseif ($tipo == 'usuarios'){
        require('../../Model/Usuarios.php');
        $clase = new Usuario($_POST['ID']); // Llama al modelo y le manda la instruccion
        $clase->borrar();

        header('Location:../../Administrar_perfil'); // Y vuelve a la pagina donde estaba antes
    }
    elseif ($tipo == 'ventas'){
        require('../../Model/Registro de ventas.php');
        $clase = new Registro_ventas($_POST['ID']); // Llama al modelo y le manda la instruccion
        $clase->desactivar();

        header('Location:../../Ventas'); // Y vuelve a la pagina donde estaba antes
    }
    elseif ($tipo == 'entradas'){
        require('../../Model/Entradas.php');
        $clase = new Entrada($_POST['ID']); // Llama al modelo y le manda la instruccion
        $clase->borrar();

        // header('Location:../../Productos'); // Y vuelve a la pagina donde estaba antes
    }
    elseif ($tipo === 'unidad'){
        require('../../Model/Unidades.php');
        $clase = new Unidad($_POST["ID"]); // Llama al modelo y le manda la instruccion
        $clase->borrar();
        // header('Location:../../Productos'); // Y vuelve a la pagina donde estaba antes
    }
    elseif ($tipo === 'marca'){
        require('../../Model/Marcas.php');
        $clase = new Marca($_POST["ID"]); // Llama al modelo y le manda la instruccion
        $clase->borrar();
        // header('Location:../../Productos'); // Y vuelve a la pagina donde estaba antes
    }
    elseif ($tipo === 'categoria'){
        require('../../Model/Categorias.php');
        $clase = new Categoria($_POST["ID"]); // Llama al modelo y le manda la instruccion
        $clase->borrar();
        // header('Location:../../Productos'); // Y vuelve a la pagina donde estaba antes
    }
?>