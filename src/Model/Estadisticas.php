<?php

namespace Shtechnologyx\Pt3\Model;


class Estadisticas extends Conexion
{

    function __construct()
    {
        Conexion::__construct();
    }
    function ratio_ventas()
    {
        $query = $this->conn->prepare('SELECT * FROM ratio_ventas');
        $query->execute();
        return $query->fetchAll();
    }
    function ValorTotalInventario()
    {
        $query = $this->conn->prepare('SELECT * FROM valortotalinventario');
        $query->execute();
        return $query->fetchAll();
    }
    function total_productos_categoria()
    {
        $query = $this->conn->prepare('SELECT * FROM total_productos_categoria');
        $query->execute();
        return $query->fetchAll();
    }
    function total_stock_categoria()
    {
        $query = $this->conn->prepare('SELECT * FROM total_stock_categoria');
        $query->execute();
        return $query->fetchAll();
    }
    function max_ventas()
    {
        $query = $this->conn->prepare('SELECT * FROM max_ventas');
        $query->execute();
        return $query->fetchAll();
    }
    function min_ventas()
    {
        $query = $this->conn->prepare('SELECT * FROM min_ventas');
        $query->execute();
        return $query->fetchAll();
    }

    function clientes_frecuentes()
    {
        $query = $this->conn->prepare('SELECT * FROM clientesfrecuentes;');
        $query->execute();
        return $query->fetchAll();
    }
    function search_proveedor_from_product($id_producto)
    {
        $query = $this->conn->prepare('SELECT id_proveedor, (SELECT razon_social FROM proveedores p WHERE p.id = entradas.id_proveedor) AS proveedor FROM entradas WHERE id_producto=:id GROUP BY id_proveedor');
        $query->bindParam(':id', $id_producto);
        $query->execute();
        return $query->fetchAll();
    }
    function ganancias_mensuales()
    {
        $query = $this->conn->prepare('SELECT * FROM ganacias_mensuales;');
        $query->execute();
        return $query->fetchAll();
    }
    function valor_inventario_mes()
    {
        $query = $this->conn->prepare('SELECT * FROM valor_promedio_inventario_mensual;');
        $query->execute();
        return $query->fetchAll();
    }
    function coste_productos_vendidos()
    {
        $query = $this->conn->prepare('SELECT * FROM coste_productos_vendidos;');
        $query->execute();
        return $query->fetchAll();
    }
    function rotacion_inventario()
    {
        $query = $this->conn->prepare('SELECT * FROM `rotacion_inventario`;');
        $query->execute();
        return $query->fetchAll();
    }

    function filter_year_ganancias($year)
    {
        $query = $this->conn->prepare('call ObtenerGananciasMensuales('.$year.');');
        $query->execute();
        return $query->fetchAll();
    }

    function filter_week_ganancias($i, $f)
    {
        $query = $this->conn->prepare("call ObtenerGananciasSemanales('$i','$f');");
        $query->execute();
        return $query->fetchAll();
    }

    function filter_max_anio($anio)
    {
        $query = $this->conn->prepare("call ProductosMasVendidosPorAno($anio);");
        $query->execute();
        return $query->fetchAll();
    }

    function filter_max_anio_mes($anio, $mes)
    {
        $query = $this->conn->prepare("call ProductosMasVendidosPorMes($anio, $mes);");
        $query->execute();
        return $query->fetchAll();
    }

    function filter_min_anio($anio)
    {
        $query = $this->conn->prepare("call ProductosMenosVendidosPorAno($anio);");
        $query->execute();
        return $query->fetchAll();
    }

    function filter_min_anio_mes($anio, $mes)
    {
        $query = $this->conn->prepare("call ProductosMenosVendidosPorMes($anio, $mes);");
        $query->execute();
        return $query->fetchAll();
    }
}
