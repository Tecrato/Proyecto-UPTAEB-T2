<?php

    require("./../Model/Conexion.php");
    require('./../Model/Productos.php');

    $clase = new Producto();
    $result = $clase->search_inventario();
    $result2 = $clase->search_ValorInventario();