<?php
    $page = "login"; // default
    $type = "view"; // default

    if (isset($_GET['page'])){
        $page = $_GET['page'];
    }
    if (isset($_GET['type'])){
        $type = $_GET['type'];
    }
    
    if ($type == "view"){
        require_once('Controller/C_'.$page.'.php');
        exit(0);
    }
    else if ($type == "funcion"){
        require_once('Controller/funcs/'.$page.'.php');
        exit(0);
    }
    else if ($type == "funcion_ajax"){
        require_once('Controller/funcs_ajax/'.$page.'.php');
        exit(0);
    }
