<?php
    // archivo hecho para imprimir si la contraseña coincide con el hash de la base de datos, la contraseña es traida por metodo GET
    
    require('../../Model/Conexion.php');
    require('../../Model/Usuarios.php');

    $usuario = new Usuarios(null,null,$_GET['correo']);
    $resultado = $usuario->verificar($_GET['contrasena']);

    if($resultado){
        echo "true";
    }else{
        echo "false";
    }
?>