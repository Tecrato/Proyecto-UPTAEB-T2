<?php

    require('../../Model/Conexion.php');
    require('../../Model/Usuarios.php');


    if ($_POST['metodo'] == 'correo') {
        $clase = new Usuario(correo:$correo);
        $clave = $clase->search()[0]['password'];
        // print_r($clave);
        $var = exec('mandar_correo.py "'.$correo.'" "Tu contraseña para el sistema Minimarket es es: '.$clave.'"');
        // var_dump($var);
        echo json_encode(['status' => 'active']);
    } elseif ($_POST['metodo'] == 'semilla') {
        $clase = new Usuario(semilla:$_POST['semilla'],correo:$_POST['email']);
        if ($_POST['password'] == "" or $_POST['email'] == "" or $_POST['semilla'] == "") {
            echo json_encode(['status' => 'error','error'=>'Falta de datos']);

        }
        else if (count($clase->search()) >0) {
            $clave = $_POST['password'];
            $hash = password_hash($_POST["password"],PASSWORD_DEFAULT);
            $clase2 = new Usuario(correo:$_POST['email'],hash:$hash);
            $clase2->cambiar_password();
            echo json_encode(['status' => 'active']);
        } else {
            echo json_encode(['status' => 'error','error'=>'Semilla incorrecta']);
        }
    }
?>
