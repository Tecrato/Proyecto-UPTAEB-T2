<?php 
    // Este es el codigo fusible de la pagina
    // Si alguien que no esta logueado entra, pal login
    session_start();
    if (!isset($_SESSION['user_name'])) {
        header('Location:login');
        die();
        /* print_r("pal lobby"); */
    } 
  
  /*   require "../Model/Usuarios.php"; */
   
    $b = new Usuario(id:$_SESSION['user_id']);
    $busqueda = $b->search();
  /*   print_r($busqueda); */
   
    
    if ($_SESSION['sesion_id'] != $busqueda[0]['sesion_id']) {
            header('Location:login');
            die();
           /*  print_r("pal gulag"); */
    }   
?>