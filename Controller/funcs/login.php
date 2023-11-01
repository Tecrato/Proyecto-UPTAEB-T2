<?php
    // Con este codigo se confirma si el usuario tiene una cuenta para entrar al sistema
    session_start();
    require '../../Model/Conexion.php';
    require '../../Model/Usuarios.php';
    
    $correo = $_POST["correo"];
    $password = $_POST["contraseña"];
    
    $c = new Usuarios(); // Llamamos al modelos y se busca el usuario
    $result = $c->search(null,null,null ,$correo,$password)->fetchAll();

    // print_r($result[0]);
    if (count($result) > 0 and $_POST["correo"] and $_POST["contraseña"]) { // si hay un resultado entonces lo deja pasar
        $row = $result[0];
        $_SESSION['usuario'] = $row['nombre']; // Y tambien guarda el nombre para despues
        $_SESSION['id'] = $row['id']; // Y tambien guarda el nombre para despues
        $rol = $row['rol'];
        if ($rol == 1){
            $_SESSION['rol'] = "Dueño"; // Y tambien guarda el nombre para despues   
        }
        if ($rol == 2){
            $_SESSION['rol'] = "Administrador"; // Y tambien guarda el nombre para despues   
        }
        if ($rol == 3){
            $_SESSION['rol'] = "Cajero"; // Y tambien guarda el nombre para despues   
        }
        header('Location: ../../Inicio'); // y pa' la pagina que se va
    } else {
        // print_r($result);
        header('Location: ../../login'); // Sino, lo devuelve al login
    }

?>