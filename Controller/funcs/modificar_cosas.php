<?php
    // Con este codigo se realiza el UPDATE en la base de datos
    require 'subir_imagen.php';
    require('../../Model/Conexion.php');
    $tipo = $_POST['tipo']; // Depende de que es lo que queramos actualizar

    if ($tipo === 'producto'){
        require('../../Model/Productos.php');
        $clase = new Producto(); // Llama al modelo y le manda la instruccion

        if ($_FILES['imagen1']['name'] != "") {
            $imagen = $_FILES['imagen1'];
            $nick = "producto_".$_POST['nombre'] . "_" . $imagen['name'];
        else {
            $imagen = null;
            $nick = null;
        }
        try {
            $clase->UPDATE($_POST['ID'],$_POST["categoria"],$_POST["unidad"],$_POST["nombre"],$_POST["descripcion"],$nick,$_POST["stock_min"],$_POST["stock_max"],$_POST["IVA"]);
        } catch (Exception $e) {
            echo $e;
            die();
        }
        if ($_FILES['imagen1']['name'] != "") {
            $imagen = array_slice($clase->search($_POST['ID'])->fetch_assoc(), 0)['imagen'];
            unlink('../../Media/imagenes/'.$imagen);

            $imagen = $_FILES['imagen1'];
            $nick = "producto_".$_POST['nombre'] . "_" . $imagen['name'];
            $img_err = subir_imagen($imagen, $nick, true);
            if ($img_err != false){
                header('Location:../../Productos?error='.$img_err);
            }
        }
        header('Location:../../productos');
    }
    if ($tipo === 'proveedor'){
        require('../../Model/Proveedores.php');
        $clase = new Proveedor(); // Llama al modelo y le manda la instruccion
        $clase->UPDATE($_POST["ID"],$_POST["nombre"],$_POST["razon_social"],$_POST["rif"],$_POST["telefono"],$_POST["correo"],$_POST["direccion"]);
        header('Location:../../Proveedores');
    }
?>