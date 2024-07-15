<?php
    // Con este codigo se confirma si el usuario tiene una cuenta para entrar al sistema
    session_start();
    require '../../Model/Conexion.php';
    require '../../Model/Usuarios.php';
    
    $sesion_id = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789'), 0, 10);//creamos el string del sesion id
    $correo = $_POST["correo"];
    $password = $_POST["password"];
    
    $c = new Usuario(null,null,$correo);
    $result = $c->search();

    if (count($result) != 1) {
        echo json_encode([['status' => 'error', 'error_code' => 3]]);
    }
    if (count($result) == 1 and $_POST["correo"] and $_POST["password"] and password_verify($password,$result[0]['hash'])) { // si hay un resultado entonces lo deja pasar
        $row = $result[0];
        
        $c2 = new Usuario($row['id'],sesion_id:$sesion_id);
        $c2->login($row['id']);
        
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
        echo 1;
    } else {
        echo 0;
    }

?>