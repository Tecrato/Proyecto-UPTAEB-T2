<?php
    class Producto extends DB{

        // esta funcion agrega a la tabla productos un objeto con los valores que se le estan pasando
        function agregar($categoria,$unidades,$nombre,$descripcion,$imagen,$stock_min,$stock_max,$IVA){
            
            $query = "INSERT INTO productos VALUES(null, $categoria, $unidades,'$nombre', '$descripcion','$imagen',$stock_min,$stock_max,$IVA)";
            
            $this->conn->query($query);
        }

        function agregar_lote($id_producto,$id_proveedor,$cantidad,$fecha_c,$fecha_v,$precio_compra){
            
            $query = "INSERT INTO lotes VALUES(null, $id_producto, $id_proveedor, $cantidad,'$fecha_c', '$fecha_v',$precio_compra)";
            
            $this->conn->query($query);
        }
        function borrar_lotes($id_proveedor) {

            $query = "DELETE FROM lotes WHERE id_proveedor=$id_proveedor";
            
            $this->conn->query($query);
        }

        // con esta funcion se elimina un elemento dependiendo de su id
        function DELETE($id) {

            $query = "DELETE FROM productos WHERE ID=$id";
            
            $this->conn->query($query);
        }

        // Con esta funcion podremos cambiar un producto segun su ID con los valores que le pasemos
        function UPDATE($id,$categoria,$unidades,$nombre,$descripcion,$imagen,$stock_min,$stock_max,$IVA){
            
            
            $query = "UPDATE productos SET id_categoria=".$categoria.", id_unidad=".$unidades.", nombre='".$nombre."', descripcion='".$descripcion."', stock_min=".$stock_min.", stock_max=".$stock_max.", IVA=".$IVA;
            if ($imagen != null) {
                $query = $query . ", imagen='".$imagen."' ";
            }
            $query = $query . " WHERE id=$id";
            
            return $this->conn->query($query); //$conn->fetch_assoc() // Y devuelve el resultado al controlador
        }

        // Con esta otra funcion se busca entre los productos en la base de datos
        function search($id=null,$nombre=null,$descripcion=null,$precio_compra=null,$precio_venta=null,$stock=null,$fecha=null,$categoria=null,$distribuidor=null,$n=0,$limite=true){
            // Al igual que la clase anterior, puede buscar segun muchos valores o solo algunos
            $querys = [];
            $query = "SELECT * FROM productos WHERE";
            if ($id != null){
                array_push($querys," id=$id");
            }
            if ($nombre != null) {
                if (count($querys) > 0){
                    array_push($querys," AND");
                }
                array_push($querys," Nombre='$nombre'");
            }
            if ($descripcion != null) {
                if (count($querys) > 0){
                    $querys->array_push(" AND");
                }
                array_push($querys," Descripcion='$descripcion'");
            }
            if ($precio_compra != null) {
                if (count($querys) > 0){
                    array_push($querys," AND");
                }
                array_push($querys," Precio='$precio_compra'");
            }
            if ($precio_venta != null) {
                if (count($querys) > 0){
                    $querys->array_push(" AND");
                }
                $querys->array_push(" precio_venta='$precio_venta'");
            }
            if ($stock != null) {
                if (count($querys) > 0){
                    $querys->array_push(" AND");
                }
                $querys->array_push(" stock='$stock'");
            }
            if ($fecha != null) {
                if (count($querys) > 0){
                    $querys->array_push(" AND");
                }
                $querys->array_push(" Fecha_compra='$fecha'");
            }
            if ($categoria != null) {
                if (count($querys) > 0){
                    $querys->array_push(" AND");
                }
                $querys->array_push(" categoria='$categoria'");
            }
            if ($distribuidor != null) {
                if (count($querys) > 0){
                    $querys->array_push(" AND");
                }
                $querys->array_push(" distribuidor='$distribuidor'");
            }

            if (count($querys) < 1) { // Si no hay condiciones se obtienen 9 resultados dependiento de en que pagina esta el usuario
                $s = $n*9;
                $query = "SELECT * FROM productos";
                if ($limite) {
                    $query = $query . " LIMIT 9 OFFSET ".$s;
                }
            } else { // Sino
                foreach ($querys as $q) { // Se pasa con los filtros
                    $query = $query . $q;;
                    $query = $query ." LIMIT 9 OFFSET ".$n*9;
                }
            }
            
            return $this->conn->query($query);
        }
        function search_like($nombre){
            $query = "SELECT * FROM productos WHERE nombre LIKE '%$nombre%'";

            
            return $this->conn->query($query);
        }
        function COUNT(){
            
            return $this->conn->query("SELECT COUNT(*) as 'total' FROM productos")->fetch_assoc()['total'];
        }
    }
?>