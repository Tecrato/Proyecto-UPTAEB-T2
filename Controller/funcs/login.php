<?php
    // Con este codigo se confirma si el usuario tiene una cuenta para entrar al sistema
    session_start();
    require '../../Model/Conexion.php';
    require '../../Model/Usuarios.php';
    
    $correo = $_POST["correo"];
    $password = $_POST["contraseña"];
    
    $d = new DB();
    
    $c = new Usuario(null,null,$correo); // Llamamos al modelos y se busca el usuario
    $result = $c->search();
    
    if (count($result) == 1 and $_POST["correo"] and $_POST["contraseña"] and password_verify($password,$result[0]['hash'])) { // si hay un resultado entonces lo deja pasar
        $row = $result[0];
        $_SESSION['user_name'] = $row['nombre']; // Y tambien guarda el nombre para despues
        $_SESSION['user_id'] = $row['id']; // Y el id
        $rol = $row['rol'];
        if ($rol == 1){
            $_SESSION['rol'] = "Administrador"; // Y tambien guarda el nombre para despues   
        }
        else if ($rol == 2){
            $_SESSION['rol'] = "Usuario"; // Y tambien guarda el nombre para despues   
        }
        $d->add_bitacora($row['id'],"Login","logueado","El usuario ".$row['nombre']." inicio sesion");
        header('Location: ../../Inicio'); // y pa' la pagina que se va
    } else {
        header('Location: ../../login?err=1'); // Sino, lo devuelve al login
    }

?>