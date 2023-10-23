<?php
    class Producto extends DB{

        // esta funcion agrega a la tabla productos un objeto con los valores que se le estan pasando
        function agregar($categoria,$unidades,$nombre,$descripcion,$imagen,$stock_min,$stock_max,$precio_venta,$IVA){
            
            $query = "INSERT INTO productos VALUES(null, $categoria, $unidades,'$nombre', '$descripcion','$imagen',$stock_min,$stock_max,$precio_venta,$IVA)";
            
            $this->conn->query($query);
        }


        // con esta funcion se elimina un elemento dependiendo de su id
        function DELETE($id) {

            $query = "DELETE FROM productos WHERE ID=$id";
            
            $this->conn->query($query);
        }

        // Con esta funcion podremos cambiar un producto segun su ID con los valores que le pasemos
        function UPDATE($id,$categoria,$unidades,$nombre,$descripcion,$imagen,$stock_min,$stock_max,$precio_venta,$IVA){
            
            
            $query = "UPDATE productos SET id_categoria=".$categoria.", id_unidad=".$unidades.", nombre='".$nombre."', descripcion='".$descripcion."', stock_min=".$stock_min.", stock_max=".$stock_max.", precio_venta=".$precio_venta.", IVA=".$IVA;
            if ($imagen != null) {
                $query = $query . ", imagen='".$imagen."' ";
            }
            $query = $query . " WHERE id=$id";
            
            return $this->conn->query($query); //$conn->fetch_assoc() // Y devuelve el resultado al controlador
        }

        // Con esta otra funcion se busca entre los productos en la base de datos
        function search($id=null,$n=0,$limite=9){
            // Al igual que la clase anterior, puede buscar segun muchos valores o solo algunos
            $querys = [];
            $query = "SELECT * FROM productos";

            if ($id != null){
                $query = $query." WHERE id=$id";
            }

            $n = $n*$limite;
            $query = $query . " LIMIT $limite OFFSET ".$n;
            
            return $this->conn->query($query);
        }
        function search_stock($id){
            $query = "SELECT SUM(restante) as stock FROM lotes WHERE id_producto=$id";

            $r = $this->conn->query($query)->fetch_assoc()['stock'];
            return $r ?: 0;
        }
        function search_like($nombre){
            $query = "SELECT * FROM productos WHERE nombre LIKE '%$nombre%'";

            return $this->conn->query($query);
        }
        function search_luis(){
            $query = "SELECT id, nombre,(SELECT SUM(restante) FROM lotes Where id_producto = p.id) as stock,precio_venta,IVA FROM `productos` as p ORDER BY id";

            return $this->conn->query($query);
        }

        function search_target(){
            $query = "SELECT id, imagen, nombre,(SELECT SUM(restante) FROM lotes WHERE productos.id = id_producto) AS existencia FROM productos";

            return $this->conn->query($query);
        }

        function search_inventario(){
            $query = "SELECT id,descripcion,(SELECT SUM(cantidad) FROM lotes WHERE productos.id = id_producto) AS entradas,(SELECT SUM(cantidad) - (SELECT SUM(restante) FROM lotes WHERE productos.id = id_producto) FROM lotes WHERE productos.id = id_producto) AS salidas, (SELECT SUM(restante) FROM lotes WHERE productos.id = id_producto) AS existencia, precio_venta,(SELECT SUM(restante) FROM lotes WHERE productos.id = id_producto) * precio_venta AS Total FROM productos";

            return $this->conn->query($query);
        }

        function search_ValorInventario(){
            $query = "SELECT SUM((SELECT SUM(restante) FROM lotes WHERE productos.id = id_producto) * precio_venta) AS Total FROM productos";

            return $this->conn->query($query);
        }

        #######  SELECT id,(SELECT SUM(restante) FROM lotes Where id_producto = p.id) FROM `productos` as p
        function COUNT(){
            
            return $this->conn->query("SELECT COUNT(*) as 'total' FROM productos")->fetch_assoc()['total'];
        }
    }
?>