<?php
    require('../../Model/Conexion.php');
    // require("./verificar_admin_funcs.php");
    $tipo = $_POST['tipo']; // Depende de que es lo que queramos borrar

    
    if ($tipo == 'producto'){
        require('../../Model/Productos.php');
        require('../../Model/Entradas.php');
        require('../../Model/Proveedores.php');
        $clase = new Producto($_POST['ID']); // Llama al modelo y le manda la instruccion
        $imagen = $clase->search()[0]['imagen'];

        if ($imagen != "banner_productos.png"){
            print_r(realpath("../../Media/imagenes/".$imagen));
            unlink("../../Media/imagenes/".$imagen);
        }
        $clase->borrar();
    }
    elseif ($tipo == 'proveedor'){
        require('../../Model/Proveedores.php');
        require('../../Model/Entradas.php');
        require('../../Model/Productos.php');
        
        $clase = new Proveedor($_POST['ID']); // Llama al modelo y le manda la instruccion
        $clase->borrar_logicamente();

        header('Location:../../Proveedores'); // Y vuelve a la pagina donde estaba antes
    }
    elseif ($tipo == 'cliente'){
        require('../../Model/Clientes.php');
        $clase = new Cliente($_POST['ID']); // Llama al modelo y le manda la instruccion
        $clase->borrar_logicamente();

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
        $clase->borrar_logicamente();

        header('Location:../../Ventas'); // Y vuelve a la pagina donde estaba antes
    }
    elseif ($tipo == 'entradas'){
        require('../../Model/Entradas.php');
        $clase = new Entrada($_POST['ID']); // Llama al modelo y le manda la instruccion
        $clase->borrar_logicamente();

        header('Location:../../Productos'); // Y vuelve a la pagina donde estaba antes
    }
?>