<?php

    if (isset($_GET['p'])){
        $num = $_GET['p'];
    }else {
        $num = 0;
    }

    require('../Model/Conexion.php');
    require('../Model/Productos.php');
    require('../Model/Proveedores.php');
    require('../Model/Categorias.php');
    require('../Model/Unidades.php');
    require('../Model/Lotes.php');


    function pasar_a_option($busqueda){
        $var = "";

        while ($row = $busqueda->fetch_assoc()) {
            $var = $var.'<option value="'.$row["id"].'">'.$row["nombre"].'</option>';
        }
        return $var;
    }

    $clase_Producto = new Producto();
    $result = $clase_Producto->search($num);


    $clase_Proveedor = new Proveedor();
    $result2 = $clase_Proveedor->search();
    $list_proveedores = pasar_a_option($result2);

    $clase_Categoria = new Categoria();
    $result2 = $clase_Categoria->search();
    $list_categorias = pasar_a_option($result2);

    $clase_Unidad = new Unidad();
    $result2 = $clase_Unidad->search();
    $list_unidades = pasar_a_option($result2);


    

    

    include('../View/product.php');

    echo '<script>var num_page = '.$num.';</script>';
    echo '<script>var type_page = "productos";</script>';
    
    if (isset($_GET['error'])) {
        if ($_GET['error'] == 3){
            echo "<script>UIkit.notification({message: '<span>El producto ya esta siendo utilizado.</span>' , status:'error'})</script>";   
        } elseif ($_GET['error'] == 1){
            echo "<script>UIkit.notification({message: '<span>A ocurrido un error con la imagen.</span>' , status:'error'})</script>";   
        } elseif ($_GET['error'] == 2){
            echo "<script>UIkit.notification({message: '<span>Extencion de imagen inválidq.</span>' , status:'error'})</script>";   
        } elseif ($_GET['error'] == 4){
            echo "<script>UIkit.notification({message: '<span>No se ha podido almacenar la imagen.</span>' , status:'error'})</script>";   
        } elseif ($_GET['error'] == 5){
            echo "<script>UIkit.notification({message: '<span>Tamaño limite exedido.</span>' , status:'error'})</script>";   
        }
    }
    
?>