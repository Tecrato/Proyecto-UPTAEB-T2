<?php

// Este es el codigo fusible de la pagina
// Si alguien que no esta logueado entra, pal login
use Shtechnologyx\Pt3\Model\Usuario;

session_start();
if (!isset($_SESSION['user_name'])) {
    header('Location:Login?err=4');
    die();
}


$b = new Usuario(id: $_SESSION['user_id']);
$busqueda = $b->search();


if ($_SESSION['sesion_id'] != $busqueda[0]['sesion_id']) {
    header('Location:Login?err=5');
}
