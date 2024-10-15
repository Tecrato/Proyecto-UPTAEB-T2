DELIMITER $$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ProductosMasVendidosPorAno`(IN `ano` INT)
BEGIN
    SELECT 
        p.id AS id,
        p.nombre AS nombre,
        p.valor_unidad AS unidad_valor,
        (SELECT u.nombre FROM proyecto_4.unidades u WHERE u.id = p.id_unidad) AS unidad,
        (SELECT m.nombre FROM proyecto_4.marcas m WHERE m.id = p.id_marca) AS marca,
        COALESCE(
            (SELECT SUM(f.cantidad) 
             FROM proyecto_4.factura f
             JOIN proyecto_4.registro_ventas r ON f.id_registro_ventas = r.id
             WHERE f.id_productos = p.id AND YEAR(r.fecha) = ano), 0
        ) AS cantidad
    FROM proyecto_4.productos p
    WHERE p.active = 1
    ORDER BY cantidad DESC
    LIMIT 5;
END$$

DELIMITER ;

DELIMITER $$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ProductosMasVendidosPorMes`(IN ano INT, IN mes INT)
BEGIN
    SELECT 
        p.id AS id,
        p.nombre AS nombre,
        p.valor_unidad AS unidad_valor,
        (SELECT u.nombre FROM proyecto_4.unidades u WHERE u.id = p.id_unidad) AS unidad,
        (SELECT m.nombre FROM proyecto_4.marcas m WHERE m.id = p.id_marca) AS marca,
        COALESCE(
            (SELECT SUM(f.cantidad) 
             FROM proyecto_4.factura f
             JOIN proyecto_4.registro_ventas r ON f.id_registro_ventas = r.id
             WHERE f.id_productos = p.id AND YEAR(r.fecha) = ano AND MONTH(r.fecha) = mes), 0
        ) AS cantidad
    FROM proyecto_4.productos p
    WHERE p.active = 1
    ORDER BY cantidad DESC
    LIMIT 5;
END$$

DELIMITER ;

DELIMITER $$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ProductosMenosVendidosPorAno`(IN `ano` INT)
BEGIN
    SELECT 
        p.id AS id,
        p.nombre AS nombre,
        p.valor_unidad AS unidad_valor,
        (SELECT u.nombre FROM proyecto_4.unidades u WHERE u.id = p.id_unidad) AS unidad,
        (SELECT m.nombre FROM proyecto_4.marcas m WHERE m.id = p.id_marca) AS marca,
        COALESCE(
            (SELECT SUM(f.cantidad) 
             FROM proyecto_4.factura f
             JOIN proyecto_4.registro_ventas r ON f.id_registro_ventas = r.id
             WHERE f.id_productos = p.id AND YEAR(r.fecha) = ano), 0
        ) AS cantidad
    FROM proyecto_4.productos p
    WHERE p.active = 1
    ORDER BY cantidad ASC
    LIMIT 5;
END$$

DELIMITER ;

DELIMITER $$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ProductosMenosVendidosPorMes`(IN ano INT, IN mes INT)
BEGIN
    SELECT 
        p.id AS id,
        p.nombre AS nombre,
        p.valor_unidad AS unidad_valor,
        (SELECT u.nombre FROM proyecto_4.unidades u WHERE u.id = p.id_unidad) AS unidad,
        (SELECT m.nombre FROM proyecto_4.marcas m WHERE m.id = p.id_marca) AS marca,
        COALESCE(
            (SELECT SUM(f.cantidad) 
             FROM proyecto_4.factura f
             JOIN proyecto_4.registro_ventas r ON f.id_registro_ventas = r.id
             WHERE f.id_productos = p.id AND YEAR(r.fecha) = ano AND MONTH(r.fecha) = mes), 0
        ) AS cantidad
    FROM proyecto_4.productos p
    WHERE p.active = 1
    ORDER BY cantidad ASC
    LIMIT 5;
END$$

DELIMITER ;
