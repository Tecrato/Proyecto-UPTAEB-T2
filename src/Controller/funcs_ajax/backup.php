<?php


use Shtechnologyx\Pt3\Model\Conexion;
use Shtechnologyx\Pt3\Model\Usuario;
use Shtechnologyx\Pt3\Model\Db_base;
include("Controller/funcs/verificar.php");

if (isset($_POST['type']) && $_POST['type'] == 'Insert') {
    $clase = new DB();
    $result = $clase->Backup($_POST['type']);
    echo $result;
   
} else if (isset($_POST['type'])) {
    if ($_POST['type'] == 'Search') {
        $clase = new DB();
        $result = $clase->Backup($_POST['type']);
        $json = [];
        foreach ($result as $value) {
            $json[] = $value;
        }
        $json = json_encode($json);
        echo ($json);
    } 
    else if ($_POST['type'] == 'Delete') {
        $clase = new DB();
        $result = $clase->Backup($_POST['type']);
        foreach ($result as $value) {
            if ($value == $_POST['name']) {
                unlink("Backups/$value");
                echo ("Eliminacion exitosa");
            }
        }
    }
}
