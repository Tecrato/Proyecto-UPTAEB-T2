<?php
session_start();

    $pagina = "Usuarios"; // default
    /* $type = "view"; */ // default

    if (isset($_GET['pagina'])){
        $pagina = $_GET['pagina'];
    }
    if (is_file("src/Controller/".$pagina.".php")){
        require_once('src/Controller/'.$pagina.'.php');
    }    
    else{
        echo "PAGINA EN CONSTRUCCIÓN";
    }
    

    //esto lo hizo Edouard asi q despues vemos
    /*  else if ($type == "funcion"){
        require_once('Controller/funcs/'.$page.'.php');
        exit(0);
    }
    else if ($type == "funcion_ajax"){
        require_once('Controller/funcs_ajax/'.$page.'.php');
        exit(0);
    }
    */
/*     if (isset($_GET['type'])){
        $type = $_GET['type'];
    } */
    