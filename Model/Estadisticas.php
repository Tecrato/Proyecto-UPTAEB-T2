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
    }
?>

