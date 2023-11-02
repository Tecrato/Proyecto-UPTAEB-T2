<?php
    require('../../Model/Conexion.php');
    require('../../Model/Lotes.php');

    if ($_POST['TB'] == 'NP' && $_POST['ID']) {
        $clase = new Lote();
        $result = $clase->search_proveedor_from_product($_POST['ID']);
    }
    elseif ($_POST['TB'] == 'LP'){
        $clase = new Lote();
        $result = $clase->search_with_producto_and_proveedor($_POST['ID'], $_POST['SUPPLIER']);
    }
    elseif ($_POST['TB'] == 'MODAL') {
        $clase = new Lote();
        $result = $clase->search_modal_details($_POST['ID']);
    }
    $lista=array();

    for ($i=0; $i < $count($result); $i++) { 
        $row = $result[$i];
        array_push($lista, $row);
    }
$json = [
    'lista'=> $lista
];
$json = json_encode($json);
echo($json);

?>


