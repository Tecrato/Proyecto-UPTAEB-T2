<?php
    require "../vendor/autoload.php";
    require_once("../variables.php");
    use Shtechnologyx\Pt3\Model\Usuario;
    use Shtechnologyx\Pt3\Model\Permisos;

    session_start();
    $page = "login";
    $type = "view";

    if (isset($_GET['page'])){
        $page = $_GET['page'];
    }
    if (isset($_GET['type'])){
        $type = $_GET['type'];
    }

    if ($page != "login" and $type == "view") {
        if (!isset($_SESSION['user_name']) or $_SESSION['user_name'] == "") {
            header('Location:Login?err=4');
            die();
        }
    }
    if ($page != "login" and $page != "index" and $page != "perfil" and $type == "view") {
        $b = new Usuario(id: $_SESSION['user_id']);
        $busqueda = $b->search();
        if ($_SESSION['sesion_id'] != $busqueda[0]['sesion_id']) {
            header('Location:Login?err=5');
            die();
        }
        $other_class = new Permisos(null, $busqueda[0]['id'], $page, 'consultar');
        $result = $other_class->search();
        if (count($result) <= 0 and $_SESSION['rol_num'] > 1) {
            // print_r($type);
            // print_r(count($result) <= 0 and $_SESSION['rol_num'] > 1);
            header('Location:Inicio');
            die();
        }
    }
    
    if ($type == "view"){
        require_once('Controller/C_'.$page.'.php');
        // include('View/'.$page.'.php');
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
    else if ($type == "pdfs"){
        require_once('Controller/pdfs/PDF_'.$page.'.php');
        exit(0);
    }
