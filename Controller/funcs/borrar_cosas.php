<?php
    require('../../Model/Conexion.php');
    $tipo = $_POST['tipo']; // Depende de que es lo que queramos borrar

    
    if ($tipo == 'producto'){
        require('../../Model/Productos.php');
        require('../../Model/Entradas.php');
        require('../../Model/Proveedores.php');
        $clase = new Producto($_POST['ID']); // Llama al modelo y le manda la instruccion
        $clase_l = new Entrada(id_producto:$_POST['ID']); // Llama al modelo y le manda la instruccion
        $imagen = $clase->search($_POST['ID'])[0]['imagen'];
        print_r($imagen);
        if ($imagen != "banner_productos.png"){
            unlink("../../Media/imagenes/".$imagen);
        }
        $clase_l->borrar();
        $clase->borrar();
        header('Location:../../Productos'); // Y vuelve a la pagina donde estaba antes
    }
    if ($tipo == 'proveedor'){
        require('../../Model/Proveedores.php');
        require('../../Model/Entradas.php');
        require('../../Model/Productos.php');
        $clase2 = new Entrada(id_proveedor:$_POST['ID']); // Llama al modelo y le manda la instruccion
        $clase2->borrar();
        
        $clase = new Proveedor($_POST['ID']); // Llama al modelo y le manda la instruccion
        $clase->borrar();

        header('Location:../../Proveedores'); // Y vuelve a la pagina donde estaba antes
    }
    if ($tipo == 'cliente'){
        require('../../Model/Clientes.php');
        $clase = new Cliente($_POST['ID']); // Llama al modelo y le manda la instruccion
        $clase->borrar();

        header('Location:../../Clientes'); // Y vuelve a la pagina donde estaba antes
    }
    if ($tipo == 'usuarios'){
        require('../../Model/Usuarios.php');
        $clase = new Usuario($_POST['ID']); // Llama al modelo y le manda la instruccion
        $clase->borrar();

        header('Location:../../Administrar_perfil'); // Y vuelve a la pagina donde estaba antes
    }
?>