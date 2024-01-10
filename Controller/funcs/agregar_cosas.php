<?php
    // Con este archivo se insertan objetos en tablas del SQL
    require 'subir_imagen.php';
    $tipo = $_POST['tipo']; // Depende de que es lo que queramos insertar
    
    require('../../Model/Conexion.php');
    if ($tipo === 'producto'){
        
        if ($_FILES['imagen1']['name'] != "") {
            $imagen = $_FILES['imagen1'];
            $nick = "producto_".$_POST['nombre'] . "_" . $imagen['name'];
            $img_err = subir_imagen($imagen,$nick);
            if ($img_err != false){
                // header('Location:../../Productos?error='.$img_err);
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
        $clase = new Producto(null,$_POST["categoria"],$_POST["unidad"],$_POST["nombre"],$_POST["descripcion"],$nick,$_POST["stock_min"],$_POST["stock_max"],$_POST["precio_venta"],$_POST["IVA"]); // Llama al modelo y le manda la instruccion
        try {
            $clase->agregar();
        } catch (Exception $e) {
            print_r($e);
            unlink('../../Media/imagenes/'."producto_".$_POST['nombre']);
            // header('Location:../../Productos?error=en+la+base+de+datos');
            // die();
        }


        // header('Location:../../Productos'); // Y vuelve a la pagina donde estaba antes
    }

    elseif ($tipo === 'lote'){
        require('../../Model/Entradas.php');
        $clase = new Entrada(null,$_POST["ID"],$_POST["proveedor"],$_POST["cantidad"],$_POST["fecha_c"],$_POST["fecha_v"],$_POST["precio_compra"]); // Llama al modelo y le manda la instruccion
        $clase->agregar();
        header('Location:../../Productos'); // Y vuelve a la pagina donde estaba antes
    }

    elseif ($tipo === 'proveedor'){
        require('../../Model/Proveedores.php');
        $clase = new Proveedor(null,$_POST["nombre"],$_POST["razon_social"],$_POST["rif"],$_POST["telefono"],$_POST["correo"],$_POST["direccion"]); // Llama al modelo y le manda la instruccion
        $clase->agregar();
        header('Location:../../Proveedores'); // Y vuelve a la pagina donde estaba antes
    }
    elseif ($tipo === 'cliente'){
        require('../../Model/Clientes.php');
        $clase = new Cliente(null,$_POST["nombre"],$_POST["apellido"],$_POST["documento"],$_POST["cedula"],$_POST["direccion"],$_POST["telefono"]); 
        $clase->agregar();
        header('Location:../../Clientes'); // Y vuelve a la pagina donde estaba antes
    }
    elseif ($tipo === 'Usuario'){
        require('../../Model/Usuarios.php');
        $clase = new Usuario(null,$_POST["nombre"],$_POST["correo"],$_POST["password"],$_POST["rol"]); 
        $clase->agregar();
        header('Location:../../Administrar_perfil'); // Y vuelve a la pagina donde estaba antes
    };
    
?>