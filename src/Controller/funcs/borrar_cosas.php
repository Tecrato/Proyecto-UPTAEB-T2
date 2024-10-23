<?php

namespace Shtechnologyx\Pt3\Controller\funcs;
require('../../../vendor/autoload.php');

    session_start();
    // require("./verificar_admin_funcs.php");
    use Shtechnologyx\Pt3\Controller\funcs\verificar_admin_funcs;
    require('../../Model/Conexion.php');

    use Shtechnologyx\Pt3\Model\Permiso;
    use Shtechnologyx\Pt3\Model\Bitacora;
    use Shtechnologyx\Pt3\Model\Usuario;
    use Shtechnologyx\Pt3\Model\Producto;
    use Shtechnologyx\Pt3\Model\Entrada;
    use Shtechnologyx\Pt3\Model\Proveedor;
    use Shtechnologyx\Pt3\Model\Cliente;
    use Shtechnologyx\Pt3\Model\Unidad;
    use Shtechnologyx\Pt3\Model\Marca;
    use Shtechnologyx\Pt3\Model\Categoria;
    use Shtechnologyx\Pt3\Model\Metodo_pago;
    use Shtechnologyx\Pt3\Model\Registro_ventas;
    use Shtechnologyx\Pt3\Model\Notificacion;

    $tipo = $_POST['tipo']; // Depende de que es lo que queramos borrar


    $other_class = new Permiso(null,$_SESSION['user_id'],$_POST['tipo'],'borrar');
    $result = $other_class->search();

    if ($_SESSION['rol_num'] > 1 and count($result) <= 0) {
        echo json_encode(['status' => 'error','error'=>'Permiso Error (bueno ps)']);
        exit(0);
        die();
    }
    
    if ($tipo == 'producto'){
        echo'hola';
        $clase = new Producto($_POST['ID']); // Llama al modelo y le manda la instruccion
        // $imagen = $clase->search()[0]['imagen'];
        
        // if ($imagen != "banner_productos.png"){
            //     print_r(realpath("../../Media/imagenes/".$imagen));
            //     unlink("../../Media/imagenes/".$imagen);
            // }
            $clase2 = new Bitacora(null,$_SESSION['user_id'],$tipo,"Borrar","Borrado ".$tipo);
            $clase2->agregar();
        $clase->toggle_active();
    }
    elseif ($tipo == 'proveedor'){
        $clase = new Proveedor($_POST['ID']); // Llama al modelo y le manda la instruccion
        $clase->desactivar();
        $clase2 = new Bitacora(null,$_SESSION['user_id'],$tipo,"Borrar","Borrado ".$tipo);
        $clase2->agregar();
        echo "1";
        $clase2 = new Bitacora(null,$_SESSION['user_id'],$tipo,"Borrar","Borrado ".$tipo);
        $clase2->agregar();

    }
    elseif ($tipo == 'cliente'){
        $clase = new Cliente($_POST['ID']);
        $clase->desactivar();
        $clase2 = new Bitacora(null,$_SESSION['user_id'],$tipo,"Borrar","Borrado ".$tipo);
        $clase2->agregar();
    }
    elseif ($tipo == 'usuarios'){
        $clase = new Usuario($_POST['ID']);
        $clase->borrar();
        $clase2 = new Bitacora(null,$_SESSION['user_id'],$tipo,"Borrar","Borrado ".$tipo);
        $clase2->agregar();
    }
    elseif ($tipo == 'ventas'){
        $clase = new Registro_ventas($_POST['ID']);
        $clase->desactivar();
        $clase2 = new Bitacora(null,$_SESSION['user_id'],$tipo,"Borrar","Borrado ".$tipo);
        $clase2->agregar();
    }
    elseif ($tipo == 'entradas'){
        $clase = new Entrada($_POST['ID']);
        $clase->borrar();
        $clase2 = new Bitacora(null,$_SESSION['user_id'],$tipo,"Borrar","Borrado ".$tipo);
        $clase2->agregar();
    }
    elseif ($tipo === 'unidad'){
        $clase = new Unidad($_POST["ID"]);
        $clase->borrar();
        $clase2 = new Bitacora(null,$_SESSION['user_id'],$tipo,"Borrar","Borrado ".$tipo);
        $clase2->agregar();
    }
    elseif ($tipo === 'marca'){
        $clase = new Marca($_POST["ID"]);
        $clase->borrar();
        $clase2 = new Bitacora(null,$_SESSION['user_id'],$tipo,"Borrar","Borrado ".$tipo);
        $clase2->agregar();
    }
    elseif ($tipo === 'categoria'){
        $clase = new Categoria($_POST["ID"]);
        $clase->borrar();
        $clase2 = new Bitacora(null,$_SESSION['user_id'],$tipo,"Borrar","Borrado ".$tipo);
        $clase2->agregar();
    }
    elseif ($tipo === 'metodo_pago'){
        $clase = new Metodo_pago($_POST["ID"]);
        $clase->desactivar();
        $clase2 = new Bitacora(null,$_SESSION['user_id'],$tipo,"Borrar","Borrado ".$tipo);
        $clase2->agregar();
    }
    elseif ($tipo === 'permiso'){
        $clase = new Permiso(null,$_POST["id_usuario"],$_POST["tabla"],$_POST["accion"]);
        $clase->borrar();
        $clase2 = new Bitacora(null,$_SESSION['user_id'],$tipo,"Borrar","Borrado ".$tipo);
        $clase2->agregar();
    }
    elseif ($tipo == 'notificaciones'){
        $clase = new Notificacion($_POST['ID']);
        $clase->desactivar();
    }
?>