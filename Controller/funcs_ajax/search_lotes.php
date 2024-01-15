<?php
    require('../../Model/Conexion.php');
    require('../../Model/Entradas.php');

    if ($_POST['TB'] == 'NP' && $_POST['ID']) {
        $clase = new Entrada(null,$_POST['ID']);
        $result = $clase->search_proveedor_from_product();
    }
    elseif ($_POST['TB'] == 'LP'){
        $clase = new Entrada(null,$_POST['ID'], $_POST['SUPPLIER']);
        $result = $clase->search_with_producto_and_proveedor();
    }
    elseif ($_POST['TB'] == 'MODAL') {
        $clase = new Entrada(null,$_POST['ID']);
        $result = $clase->search_modal_details();
    }
    $lista=array();

    for ($i=0; $i < count($result); $i++) { 
        $row = $result[$i];
        array_push($lista, $row);
    }
    $json = [
        'lista'=> $lista
    ];
    $json = json_encode($json);
    echo($json);

?>


