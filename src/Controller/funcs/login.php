<?php
    namespace Shtechnologyx\Pt3\Controller\funcs;
require('../../../vendor/autoload.php');

    // Con este codigo se confirma si el usuario tiene una cuenta para entrar al sistema
    session_start();


    // require '../../Model/Conexion.php';
    use Shtechnologyx\Pt3\Model\Usuario;
    use Shtechnologyx\Pt3\Model\Bitacora;

    
    $sesion_id = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789'), 0, 10);//creamos el string del sesion id
    $correo = $_POST["correo"];
    $password = $_POST["contraseña"];
    $codigo = $_POST['codigo'];

    

    if (!($_SESSION['codigo_verificacion'] == sha1($codigo))) {
        header('Location: ../../login?error=2');
        exit(0);
        die();
    }
    
    
    $c = new Usuario(correo:$correo); // Llamamos al modelos y se busca el usuario
    $result = $c->search();
    
    if (count($result) != 1) {
        header('Location: ../../login?error=3');
    }
    else if ($_POST["correo"] and $_POST["contraseña"] and password_verify($password,$result[0]['hash'])) { // si hay un resultado entonces lo deja pasar
        $row = $result[0];

        $c2 = new Usuario($row['id'],sesion_id:$sesion_id);
        $c2->login();
        
        $_SESSION['user_name'] = $row['nombre']; // Y tambien guarda el nombre para despues
        $_SESSION['user_id'] = $row['id']; // Y el id
        $_SESSION['rol_num'] = $row['rol'];
        $_SESSION['sesion_id'] = $sesion_id;
        $rol = $row['rol'];
        if ($rol == 1){
            $_SESSION['rol'] = "Super-Administrador"; // Y tambien guarda el nombre para despues   
        }
        else if ($rol == 2){
            $_SESSION['rol'] = "Administrador"; // Y tambien guarda el nombre para despues   
        }
        else if ($rol == 3){
            $_SESSION['rol'] = "Usuario"; // Y tambien guarda el nombre para despues   
        }
        $clase2 = new Bitacora(null,$row['id'],"Usuarios","Login","Usuario ".$row['nombre']." logueado");
        $clase2->agregar();
        header('Location: ../../Inicio'); // y pa' la pagina que se va
    } else {
        header('Location: ../../login?error=0'); // Sino, lo devuelve al login
    }

?>