<?php
    class Factura extends DB {
        private $id;
        private $id_registro_ventas;
        private $id_productos;
        private $cantidad;
        private $coste_producto_total;

        function __construct($id = null, $id_registro_ventas = null, $id_productos = null, $cantidad = null, $coste_producto_total = null) {
            $this->id = $id;
            $this->id_registro_ventas = $id_registro_ventas;
            $this->id_productos = $id_productos;
            $this->cantidad = $cantidad;
            $this->coste_producto_total = $coste_producto_total;
            DB::__construct();
        }
        
        function search($id = null, $order = 'id DESC') {
            $query = "SELECT * FROM factura";
            if ($this->id) {
                $query = $query . " WHERE id=:id";
            }
            $query = $query . " ORDER BY $order";

            $query = $this->conn->prepare("SELECT * FROM factura");

            $query->bindParam(':l', $limite, PDO::PARAM_INT);
            $query->bindParam(':n', $n, PDO::PARAM_INT);
            if ($this->id != null) {
                $query->bindParam(':id', $this->id, PDO::PARAM_INT);
            }

            $query->execute();
            return $query->fetchAll();
        }

        function agregar() {
            $query = $this->conn->prepare("INSERT INTO factura VALUES(null, :id1, :id2, :cantidad, :coste)");

            $query->bindParam(':id1', $this->id_registro_ventas);
            $query->bindParam(':id2', $this->id_productos);
            $query->bindParam(':cantidad', $this->cantidad);
            $query->bindParam(':coste', $this->coste_producto_total);

            $query->execute();
        }

        function borrar() {
            if ($this->id_registro_ventas) {
                $query = $this->conn->prepare("DELETE FROM entradas WHERE id_registro_ventas=:id_registro");
                $query->bindParam(':id_registro', $this->id_registro_ventas);
                $query->execute();
            } else {
                throw new Exception("Error, debe pasar el id del registro asociado", 1);
            }

        }

        function search_detailsFact()
        {
            $query = $this->conn->prepare("SELECT id,fecha,(SELECT nombre FROM clientes WHERE registro_ventas.id_cliente = id) AS nombre, (SELECT Apellido FROM clientes WHERE registro_ventas.id_cliente = id) AS apellido, (SELECT Cedula FROM clientes WHERE registro_ventas.id_cliente = id) AS cedula,(SELECT documento FROM clientes WHERE registro_ventas.id_cliente = id) AS documento, metodo_pago,(SELECT nombre FROM usuarios WHERE registro_ventas.id_usuario = id) AS vendedor FROM registro_ventas WHERE id = :id");
    
            $query->bindParam(':id', $this->id);
            $query->execute();
            return $query->fetchAll()[0];
        }
    
        function search_mountFact()
        {
            $query = $this->conn->prepare("SELECT ROUND(monto_final - IVA) AS subtotal,IVA,monto_final FROM registro_ventas WHERE id = :id");
            $query->bindParam(':id', $this->id);
            $query->execute();
            return $query->fetchAll();
        }
    
        function search_ProductFact()
        {
            $query = $this->conn->prepare("
                    SELECT cantidad,
                    (SELECT nombre FROM productos WHERE factura.id_productos = id) AS descripcion, 
                    (SELECT precio_venta FROM productos WHERE factura.id_productos = id) AS valor_unit, 
                    cantidad * (SELECT precio_venta FROM productos WHERE factura.id_productos = id) AS Total 
    
                    FROM factura WHERE id_registro_ventas = :id");
            $query->bindParam(':id', $this->id);
            $query->execute();
            return $query->fetchAll();
        }
    
    }