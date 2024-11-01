<?php

    // Con este codigo de destruye la session
    // No quedara nada
    
    use Shtechnologyx\Pt3\Model\Usuario;
    use Shtechnologyx\Pt3\Model\Bitacora;

    try {
        $usu = new Usuario($_SESSION['user_id']);
        $usu->logout();
    
        $clase2 = new Bitacora(null,$_SESSION['user_id'],"Usuarios","Logout","Usuario ".$_SESSION['user_name']." des-logueado");
        $clase2->agregar();
    } catch (Exception $e) {

    }

    session_destroy();
    header("Location:Login"); // Y pal login
?>