<?php
    class Estadisticas extends DB {

        function __construct(){
            DB::__construct();
        }
        function ratio_ventas(){
            $query = $this->conn->prepare('SELECT * FROM ratio_ventas');
            $query->execute();
            return $query->fetchAll();
        }
        function ValorTotalInventario(){
            $query = $this->conn->prepare('SELECT * FROM valortotalinventario');
            $query->execute();
            return $query->fetchAll();
        }
        function total_productos_categoria(){
            $query = $this->conn->prepare('SELECT * FROM total_productos_categoria');
            $query->execute();
            return $query->fetchAll();
        }
        function total_stock_categoria(){
            $query = $this->conn->prepare('SELECT * FROM total_stock_categoria');
            $query->execute();
            return $query->fetchAll();
        }
        function max_ventas(){
            $query = $this->conn->prepare('SELECT * FROM max_ventas');
            $query->execute();
            return $query->fetchAll();
        }
        function min_ventas(){
            $query = $this->conn->prepare('SELECT * FROM min_ventas');
            $query->execute();
            return $query->fetchAll();
        }

        function clientes_frecuentes(){
            $query = $this->conn->prepare('SELECT * FROM clientesfrecuentes;');
            $query->execute();
            return $query->fetchAll();
        }
        function search_proveedor_from_product($id_producto){
            $query = $this->conn->prepare('SELECT id_proveedor, (SELECT razon_social FROM proveedores p WHERE p.id = entradas.id_proveedor) AS proveedor FROM entradas WHERE id_producto=:id GROUP BY id_proveedor');
            $query->bindParam(':id',$id_producto);
            $query->execute();
            return $query->fetchAll();
        }
    }
?>

