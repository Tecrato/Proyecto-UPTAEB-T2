<?php 
    // Este es el codigo fusible de la pagina
    // Si alguien que no esta logueado entra, pal login
    session_start();
    if (!isset($_SESSION['user_name'])) {
        header('Location:login?err=4');
        die();
    } 
  
   
    $b = new Usuario(id:$_SESSION['user_id']);
    $busqueda = $b->search();
   
    
    if ($_SESSION['sesion_id'] != $busqueda[0]['sesion_id']) {
            header('Location:login?err=5');
    }   
?>