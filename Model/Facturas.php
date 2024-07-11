<?php
class Factura extends DB {
    private $id;
    private $id_registro_ventas;
    private $id_productos;
    private $cantidad;
    private $coste_producto_total;

    function __construct($id = null, $id_registro_ventas = null, $id_productos = null, $cantidad = null, $coste_producto_total = null){
        $this->id = $id;
        $this->id_registro_ventas = $id_registro_ventas;
        $this->id_productos = $id_productos;
        $this->cantidad = $cantidad;
        $this->coste_producto_total = $coste_producto_total;
        DB::__construct();
    }

    function search($n=0,$limite=9, $order=' f.id ASC '){
        $query = "SELECT
        f.*,
        rv.fecha as fecha,
        p.nombre as nombre_producto,
        cl.nombre as cliente_nombre,
        cl.apellido as cliente_apellido,
        cl.documento as cliente_documento,
        cl.cedula as cliente_cedula,
        u.nombre as vendedor
        FROM factura as f 
        JOIN registro_ventas as rv ON rv.id=f.id_registro_ventas
        JOIN caja as ca ON ca.id=rv.id_caja
        JOIN productos as p ON p.id=f.id_productos
        JOIN clientes as cl ON cl.id=rv.id_cliente
        JOIN usuarios as u ON u.id=ca.id_usuario
        "; 

        $lista = [];

        if ($this->id != null){
            array_push($lista,'id');
        }
        if ($this->id_registro_ventas != null){
            array_push($lista, 'id_registro_ventas');
        }
        if ($lista) {
            foreach ($lista as $e){
                $query .= ' AND f.'.$e.'=:'.$e;
            }
        }
        $query .= " ORDER BY $order  LIMIT :l OFFSET :n";

        $query = $this->conn->prepare($query);

        $query->bindParam(':l', $limite, PDO::PARAM_INT);
        $query->bindParam(':n', $n, PDO::PARAM_INT);
        if ($this->id != null) {
            $query->bindParam(':id', $this->id, PDO::PARAM_INT);
        }
        if ($this->id_registro_ventas != null){
            $query->bindParam(':id_registro_ventas', $this->id_registro_ventas, PDO::PARAM_INT);
        }

        $query->execute();
        return $query->fetchAll();
    }
    function search_mountFact(){
        $query = $this->conn->prepare("SELECT monto_final - IVA AS subtotal,IVA,monto_final FROM registro_ventas WHERE id = :id");
        $query->bindParam(':id', $this->id);
        $query->execute();
        return $query->fetchAll();
    }

    function agregar(){
        $query = $this->conn->prepare("INSERT INTO factura VALUES(null, :id1, :id2, :cantidad, :coste)");

        $query->bindParam(':id1', $this->id_registro_ventas);
        $query->bindParam(':id2', $this->id_productos);
        $query->bindParam(':cantidad', $this->cantidad);
        $query->bindParam(':coste', $this->coste_producto_total);

        $query->execute();
    }

    function borrar(){
        if ($this->id_registro_ventas) {
            $query = $this->conn->prepare("DELETE FROM entradas WHERE id_registro_ventas=:id_registro");
            $query->bindParam(':id_registro', $this->id_registro_ventas);
            $query->execute();
        } else {
            throw new Exception("Error, debe pasar el id del registro asociado", 1);
        }
    }

    function search_pagos(){
        $query = $this->conn->prepare("SELECT 
        m.nombre,
        p.monto
        FROM pagos p
        INNER JOIN metodo_pago m ON m.id = p.id_metodo_pago
        INNER JOIN registro_ventas r ON p.id_venta = r.id
        WHERE r.id = :id");

        $query->bindParam(':id', $this->id);
        $query->execute();
        return $query->fetchAll();
    }

    function search_ProductFact(){
        $query = $this->conn->prepare("
                    SELECT cantidad,
                    (SELECT nombre FROM productos WHERE factura.id_productos = id) AS descripcion, 
                    (coste_producto_total / cantidad) AS valor_unit, 
                    cantidad * (SELECT precio_venta FROM productos WHERE factura.id_productos = id) AS Total 
                    FROM factura WHERE id_registro_ventas = :id_registro_ventas");
        $query->bindParam(':id_registro_ventas', $this->id_registro_ventas);
        $query->execute();
        return $query->fetchAll();
    }
}
