<?php
    require('../../Model/Conexion.php');
    require('../../Model/Productos.php');
    require('../../Model/Proveedores.php');
    $tipo = $_POST['tipo']; // Depende de que es lo que queramos borrar

    
    if ($tipo == 'producto'){
        $clase = new Producto(); // Llama al modelo y le manda la instruccion
        $imagen = array_slice($clase->search($_POST['ID'])->fetch_assoc(), 0)['imagen'];
        if ($imagen != "banner_productos.png"){
            unlink("../../Media/imagenes/".$imagen);
        }
        $clase->DELETE($_POST['ID']);
        $clase->borrar_lotes(False,$_POST['ID']);
        header('Location:../../Productos'); // Y vuelve a la pagina donde estaba antes
    }
    if ($tipo == 'proveedor'){
        $clase = new Proveedor(); // Llama al modelo y le manda la instruccion
        $clase->DELETE($_POST['ID']);

        $clase2 = new Producto(); // Llama al modelo y le manda la instruccion
        $clase2->borrar_lotes($_POST['ID']);
        header('Location:../../Proveedores'); // Y vuelve a la pagina donde estaba antes
    }
?>