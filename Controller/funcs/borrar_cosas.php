<?php
    require('../../Model/Conexion.php');
    require('../../Model/Productos.php');
    require('../../Model/Proveedores.php');
    require('../../Model/Lotes.php');
    require('../../Model/Clientes.php');
    require('../../Model/Usuarios.php');
    $tipo = $_POST['tipo']; // Depende de que es lo que queramos borrar

    
    if ($tipo == 'producto'){
        $clase = new Producto($_POST['ID']); // Llama al modelo y le manda la instruccion
        $clase_l = new Lote(id_producto:$_POST['ID']); // Llama al modelo y le manda la instruccion
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
        $clase2 = new Lote(id_proveedor:$_POST['ID']); // Llama al modelo y le manda la instruccion
        $clase2->borrar();
        
        $clase = new Proveedor($_POST['ID']); // Llama al modelo y le manda la instruccion
        $clase->borrar();

        header('Location:../../Proveedores'); // Y vuelve a la pagina donde estaba antes
    }
    if ($tipo == 'cliente'){
        $clase = new Cliente($_POST['ID']); // Llama al modelo y le manda la instruccion
        $clase->borrar();

        header('Location:../../Clientes'); // Y vuelve a la pagina donde estaba antes
    }
    if ($tipo == 'usuarios'){
        $clase = new Usuarios($_POST['ID']); // Llama al modelo y le manda la instruccion
        $clase->borrar();

        header('Location:../../Clientes'); // Y vuelve a la pagina donde estaba antes
    }
?>