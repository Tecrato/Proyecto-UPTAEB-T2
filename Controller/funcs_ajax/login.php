<?php
    // Con este codigo se confirma si el usuario tiene una cuenta para entrar al sistema
    session_start();
    require '../../Model/Conexion.php';
    require '../../Model/Usuarios.php';
    
    $correo = $_POST["correo"];
    $password = $_POST["contraseña"];
    
    $c = new Usuario(null,null,$correo,$password);
    $result = $c->login();

    if (count($result) == 1 and $_POST["correo"] and $_POST["contraseña"]) { // si hay un resultado entonces lo deja pasar
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
        echo 1;
    } else {
        echo 0;
    }

?>