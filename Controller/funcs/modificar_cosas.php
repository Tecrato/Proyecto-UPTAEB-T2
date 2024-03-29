<?php
    session_start();
    require("./verificar_admin_funcs.php");
    require 'subir_imagen.php';
    require('../../Model/Conexion.php');
    $tipo = $_POST['tipo']; // Depende de que es lo que queramos actualizar

    if ($tipo === 'producto'){
        if ($_FILES['imagen1']['name'] != "") {
            $imagen = $_FILES['imagen1'];
            $nick = "producto_".$_POST['nombre'] . "_" . $imagen['name'];
        }
        else {
            $imagen = null;
            $nick = null;
        }

        require('../../Model/Productos.php');
        $clase = new Producto($_POST['ID'],$_POST["categoria"],$_POST["unidad"],$_POST["nombre"],$_POST["marca"],$nick,$_POST["stock_min"],$_POST["stock_max"],$_POST["precio_venta"],$_POST["IVA"]); // Llama al modelo y le manda la instruccion

        try {
            $clase->actualizar();
        } catch (Exception $e) {
            echo $e;
            die();
        }
        if ($_FILES['imagen1']['name'] != "") {
            $imagen = array_slice($clase->search(), 0)['imagen'];
            unlink('../../Media/imagenes/'.$imagen);

            $imagen = $_FILES['imagen1'];
            $nick = "producto_".$_POST['nombre'] . "_" . $imagen['name'];
            $img_err = subir_imagen($imagen, $nick, true);
            if ($img_err != false){
                header('Location:../../Productos?error='.$img_err);
            }
        }
        // header('Location:../../Productos');
    }
    elseif ($tipo === 'proveedor'){
        require('../../Model/Proveedores.php');
        $clase = new Proveedor($_POST["ID"],$_POST["nombre"],$_POST["razon_social"],$_POST["rif"],$_POST["telefono"],$_POST["correo"],$_POST["direccion"]); // Llama al modelo y le manda la instruccion
        $clase->actualizar();
        header('Location:../../Proveedores');
    }
    elseif ($tipo === 'cliente'){
        require('../../Model/Clientes.php');
        $clase = new Cliente($_POST["ID"],$_POST["nombre"],$_POST["cedula"],$_POST["apellido"],$_POST["documento"],$_POST["direccion"],$_POST["telefono"]);
        $clase->actualizar();
        header('Location:../../Clientes');
    }
    elseif ($tipo === 'usuario'){
        require('../../Model/Usuarios.php');
        $clase = new Usuario($_POST["ID"],$_POST["nombre"],$_POST["correo"],$_POST["password"],isset($_POST["rol"]) ? $_POST["rol"] : null); 
        $clase->actualizar();

        if (isset($_POST['self'])) {
            session_start();
            $_SESSION['user_name'] = $_POST["nombre"];
            $_SESSION['user_id'] = $_POST["ID"];
        }

        header('Location:../../Administrar_perfil'); // Y vuelve a la pagina donde estaba antes
    };
?>