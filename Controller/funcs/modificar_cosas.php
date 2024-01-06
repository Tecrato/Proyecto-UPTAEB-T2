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
        }
        else {
            $imagen = null;
            $nick = null;
        }
        try {
            $clase->actualizar($_POST['ID'],$_POST["categoria"],$_POST["unidad"],$_POST["nombre"],$_POST["descripcion"],$nick,$_POST["stock_min"],$_POST["stock_max"],$_POST["precio_venta"],$_POST["IVA"]);
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
        header('Location:../../Productos');
    }
    elseif ($tipo === 'proveedor'){
        require('../../Model/Proveedores.php');
        $clase = new Proveedor(); // Llama al modelo y le manda la instruccion
        $clase->actualizar($_POST["ID"],$_POST["nombre"],$_POST["razon_social"],$_POST["rif"],$_POST["telefono"],$_POST["correo"],$_POST["direccion"]);
        header('Location:../../Proveedores');
    }
    elseif ($tipo === 'cliente'){
        require('../../Model/Clientes.php');
        $clase = new Cliente($_POST["ID"],$_POST["nombre"],$_POST["cedula"],$_POST["Documento"],$_POST["telefono"],$_POST["direccion"]);
        $clase->actualizar();
        header('Location:../../Clientes');
    }
    elseif ($tipo === 'Usuarios'){
        require('../../Model/Usuarios.php');
        $clase = new Usuario(); 
        $clase->actualizar($_POST["ID"],$_POST["nombre"],$_POST["apellido"],$_POST["correo"],$_POST["password"],$_POST["rol"]);
       Location('Location:../../Administrar_perfil'); // Y vuelve a la pagina donde estaba antes
    };
?>