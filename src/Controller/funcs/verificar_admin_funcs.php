<?php
namespace Shtechnologyx\Pt3\Controller\funcs;

    if ($_SESSION['rol_num'] > 2) {
        header('Location: ../../Inicio');
        die();
    }
?>