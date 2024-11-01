<?php
    // archivo hecho para imprimir si la contraseña coincide con el hash de la base de datos, la contraseña es traida por metodo GET
    use Shtechnologyx\Pt3\Model\Usuario;

    $c = new Usuario(null,null,$correo); // Llamamos al modelos y se busca el usuario
    $result = $c->search();
    // $usuario = new Usuarios(null,null,$_GET['correo']);
    // $resultado = $usuario->verificar(password_hash($_GET['contrasena'],PASSWORD_DEFAULT));

    if(password_verify($password,$result[0]['hash'])){
        echo "true";
    }else{
        echo "false";
    }
?>