-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-11-2024 a las 15:52:07
-- Versión del servidor: 8.0.34
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyecto_7`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `AsignarTotalVentasDia` (IN `id_caja` INT(250))   BEGIN
    DECLARE asignar_total_ventas FLOAT;
    DECLARE credito_monto FLOAT;
	SELECT SUM(rv.monto_final) INTO asignar_total_ventas FROM registro_ventas rv WHERE rv.id_caja = id_caja;
    SELECT IFNULL(SUM(c.monto_final),0) INTO credito_monto
    FROM credito c
    JOIN registro_ventas rv ON c.id_rv = rv.id
    WHERE rv.id_caja = id_caja;
    
	UPDATE caja c SET c.monto_final=(asignar_total_ventas+c.monto_inicial), c.fecha_cierre = CURRENT_TIMESTAMP, c.estado = 1,
     c.monto_credito = credito_monto, c.total_ventas = (SELECT COUNT(rv2.id) FROM registro_ventas rv2 WHERE rv2.id_caja = c.id) WHERE c.id = id_caja AND c.estado = 0;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `check_and_notify` ()   BEGIN
    DECLARE done INT DEFAULT FALSE;
    DECLARE entrada_id INT;
    DECLARE entrada_fecha_venc DATE;
    DECLARE producto_nombre VARCHAR(255);
    DECLARE diff INT;
    DECLARE cur CURSOR FOR 
        SELECT e.id, e.fecha_vencimiento, p.nombre 
        FROM detalles_entradas e 
        JOIN productos p ON e.id_producto = p.id 
        WHERE e.active = 1 AND e.existencia > 0;
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;

    OPEN cur;

    read_loop: LOOP
        FETCH cur INTO entrada_id, entrada_fecha_venc, producto_nombre;
        IF done THEN
            LEAVE read_loop;
        END IF;

        SET diff = dias_diferencia(CURDATE(), entrada_fecha_venc);

        CASE diff
            WHEN 5 THEN
                INSERT INTO notificaciones (id_usuario, status, mensaje, fecha)
                VALUES (1, 0, CONCAT('El lote con numero ', entrada_id, ' del producto ' '', producto_nombre ,' vence en 30 días.'), NOW());
            WHEN 15 THEN
                INSERT INTO notificaciones (id_usuario, status, mensaje, fecha)
                VALUES (1, 0, CONCAT('El lote con numero ', entrada_id, ' del producto ' '', producto_nombre ,' vence en 15 días.'), NOW());
            WHEN 7 THEN
                INSERT INTO notificaciones (id_usuario, status, mensaje, fecha)
                VALUES (1, 0, CONCAT('El lote con numero ', entrada_id, ' del producto ' '', producto_nombre ,' vence en 7 días.'), NOW());
            WHEN 0 THEN
                INSERT INTO notificaciones (id_usuario, status, mensaje, fecha)
                VALUES (1, 0, CONCAT('El lote con numero ', entrada_id, ' del producto ' '', producto_nombre ,' vence hoy.'), NOW());
            ELSE
                -- No se especifica ELSE ya que no queremos realizar ninguna acción adicional.
                SET diff = diff;  -- No-op
        END CASE;

    END LOOP;

    CLOSE cur;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ObtenerGananciasMensuales` (IN `anio` INT)   BEGIN
    SELECT 
        (SELECT COALESCE(ROUND(SUM(m.monto) + 
            (SELECT SUM(m.monto) 
             FROM proyecto_4.movimientos_capital m 
             WHERE m.monto LIKE '-%' AND MONTH(m.fecha) = 1 
               AND YEAR(m.fecha) = anio), 2), 0) 
         FROM proyecto_4.movimientos_capital m 
         WHERE NOT(m.monto LIKE '-%') AND MONTH(m.fecha) = 1 
           AND YEAR(m.fecha) = anio) AS Enero,

        (SELECT COALESCE(ROUND(SUM(m.monto) + 
            (SELECT SUM(m.monto) 
             FROM proyecto_4.movimientos_capital m 
             WHERE m.monto LIKE '-%' AND MONTH(m.fecha) = 2 
               AND YEAR(m.fecha) = anio), 2), 0) 
         FROM proyecto_4.movimientos_capital m 
         WHERE NOT(m.monto LIKE '-%') AND MONTH(m.fecha) = 2 
           AND YEAR(m.fecha) = anio) AS Febrero,

        (SELECT COALESCE(ROUND(SUM(m.monto) + 
            (SELECT SUM(m.monto) 
             FROM proyecto_4.movimientos_capital m 
             WHERE m.monto LIKE '-%' AND MONTH(m.fecha) = 3 
               AND YEAR(m.fecha) = anio), 2), 0) 
         FROM proyecto_4.movimientos_capital m 
         WHERE NOT(m.monto LIKE '-%') AND MONTH(m.fecha) = 3 
           AND YEAR(m.fecha) = anio) AS Marzo,

        (SELECT COALESCE(ROUND(SUM(m.monto) + 
            (SELECT SUM(m.monto) 
             FROM proyecto_4.movimientos_capital m 
             WHERE m.monto LIKE '-%' AND MONTH(m.fecha) = 4 
               AND YEAR(m.fecha) = anio), 2), 0) 
         FROM proyecto_4.movimientos_capital m 
         WHERE NOT(m.monto LIKE '-%') AND MONTH(m.fecha) = 4 
           AND YEAR(m.fecha) = anio) AS Abril,

        (SELECT COALESCE(ROUND(SUM(m.monto) + 
            (SELECT SUM(m.monto) 
             FROM proyecto_4.movimientos_capital m 
             WHERE m.monto LIKE '-%' AND MONTH(m.fecha) = 5 
               AND YEAR(m.fecha) = anio), 2), 0) 
         FROM proyecto_4.movimientos_capital m 
         WHERE NOT(m.monto LIKE '-%') AND MONTH(m.fecha) = 5 
           AND YEAR(m.fecha) = anio) AS Mayo,

        (SELECT COALESCE(ROUND(SUM(m.monto) + 
            (SELECT SUM(m.monto) 
             FROM proyecto_4.movimientos_capital m 
             WHERE m.monto LIKE '-%' AND MONTH(m.fecha) = 6 
               AND YEAR(m.fecha) = anio), 2), 0) 
         FROM proyecto_4.movimientos_capital m 
         WHERE NOT(m.monto LIKE '-%') AND MONTH(m.fecha) = 6 
           AND YEAR(m.fecha) = anio) AS Junio,

        (SELECT COALESCE(ROUND(SUM(m.monto) + 
            (SELECT SUM(m.monto) 
             FROM proyecto_4.movimientos_capital m 
             WHERE m.monto LIKE '-%' AND MONTH(m.fecha) = 7 
               AND YEAR(m.fecha) = anio), 2), 0) 
         FROM proyecto_4.movimientos_capital m 
         WHERE NOT(m.monto LIKE '-%') AND MONTH(m.fecha) = 7 
           AND YEAR(m.fecha) = anio) AS Julio,

        (SELECT COALESCE(ROUND(SUM(m.monto) + 
            (SELECT SUM(m.monto) 
             FROM proyecto_4.movimientos_capital m 
             WHERE m.monto LIKE '-%' AND MONTH(m.fecha) = 8 
               AND YEAR(m.fecha) = anio), 2), 0) 
         FROM proyecto_4.movimientos_capital m 
         WHERE NOT(m.monto LIKE '-%') AND MONTH(m.fecha) = 8 
           AND YEAR(m.fecha) = anio) AS Agosto,

        (SELECT COALESCE(ROUND(SUM(m.monto) + 
            (SELECT SUM(m.monto) 
             FROM proyecto_4.movimientos_capital m 
             WHERE m.monto LIKE '-%' AND MONTH(m.fecha) = 9 
               AND YEAR(m.fecha) = anio), 2), 0) 
         FROM proyecto_4.movimientos_capital m 
         WHERE NOT(m.monto LIKE '-%') AND MONTH(m.fecha) = 9 
           AND YEAR(m.fecha) = anio) AS Septiembre,

        (SELECT COALESCE(ROUND(SUM(m.monto) + 
            (SELECT SUM(m.monto) 
             FROM proyecto_4.movimientos_capital m 
             WHERE m.monto LIKE '-%' AND MONTH(m.fecha) = 10 
               AND YEAR(m.fecha) = anio), 2), 0) 
         FROM proyecto_4.movimientos_capital m 
         WHERE NOT(m.monto LIKE '-%') AND MONTH(m.fecha) = 10 
           AND YEAR(m.fecha) = anio) AS Octubre,

        (SELECT COALESCE(ROUND(SUM(m.monto) + 
            (SELECT SUM(m.monto) 
             FROM proyecto_4.movimientos_capital m 
             WHERE m.monto LIKE '-%' AND MONTH(m.fecha) = 11 
               AND YEAR(m.fecha) = anio), 2), 0) 
         FROM proyecto_4.movimientos_capital m 
         WHERE NOT(m.monto LIKE '-%') AND MONTH(m.fecha) = 11 
           AND YEAR(m.fecha) = anio) AS Noviembre,

        (SELECT COALESCE(ROUND(SUM(m.monto) + 
            (SELECT SUM(m.monto) 
             FROM proyecto_4.movimientos_capital m 
             WHERE m.monto LIKE '-%' AND MONTH(m.fecha) = 12 
               AND YEAR(m.fecha) = anio), 2), 0) 
         FROM proyecto_4.movimientos_capital m 
         WHERE NOT(m.monto LIKE '-%') AND MONTH(m.fecha) = 12 
           AND YEAR(m.fecha) = anio) AS Diciembre
    ;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ObtenerGananciasSemanales` (IN `fecha_inicio` DATE, IN `fecha_fin` DATE)   BEGIN
    -- CTE para obtener las semanas en el rango dado
    WITH semanas AS (
        SELECT DISTINCT WEEK(fecha, 1) AS Semana
        FROM movimientos_capital
        WHERE fecha BETWEEN fecha_inicio AND fecha_fin
    ),
    todas_semanas AS (
        SELECT WEEK(fecha, 1) AS Semana
        FROM (
            SELECT ADDDATE(fecha_inicio, INTERVAL n WEEK) AS fecha
            FROM (
                SELECT 1 AS n UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 
                UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7
                UNION ALL SELECT 8 UNION ALL SELECT 9 UNION ALL SELECT 10 UNION ALL SELECT 11
                UNION ALL SELECT 12 UNION ALL SELECT 13 UNION ALL SELECT 14 UNION ALL SELECT 15
                UNION ALL SELECT 16 UNION ALL SELECT 17 UNION ALL SELECT 18 UNION ALL SELECT 19
                UNION ALL SELECT 20 UNION ALL SELECT 21 UNION ALL SELECT 22 UNION ALL SELECT 23
                UNION ALL SELECT 24 UNION ALL SELECT 25 UNION ALL SELECT 26 UNION ALL SELECT 27
                UNION ALL SELECT 28 UNION ALL SELECT 29 UNION ALL SELECT 30 UNION ALL SELECT 31
                UNION ALL SELECT 32 UNION ALL SELECT 33 UNION ALL SELECT 34 UNION ALL SELECT 35
                UNION ALL SELECT 36 UNION ALL SELECT 37 UNION ALL SELECT 38 UNION ALL SELECT 39
                UNION ALL SELECT 40 UNION ALL SELECT 41 UNION ALL SELECT 42 UNION ALL SELECT 43
                UNION ALL SELECT 44 UNION ALL SELECT 45 UNION ALL SELECT 46 UNION ALL SELECT 47
                UNION ALL SELECT 48 UNION ALL SELECT 49 UNION ALL SELECT 50 UNION ALL SELECT 52
            ) AS nums
            WHERE ADDDATE(fecha_inicio, INTERVAL n WEEK) <= fecha_fin
        ) AS semanas_generadas
    )
    SELECT 
        ts.Semana,
        COALESCE(ROUND(SUM(CASE 
                    WHEN m.monto NOT LIKE '-%' THEN m.monto  -- Sumar montos positivos
                    ELSE 0 
                END), 2), 0) 
            + COALESCE(ROUND(SUM(CASE 
                    WHEN m.monto LIKE '-%' THEN m.monto  -- Sumar montos negativos
                    ELSE 0 
                END), 2), 0) AS Ganancia
    FROM 
        todas_semanas ts
    LEFT JOIN 
        movimientos_capital m ON WEEK(m.fecha, 1) = ts.Semana 
        AND m.fecha BETWEEN fecha_inicio AND fecha_fin
    GROUP BY 
        ts.Semana
    ORDER BY 
        ts.Semana;
    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ProductosMasVendidosPorAno` (IN `ano` INT)   BEGIN
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `ProductosMasVendidosPorMes` (IN `ano` INT, IN `mes` INT)   BEGIN
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `ProductosMenosVendidosPorAno` (IN `ano` INT)   BEGIN
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
    WHERE p.active = 1 and COALESCE(
            (SELECT SUM(f.cantidad) 
             FROM proyecto_4.factura f
             JOIN proyecto_4.registro_ventas r ON f.id_registro_ventas = r.id
             WHERE f.id_productos = p.id AND YEAR(r.fecha) = ano), 0
        ) > 0
    ORDER BY cantidad ASC
    LIMIT 5;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ProductosMenosVendidosPorMes` (IN `ano` INT, IN `mes` INT)   BEGIN
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
    WHERE p.active = 1 and COALESCE(
            (SELECT SUM(f.cantidad) 
             FROM proyecto_4.factura f
             JOIN proyecto_4.registro_ventas r ON f.id_registro_ventas = r.id
             WHERE f.id_productos = p.id AND YEAR(r.fecha) = ano AND MONTH(r.fecha) = mes), 0
        ) > 0
    ORDER BY cantidad ASC
    LIMIT 5;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `reporteProveedor` (IN `prod_id` INT, IN `prov_id` INT, IN `fecha_inicio` DATE, IN `fecha_fin` DATE)   BEGIN

 SELECT 
        p.nombre AS Nombre_Empresa,
        p.id AS ID_Proveedor,
        p.telefono AS Contacto_Telefono,
        p.correo AS Contacto_Correo,
        p.direccion AS Contacto_Direccion,
        
        -- Historial de Compras
        COUNT(e.id) AS Total_Pedidos,
        SUM(d.precio_compra * d.cantidad) AS Importe_Total_Gastado,
        AVG(d.precio_compra * d.cantidad) AS Promedio_Gasto_Pedido,
        MAX(e.fecha_compra) AS Ultimo_Pedido_Fecha,
        
        -- Productos Suministrados
        GROUP_CONCAT(DISTINCT prod.nombre SEPARATOR ', ') AS Productos_Suministrados,
        GROUP_CONCAT(DISTINCT cat.nombre SEPARATOR ', ') AS Categorias_Productos

    FROM entradas e
    LEFT JOIN detalles_entradas d ON e.id = d.id_entrada
    LEFT JOIN productos prod ON d.id_producto = prod.id
    LEFT JOIN categoria cat ON prod.id_categoria = cat.id
    LEFT JOIN proveedores p ON e.id_proveedor = p.id

    WHERE (prod_id IS NULL OR d.id_producto = prod_id)
      AND (prov_id IS NULL OR e.id_proveedor = prov_id)
      AND (fecha_inicio IS NULL OR e.fecha_compra >= fecha_inicio)
      AND (fecha_fin IS NULL OR e.fecha_compra <= fecha_fin)
    
    GROUP BY p.id;
END$$

--
-- Funciones
--
CREATE DEFINER=`root`@`localhost` FUNCTION `dias_diferencia` (`fecha1` DATE, `fecha2` DATE) RETURNS INT READS SQL DATA BEGIN
	RETURN DATEDIFF(fecha1, fecha2);
RETURN 1;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bitacora`
--

CREATE TABLE `bitacora` (
  `id` int NOT NULL,
  `id_usuario` int NOT NULL,
  `tabla` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `accion` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `detalles` varchar(45) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `bitacora`
--

INSERT INTO `bitacora` (`id`, `id_usuario`, `tabla`, `accion`, `fecha`, `detalles`) VALUES
(1, 1, 'Usuarios', 'Login', '2024-10-21 14:26:03', 'Usuario Edouard logueado'),
(2, 1, 'Usuarios', 'Login', '2024-10-21 14:32:27', 'Usuario Edouard logueado'),
(3, 1, 'Usuarios', 'Logout', '2024-10-21 14:38:20', 'Usuario Edouard des-logueado'),
(4, 1, 'Usuarios', 'Login', '2024-10-21 14:38:39', 'Usuario Edouard logueado'),
(5, 1, 'marca', 'Agregar', '2024-10-21 14:39:39', 'Agregado marca'),
(6, 1, 'unidad', 'Agregar', '2024-10-21 14:39:45', 'Agregado unidad'),
(7, 1, 'categoria', 'Agregar', '2024-10-21 14:39:53', 'Agregado categoria'),
(8, 1, 'proveedor', 'Agregar', '2024-10-21 14:41:03', 'Agregado proveedor'),
(9, 1, 'Usuarios', 'Login', '2024-10-21 18:49:19', 'Usuario Edouard logueado'),
(10, 1, 'configuraciones', 'Modificar', '2024-10-21 19:21:50', 'Modificado configuraciones'),
(11, 1, 'producto', 'Modificar', '2024-10-21 19:22:35', 'Modificado producto'),
(12, 1, 'Usuarios', 'Login', '2024-10-22 14:25:52', 'Usuario Edouard logueado'),
(13, 1, 'Usuarios', 'Login', '2024-10-22 23:33:50', 'Usuario Edouard logueado'),
(14, 1, 'producto', 'Modificar', '2024-10-23 00:27:22', 'Modificado producto'),
(15, 1, 'producto', 'Modificar', '2024-10-23 00:27:50', 'Modificado producto'),
(16, 1, 'producto', 'Modificar', '2024-10-23 00:29:59', 'Modificado producto'),
(17, 1, 'producto', 'Borrar', '2024-10-23 00:34:21', 'Borrado producto'),
(18, 1, 'Usuarios', 'Login', '2024-10-23 01:05:54', 'Usuario Edouard logueado'),
(19, 1, 'Usuarios', 'Login', '2024-10-23 12:28:22', 'Usuario Edouard logueado'),
(20, 1, 'Usuarios', 'Login', '2024-10-24 21:49:49', 'Usuario Edouard logueado'),
(21, 1, 'producto', 'Borrar', '2024-10-24 22:15:19', 'Borrado producto'),
(22, 1, 'producto', 'Borrar', '2024-10-24 22:17:00', 'Borrado producto'),
(23, 1, 'producto', 'Borrar', '2024-10-24 22:17:58', 'Borrado producto'),
(24, 1, 'producto', 'Modificar', '2024-10-24 22:19:55', 'Modificado producto'),
(25, 1, 'marca', 'Agregar', '2024-10-24 22:20:40', 'Agregado marca'),
(26, 1, 'marca', 'Borrar', '2024-10-24 22:20:45', 'Borrado marca'),
(27, 1, 'producto', 'Modificar', '2024-10-24 22:23:35', 'Modificado producto'),
(28, 1, 'cliente', 'Agregar', '2024-10-24 22:37:57', 'Agregado cliente'),
(29, 1, 'cliente', 'Modificar', '2024-10-24 22:38:01', 'Modificado cliente'),
(30, 1, 'cliente', 'Modificar', '2024-10-24 22:38:08', 'Modificado cliente'),
(31, 1, 'cliente', 'Modificar', '2024-10-24 22:38:14', 'Modificado cliente'),
(32, 1, 'cliente', 'Modificar', '2024-10-24 22:38:18', 'Modificado cliente'),
(33, 1, 'cliente', 'Modificar', '2024-10-24 22:38:23', 'Modificado cliente'),
(34, 1, 'cliente', 'Modificar', '2024-10-24 22:38:30', 'Modificado cliente'),
(35, 1, 'cliente', 'Agregar', '2024-10-24 22:38:49', 'Agregado cliente'),
(36, 1, 'cliente', 'Borrar', '2024-10-24 22:38:52', 'Borrado cliente'),
(37, 1, 'cliente', 'Modificar', '2024-10-24 22:41:22', 'Modificado cliente'),
(38, 1, 'configuraciones', 'Modificar', '2024-10-24 23:43:15', 'Modificado configuraciones'),
(39, 1, 'Usuarios', 'Login', '2024-10-27 21:59:51', 'Usuario Edouard logueado'),
(40, 1, 'Usuarios', 'Login', '2024-10-27 22:02:24', 'Usuario Edouard logueado'),
(41, 1, 'Usuarios', 'Logout', '2024-10-27 23:42:08', 'Usuario Edouard des-logueado'),
(42, 1, 'Usuarios', 'Login', '2024-10-27 23:46:59', 'Usuario Edouard logueado'),
(43, 1, 'Usuarios', 'Login', '2024-10-27 23:47:26', 'Usuario Edouard logueado'),
(44, 1, 'marca', 'Agregar', '2024-10-28 00:13:29', 'Agregado marca'),
(45, 1, 'unidad', 'Agregar', '2024-10-28 00:14:06', 'Agregado unidad'),
(46, 1, 'categoria', 'Agregar', '2024-10-28 00:14:10', 'Agregado categoria'),
(47, 1, 'producto', 'Borrar', '2024-10-28 18:30:16', 'Borrado producto'),
(48, 1, 'producto', 'Modificar', '2024-10-28 18:31:35', 'Modificado producto'),
(49, 1, 'marca', 'Agregar', '2024-10-28 18:32:03', 'Agregado marca'),
(50, 1, 'marca', 'Modificar', '2024-10-28 18:32:10', 'Modificado marca'),
(51, 1, 'marca', 'Borrar', '2024-10-28 18:32:13', 'Borrado marca'),
(52, 1, 'proveedor', 'Agregar', '2024-10-28 18:59:09', 'Agregado proveedor'),
(53, 1, 'proveedor', 'Modificar', '2024-10-28 18:59:20', 'Modificado proveedor'),
(54, 1, 'proveedor', 'Borrar', '2024-10-28 18:59:26', 'Borrado proveedor'),
(55, 1, 'proveedor', 'Borrar', '2024-10-28 18:59:26', 'Borrado proveedor'),
(56, 1, 'cliente', 'Agregar', '2024-10-28 19:02:29', 'Agregado cliente'),
(57, 1, 'cliente', 'Modificar', '2024-10-28 19:03:30', 'Modificado cliente'),
(58, 1, 'cliente', 'Borrar', '2024-10-28 19:03:34', 'Borrado cliente'),
(59, 1, 'cliente', 'Borrar', '2024-10-28 19:03:38', 'Borrado cliente'),
(60, 1, 'cliente', 'Borrar', '2024-10-28 19:03:38', 'Borrado cliente'),
(61, 1, 'cliente', 'Borrar', '2024-10-28 19:04:03', 'Borrado cliente'),
(62, 1, 'cliente', 'Borrar', '2024-10-28 19:04:03', 'Borrado cliente'),
(63, 1, 'cliente', 'Borrar', '2024-10-28 19:05:55', 'Borrado cliente'),
(64, 1, 'Caja', 'Cerrar', '2024-10-28 19:22:19', 'Caja cerrada'),
(65, 1, 'capital', 'Agregar', '2024-10-28 19:25:09', 'Agregado capital'),
(66, 1, 'capital', 'Agregar', '2024-10-28 19:25:20', 'Agregado capital'),
(67, 1, 'capital', 'Agregar', '2024-10-28 19:25:32', 'Agregado capital'),
(68, 1, 'empaquetado', 'Agregar', '2024-10-30 13:29:31', 'Agregado empaquetado'),
(69, 1, 'marca', 'Agregar', '2024-10-30 15:31:23', 'Agregado marca'),
(70, 1, 'Usuarios', 'Logout', '2024-10-30 17:33:30', 'Usuario Edouard des-logueado'),
(71, 1, 'Usuarios', 'Login', '2024-10-30 17:33:57', 'Usuario Edouard logueado'),
(72, 1, 'categoria', 'Agregar', '2024-10-30 17:38:58', 'Agregado categoria'),
(73, 1, 'configuraciones', 'Modificar', '2024-10-30 18:27:50', 'Modificado configuraciones'),
(74, 1, 'configuraciones', 'Modificar', '2024-10-30 18:28:14', 'Modificado configuraciones'),
(75, 1, 'configuraciones', 'Modificar', '2024-10-30 18:28:32', 'Modificado configuraciones'),
(76, 1, 'empaquetado', 'Agregar', '2024-10-30 18:39:05', 'Agregado empaquetado'),
(77, 1, 'empaquetado', 'Modificar', '2024-10-30 18:39:28', 'Modificado empaquetado'),
(78, 1, '', 'Modificar', '2024-10-30 18:39:28', 'Modificado '),
(79, 1, 'empaquetado', 'Modificar', '2024-10-30 18:40:44', 'Modificado empaquetado'),
(80, 1, 'empaquetado', 'Modificar', '2024-10-30 18:41:21', 'Modificado empaquetado'),
(81, 1, '', 'Modificar', '2024-10-30 18:41:21', 'Modificado '),
(82, 1, '', 'Modificar', '2024-10-30 18:42:33', 'Modificado '),
(83, 1, 'categoria', 'Modificar', '2024-10-30 18:42:33', 'Modificado categoria'),
(84, 1, '', 'Modificar', '2024-10-30 18:42:33', 'Modificado '),
(85, 1, 'producto', 'Modificar', '2024-10-30 18:46:01', 'Modificado producto'),
(86, 1, 'empaquetado', 'Modificar', '2024-10-30 18:53:20', 'Modificado empaquetado'),
(87, 1, 'categoria', 'Borrar', '2024-10-30 18:53:28', 'Borrado categoria'),
(88, 1, 'empaquetado', 'Borrar', '2024-10-30 18:53:38', 'Borrado empaquetado'),
(89, 1, 'empaquetado', 'Borrar', '2024-10-30 18:56:10', 'Borrado empaquetado'),
(90, 1, 'empaquetado', 'Borrar', '2024-10-30 18:58:23', 'Borrado empaquetado'),
(91, 1, '', 'Borrar', '2024-10-30 18:58:23', 'Borrado '),
(92, 1, 'producto', 'Borrar', '2024-10-30 19:00:26', 'Borrado producto'),
(93, 1, 'Usuarios', 'Login', '2024-10-30 20:20:55', 'Usuario Edouard logueado'),
(94, 1, 'Caja', 'Cerrar', '2024-10-30 20:23:04', 'Caja cerrada'),
(95, 1, 'Caja', 'Cerrar', '2024-10-30 21:17:26', 'Caja cerrada'),
(96, 1, 'Caja', 'Cerrar', '2024-10-30 21:22:11', 'Caja cerrada'),
(97, 1, 'producto', 'Modificar', '2024-10-31 15:51:48', 'Modificado producto'),
(98, 1, 'Usuarios', 'Logout', '2024-10-31 18:16:10', 'Usuario Edouard des-logueado'),
(100, 14, 'Usuarios', 'Login', '2024-10-31 19:34:32', 'Usuario Luis logueado'),
(101, 14, 'Usuarios', 'Logout', '2024-10-31 19:41:38', 'Usuario Luis des-logueado'),
(102, 1, 'Usuarios', 'Login', '2024-10-31 19:43:08', 'Usuario Edouard logueado'),
(103, 14, 'Usuarios', 'Login', '2024-10-31 19:46:06', 'Usuario Luis logueado'),
(104, 1, 'permiso', 'Agregar', '2024-10-31 20:19:59', 'Agregado permiso'),
(105, 1, 'permiso', 'Agregar', '2024-10-31 20:29:13', 'Agregado permiso'),
(106, 1, 'permiso', 'Agregar', '2024-10-31 20:29:31', 'Agregado permiso'),
(107, 1, 'permiso', 'Agregar', '2024-10-31 20:35:12', 'Agregado permiso'),
(108, 1, 'permiso', 'Agregar', '2024-10-31 20:35:28', 'Agregado permiso'),
(109, 1, 'permiso', 'Borrar', '2024-10-31 21:11:32', 'Borrado permiso'),
(110, 1, 'Usuarios', 'Login', '2024-10-31 21:30:40', 'Usuario Edouard logueado'),
(111, 1, 'Usuarios', 'Login', '2024-11-01 10:12:06', 'Usuario Edouard logueado'),
(112, 1, 'Usuarios', 'Logout', '2024-11-01 10:12:43', 'Usuario Edouard des-logueado'),
(113, 14, 'Usuarios', 'Login', '2024-11-01 10:16:31', 'Usuario Luis logueado'),
(114, 14, 'Usuarios', 'Logout', '2024-11-01 10:16:56', 'Usuario Luis des-logueado'),
(115, 14, 'Usuarios', 'Login', '2024-11-01 10:18:26', 'Usuario Luis logueado'),
(116, 1, 'Usuarios', 'Login', '2024-11-01 10:20:08', 'Usuario Edouard logueado'),
(117, 1, 'marca', 'Agregar', '2024-11-01 10:45:31', 'Agregado marca'),
(118, 1, 'configuraciones', 'Modificar', '2024-11-01 10:52:21', 'Modificado configuraciones'),
(119, 1, 'producto', 'Agregar', '2024-11-01 11:12:05', 'Agregado producto'),
(120, 14, 'Usuarios', 'Logout', '2024-11-01 13:34:18', 'Usuario Luis des-logueado'),
(121, 14, 'Usuarios', 'Login', '2024-11-01 13:39:42', 'Usuario Luis logueado'),
(122, 1, 'Usuarios', 'Login', '2024-11-01 14:23:38', 'Usuario Edouard logueado'),
(123, 1, 'Usuarios', 'Logout', '2024-11-01 14:24:34', 'Usuario Edouard des-logueado'),
(124, 14, 'Usuarios', 'Login', '2024-11-01 14:25:13', 'Usuario Luis logueado'),
(125, 14, 'Usuarios', 'Login', '2024-11-01 14:26:41', 'Usuario Luis logueado'),
(126, 14, 'Usuarios', 'Login', '2024-11-01 14:29:42', 'Usuario Luis logueado'),
(127, 14, 'Usuarios', 'Login', '2024-11-01 14:30:11', 'Usuario Luis logueado'),
(128, 14, 'Usuarios', 'Login', '2024-11-01 14:31:43', 'Usuario Luis logueado'),
(129, 14, 'Usuarios', 'Logout', '2024-11-01 14:40:36', 'Usuario Luis des-logueado'),
(130, 1, 'Usuarios', 'Login', '2024-11-01 14:42:28', 'Usuario Edouard logueado'),
(131, 1, 'permiso', 'Borrar', '2024-11-01 14:46:35', 'Borrado permiso'),
(132, 1, 'permiso', 'Agregar', '2024-11-01 14:46:48', 'Agregado permiso'),
(133, 1, 'permiso', 'Agregar', '2024-11-01 14:46:50', 'Agregado permiso'),
(134, 1, 'permiso', 'Borrar', '2024-11-01 14:51:04', 'Borrado permiso'),
(135, 1, 'permiso', 'Borrar', '2024-11-01 14:51:05', 'Borrado permiso'),
(136, 1, 'permiso', 'Borrar', '2024-11-01 14:51:07', 'Borrado permiso'),
(137, 1, 'permiso', 'Agregar', '2024-11-01 15:16:32', 'Agregado permiso'),
(138, 1, 'permiso', 'Agregar', '2024-11-01 15:16:33', 'Agregado permiso'),
(139, 1, 'permiso', 'Agregar', '2024-11-01 15:16:34', 'Agregado permiso'),
(140, 1, 'permiso', 'Agregar', '2024-11-01 15:24:44', 'Agregado permiso'),
(141, 1, 'permiso', 'Agregar', '2024-11-01 15:24:46', 'Agregado permiso'),
(142, 1, 'permiso', 'Borrar', '2024-11-01 15:31:02', 'Borrado permiso'),
(143, 1, 'permiso', 'Borrar', '2024-11-01 15:31:41', 'Borrado permiso'),
(144, 1, 'permiso', 'Agregar', '2024-11-01 15:33:22', 'Agregado permiso'),
(145, 1, 'permiso', 'Borrar', '2024-11-01 15:33:34', 'Borrado permiso'),
(146, 1, 'permiso', 'Borrar', '2024-11-01 15:34:55', 'Borrado permiso'),
(147, 1, 'permiso', 'Borrar', '2024-11-01 15:35:17', 'Borrado permiso'),
(148, 1, 'permiso', 'Borrar', '2024-11-01 15:36:47', 'Borrado permiso'),
(149, 1, 'Usuarios', 'Login', '2024-11-02 21:38:07', 'Usuario Edouard logueado'),
(150, 1, 'Usuarios', 'Logout', '2024-11-02 22:05:15', 'Usuario Edouard des-logueado'),
(151, 1, 'Usuarios', 'Login', '2024-11-03 08:33:23', 'Usuario Edouard logueado'),
(152, 1, 'proveedor', 'Agregar', '2024-11-03 18:39:42', 'Agregado proveedor'),
(153, 1, 'empaquetado', 'Agregar', '2024-11-04 11:57:10', 'Agregado empaquetado'),
(154, 1, 'Credito', 'Pagado', '2024-11-04 12:35:23', 'Credito pagado'),
(155, 1, 'Caja', 'Cerrar', '2024-11-04 13:40:56', 'Caja cerrada'),
(156, 1, 'Caja', 'Cerrar', '2024-11-04 13:41:42', 'Caja cerrada'),
(157, 1, 'Caja', 'Cerrar', '2024-11-04 13:43:05', 'Caja cerrada'),
(158, 1, 'Caja', 'Cerrar', '2024-11-04 13:43:27', 'Caja cerrada'),
(159, 1, 'Usuarios', 'Logout', '2024-11-04 13:55:59', 'Usuario Edouard des-logueado'),
(160, 1, 'Usuarios', 'Login', '2024-11-04 14:19:12', 'Usuario Edouard logueado'),
(161, 1, 'producto', 'Modificar', '2024-11-04 14:33:12', 'Modificado producto'),
(162, 1, 'producto', 'Borrar', '2024-11-04 14:37:59', 'Borrado producto'),
(163, 1, 'Usuarios', 'Logout', '2024-11-04 16:00:09', 'Usuario Edouard des-logueado'),
(164, 15, 'Usuarios', 'Login', '2024-11-04 16:45:04', 'Usuario Luis logueado'),
(165, 15, 'Usuarios', 'Logout', '2024-11-04 16:46:55', 'Usuario Luis des-logueado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caja`
--

CREATE TABLE `caja` (
  `id` int NOT NULL,
  `id_usuario` int NOT NULL,
  `monto_inicial` float NOT NULL,
  `monto_final` varchar(100) COLLATE utf8mb4_general_ci DEFAULT '0',
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `estado` tinyint(1) NOT NULL DEFAULT '0',
  `fecha_cierre` datetime DEFAULT NULL,
  `monto_credito` float NOT NULL DEFAULT '0',
  `total_ventas` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `caja`
--

INSERT INTO `caja` (`id`, `id_usuario`, `monto_inicial`, `monto_final`, `fecha`, `estado`, `fecha_cierre`, `monto_credito`, `total_ventas`) VALUES
(1, 1, 100, '1330', '2024-10-28 19:19:18', 1, '2024-10-30 18:30:02', 0, 2),
(2, 1, 10, NULL, '2024-10-30 20:21:55', 1, '2024-11-01 11:11:15', 0, 0),
(3, 1, 100, NULL, '2024-11-01 11:12:49', 1, '2024-11-01 11:13:52', 0, 0),
(8, 1, 250, '0', '2024-11-03 14:32:53', 0, NULL, 0, 0);

--
-- Disparadores `caja`
--
DELIMITER $$
CREATE TRIGGER `caja_cierre` AFTER UPDATE ON `caja` FOR EACH ROW BEGIN
declare diferencia float;
set diferencia = new.monto_final - old.monto_inicial;
insert into movimientos_capital(monto, descripcion) values (COALESCE(diferencia,0), concat("ingreso por caja",new.id));
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `capital`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `capital` (
`capital` decimal(32,0)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id` int NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id`, `nombre`) VALUES
(5, 'Bebida'),
(2, 'cosa'),
(3, 'cosa2'),
(4, 'dsad');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int NOT NULL,
  `nombre` varchar(500) NOT NULL,
  `cedula` varchar(45) NOT NULL,
  `apellido` varchar(45) NOT NULL,
  `documento` varchar(1) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `active` tinyint DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `nombre`, `cedula`, `apellido`, `documento`, `direccion`, `telefono`, `active`) VALUES
(1, 'Nombreaaaa', '12312312', 'apellidoaaa', 'V', 'dfhdghdfghasasdasdkgjsdlkfgjñsdlfkgñsdkfjgñslkdfgjñsdlkfjgñsldkfjgñlskdfjgñklsdjfñglkjsdfg', '+588239048729', 1),
(2, 'Nombre', '12312312', 'apellido', 'V', 'peeee', '234234234', 1),
(3, 'Atunes', '29873979', 'apellido', 'V', 'dfhdghdfghasasdasd', '59837598734', 0);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `clientesfrecuentes`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `clientesfrecuentes` (
`idCliente` int
,`Cliente` varchar(500)
,`Compras` bigint
,`pmc` text
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuraciones`
--

CREATE TABLE `configuraciones` (
  `id` int NOT NULL,
  `llave` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `valor` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `configuraciones`
--

INSERT INTO `configuraciones` (`id`, `llave`, `valor`) VALUES
(1, 'dolar', '42.73');

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `coste_productos_vendidos`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `coste_productos_vendidos` (
`Enero` double
,`Febrero` double
,`Marzo` double
,`Abril` double
,`Mayo` double
,`Junio` double
,`Julio` double
,`Agosto` double
,`Septiembre` double
,`Octubre` double
,`Noviembre` double
,`Diciembre` double
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `costo_entradas_mensuales`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `costo_entradas_mensuales` (
`Enero` double
,`Febrero` double
,`Marzo` double
,`Abril` double
,`Mayo` double
,`Junio` double
,`Julio` double
,`Agosto` double
,`Septiembre` double
,`Octubre` double
,`Noviembre` double
,`Diciembre` double
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `credito`
--

CREATE TABLE `credito` (
  `id` int NOT NULL,
  `id_rv` int NOT NULL,
  `fecha_limite` datetime NOT NULL,
  `monto_final` float NOT NULL,
  `status` tinyint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `credito`
--

INSERT INTO `credito` (`id`, `id_rv`, `fecha_limite`, `monto_final`, `status`) VALUES
(1, 10, '2024-11-01 00:00:00', 0.66, 0),
(2, 11, '2024-11-01 00:00:00', 0.33, 0);

--
-- Disparadores `credito`
--
DELIMITER $$
CREATE TRIGGER `after_credito_insert` AFTER INSERT ON `credito` FOR EACH ROW BEGIN
DECLARE total_egreso FLOAT;
SET total_egreso = NEW.monto_final;
INSERT INTO movimientos_capital (monto, descripcion) VALUES (-total_egreso, 'Egreso por credito');
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `detalles_capital`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `detalles_capital` (
`Gastos` decimal(32,0)
,`Ingresos` decimal(32,0)
,`Ventas` double
,`capital` float
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalles_entradas`
--

CREATE TABLE `detalles_entradas` (
  `id` int NOT NULL,
  `id_producto` int DEFAULT NULL,
  `id_empaquetado` int NOT NULL,
  `tamaño_mercancia` int NOT NULL,
  `precio_compra` float NOT NULL,
  `id_entrada` int DEFAULT NULL,
  `fecha_vencimiento` date NOT NULL,
  `cantidad` int NOT NULL,
  `existencia` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalles_entradas`
--

INSERT INTO `detalles_entradas` (`id`, `id_producto`, `id_empaquetado`, `tamaño_mercancia`, `precio_compra`, `id_entrada`, `fecha_vencimiento`, `cantidad`, `existencia`) VALUES
(1, 114, 3, 15, 250, 105, '2025-01-15', 5, 59);

--
-- Disparadores `detalles_entradas`
--
DELIMITER $$
CREATE TRIGGER `entradas_agg` AFTER INSERT ON `detalles_entradas` FOR EACH ROW BEGIN
    DECLARE total_egreso FLOAT;
    SET total_egreso = NEW.cantidad * NEW.precio_compra;
    INSERT INTO movimientos_capital (monto, descripcion)
    VALUES (-total_egreso, 'Egreso por nuevas entradas');
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `precio_productos` AFTER INSERT ON `detalles_entradas` FOR EACH ROW BEGIN
    DECLARE v_ganancia DECIMAL(10,2);
    DECLARE v_precio_anterior DECIMAL(10,2);
    DECLARE v_stock_anterior INT;
    DECLARE v_algoritmo INT;
    DECLARE v_precio_nuevo DECIMAL(10,2);

    -- Obtén el valor de ganancia, precio anterior, stock anterior y algoritmo de la tabla productos
    SELECT p.ganancia, p.precio_venta, (SELECT SUM(e.existencia) FROM detalles_entradas as e WHERE e.id_producto=p.id) as stock, p.algoritmo INTO v_ganancia, v_precio_anterior, v_stock_anterior, v_algoritmo
    FROM productos p 
    WHERE p.id = NEW.id_producto;

    
    -- PEPS (Primero en entrar, primero en salir)
    
    IF v_algoritmo = 1 THEN
        UPDATE productos 
        SET precio_venta = NEW.precio_compra * (1 + v_ganancia)
        WHERE id = NEW.id_producto;

    -- Media ponderada
    ELSEIF v_algoritmo = 2 THEN
        SET v_precio_nuevo = ((v_precio_anterior * v_stock_anterior) + (NEW.precio_compra * NEW.cantidad)) / (v_stock_anterior + NEW.cantidad);
        UPDATE productos 
        SET precio_venta = v_precio_nuevo * (1 + v_ganancia)
        WHERE id = NEW.id_producto;

    -- UEPS (Último en entrar, primero en salir)
    ELSEIF v_algoritmo = 3 THEN
        -- Aquí puedes implementar la lógica específica de UEPS, que generalmente es similar a PEPS
        -- pero usando la entrada más reciente. Sin embargo, suele necesitar un manejo más complejo.
        UPDATE productos 
        SET precio_venta = NEW.precio_compra * (1 + v_ganancia)
        WHERE id = NEW.id_producto;
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dinero`
--

CREATE TABLE `dinero` (
  `id` int NOT NULL,
  `monto` float NOT NULL,
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `dinero`
--

INSERT INTO `dinero` (`id`, `monto`, `fecha`) VALUES
(1, -502, '2024-10-30 19:07:43');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entradas`
--

CREATE TABLE `entradas` (
  `id` int NOT NULL,
  `id_proveedor` int NOT NULL,
  `fecha_compra` date NOT NULL,
  `codigo` int DEFAULT NULL,
  `detalles` varchar(50) NOT NULL,
  `active` tinyint DEFAULT '1',
  `referencia` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `entradas`
--

INSERT INTO `entradas` (`id`, `id_proveedor`, `fecha_compra`, `codigo`, `detalles`, `active`, `referencia`) VALUES
(105, 3, '2024-11-04', 28886, 'Primera entrada', 1, 'comprobante_28886_5e5294ee-d7d2-424d-ac2e-5802bbad41ab.jpeg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `id` int NOT NULL,
  `id_registro_ventas` int NOT NULL,
  `id_productos` int NOT NULL,
  `cantidad` int NOT NULL,
  `coste_producto_total` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `factura`
--

INSERT INTO `factura` (`id`, `id_registro_ventas`, `id_productos`, `cantidad`, `coste_producto_total`) VALUES
(1, 1, 114, 5, 615),
(2, 2, 114, 5, 615),
(3, 3, 115, 1, 234),
(4, 4, 115, 5, 1170),
(5, 5, 115, 5, 1170),
(6, 6, 115, 12, 2808),
(7, 7, 114, 2, 27.6),
(8, 8, 114, 2, 27.6),
(9, 9, 114, 2, 27.6),
(10, 10, 114, 2, 27.6),
(11, 11, 114, 1, 13.8),
(12, 12, 114, 1, 287.5),
(13, 13, 114, 1, 287.5),
(14, 14, 114, 1, 287.5),
(15, 15, 114, 1, 287.5),
(16, 16, 114, 1, 287.5),
(17, 17, 114, 1, 287.5),
(18, 18, 114, 2, 575),
(19, 19, 114, 2, 575),
(20, 20, 114, 2, 575),
(21, 21, 114, 2, 575),
(22, 22, 114, 2, 575);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `ganacias_mensuales`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `ganacias_mensuales` (
`Enero` decimal(33,0)
,`Febrero` decimal(33,0)
,`Marzo` decimal(33,0)
,`Abril` decimal(33,0)
,`Mayo` decimal(33,0)
,`Junio` decimal(33,0)
,`Julio` decimal(33,0)
,`Agosto` decimal(33,0)
,`Septiembre` decimal(33,0)
,`Octubre` decimal(33,0)
,`Noviembre` decimal(33,0)
,`Diciembre` decimal(33,0)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marcas`
--

CREATE TABLE `marcas` (
  `id` int NOT NULL,
  `nombre` varchar(100) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `marcas`
--

INSERT INTO `marcas` (`id`, `nombre`) VALUES
(1, 'Glup'),
(2, 'nnln'),
(4, 'asd'),
(6, 'nombre'),
(7, 'azucena');

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `max_ventas`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `max_ventas` (
`id` int
,`nombre` varchar(50)
,`unidad_valor` float
,`unidad` varchar(45)
,`marca` varchar(100)
,`cantidad` decimal(32,0)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `metodo_pago`
--

CREATE TABLE `metodo_pago` (
  `id` int NOT NULL,
  `nombre` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `active` tinyint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `metodo_pago`
--

INSERT INTO `metodo_pago` (`id`, `nombre`, `active`) VALUES
(1, 'transferencia', 1),
(2, 'Divisa', 1);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `min_ventas`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `min_ventas` (
`id` int
,`nombre` varchar(50)
,`unidad_valor` float
,`unidad` varchar(45)
,`marca` varchar(100)
,`cantidad` decimal(32,0)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movimientos_capital`
--

CREATE TABLE `movimientos_capital` (
  `id` int NOT NULL,
  `monto` int NOT NULL,
  `descripcion` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `movimientos_capital`
--

INSERT INTO `movimientos_capital` (`id`, `monto`, `descripcion`, `fecha`) VALUES
(1, -132, 'Egreso por nuevas entradas', '2024-10-21 16:34:45'),
(2, -4000, 'Egreso por nuevas entradas', '2024-10-21 16:54:46'),
(3, -4000, 'Egreso por nuevas entradas', '2024-10-21 16:55:43'),
(4, -4000, 'Egreso por nuevas entradas', '2024-10-21 16:55:43'),
(5, -144, 'Egreso por nuevas entradas', '2024-10-21 20:00:17'),
(6, -144, 'Egreso por nuevas entradas', '2024-10-21 20:01:51'),
(7, -144, 'Egreso por nuevas entradas', '2024-10-21 20:02:31'),
(8, -260, 'Egreso por nuevas entradas', '2024-10-21 20:04:53'),
(9, -225, 'Egreso por nuevas entradas', '2024-10-21 20:15:07'),
(10, -24, 'Egreso por nuevas entradas', '2024-10-21 20:33:54'),
(11, -24, 'Egreso por nuevas entradas', '2024-10-21 20:35:48'),
(12, -13, 'Egreso por nuevas entradas', '2024-10-24 22:13:02'),
(13, -13, 'Egreso por nuevas entradas', '2024-10-24 22:13:07'),
(14, 615, 'Ingreso por facturacion', '2024-10-28 19:22:00'),
(15, 615, 'Ingreso por facturacion', '2024-10-28 19:22:19'),
(16, -10, '', '2024-10-28 19:25:09'),
(17, 0, 'no puse nada', '2024-10-28 19:25:20'),
(18, 10, 'me borra el monto rayps', '2024-10-28 19:25:32'),
(19, -100, 'Egreso por nuevas entradas', '2024-10-28 19:30:49'),
(20, -100, 'Egreso por nuevas entradas', '2024-10-28 19:32:21'),
(21, -144, 'Egreso por nuevas entradas', '2024-10-28 19:32:21'),
(22, -132, 'Egreso por nuevas entradas', '2024-10-30 14:56:47'),
(23, -16, 'Egreso por nuevas entradas', '2024-10-30 15:44:16'),
(24, 1230, 'ingreso por caja1', '2024-10-30 18:30:02'),
(25, -24, 'Egreso por nuevas entradas', '2024-10-30 19:09:19'),
(26, 234, 'Ingreso por facturacion', '2024-10-30 20:23:04'),
(27, -1, 'Egreso por credito', '2024-10-30 21:17:26'),
(28, 0, 'Egreso por credito', '2024-10-30 21:22:11'),
(29, 0, 'ingreso por caja2', '2024-11-01 11:11:15'),
(30, 0, 'ingreso por caja3', '2024-11-01 11:13:52'),
(31, -50, 'Egreso por nuevas entradas', '2024-11-03 16:44:18'),
(32, -1250, 'Egreso por nuevas entradas', '2024-11-04 11:58:10'),
(33, 14, 'Ingreso por facturacion', '2024-11-04 12:35:23'),
(34, 575, 'Ingreso por facturacion', '2024-11-04 13:43:27');

--
-- Disparadores `movimientos_capital`
--
DELIMITER $$
CREATE TRIGGER `mov_capital_dinero` AFTER INSERT ON `movimientos_capital` FOR EACH ROW BEGIN
UPDATE dinero SET monto = monto + NEW.monto WHERE id = 1;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificaciones`
--

CREATE TABLE `notificaciones` (
  `id` int NOT NULL,
  `id_usuario` int NOT NULL,
  `status` tinyint(1) NOT NULL,
  `mensaje` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos`
--

CREATE TABLE `pagos` (
  `id` int NOT NULL,
  `id_venta` int NOT NULL,
  `id_metodo_pago` int NOT NULL,
  `monto` float NOT NULL,
  `fecha` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pagos`
--

INSERT INTO `pagos` (`id`, `id_venta`, `id_metodo_pago`, `monto`, `fecha`) VALUES
(1, 1, 1, 615, '2024-10-28 19:22:00'),
(2, 2, 1, 615, '2024-10-28 19:22:19'),
(3, 3, 1, 234, '2024-10-30 20:23:04'),
(4, 11, 1, 14.1, '2024-11-04 12:35:23'),
(5, 22, 1, 575, '2024-11-04 13:43:27');

--
-- Disparadores `pagos`
--
DELIMITER $$
CREATE TRIGGER `movimientos_pagos` AFTER INSERT ON `pagos` FOR EACH ROW BEGIN
    INSERT INTO movimientos_capital (monto, descripcion)
    VALUES (NEW.monto, "Ingreso por facturacion");
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos_entradas`
--

CREATE TABLE `pagos_entradas` (
  `id` int NOT NULL,
  `id_metodo_pago` int NOT NULL,
  `id_entrada` int NOT NULL,
  `monto` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pagos_entradas`
--

INSERT INTO `pagos_entradas` (`id`, `id_metodo_pago`, `id_entrada`, `monto`) VALUES
(1, 1, 84, 24),
(2, 1, 85, 13),
(3, 1, 86, 13),
(4, 1, 88, 100),
(5, 1, 89, 244),
(6, 1, 90, 132),
(7, 1, 103, 24),
(8, 1, 104, 50);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `id` int NOT NULL,
  `id_usuario` int NOT NULL,
  `tabla` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `permiso` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`id`, `id_usuario`, `tabla`, `permiso`) VALUES
(1, 14, 'productos', 'consultar'),
(4, 14, 'proveedores', 'consultar'),
(6, 14, 'productos', 'consultar'),
(8, 14, 'unidades', 'agregar'),
(9, 14, 'categorias', 'agregar'),
(10, 14, 'marcas', 'agregar'),
(11, 14, 'unidades', 'consultar'),
(12, 14, 'categorias', 'consultar');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int NOT NULL,
  `id_categoria` int NOT NULL,
  `id_unidad` int NOT NULL,
  `id_marca` int NOT NULL,
  `valor_unidad` float NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `imagen` varchar(500) NOT NULL DEFAULT 'banner_productos.png',
  `stock_min` int NOT NULL,
  `stock_max` int NOT NULL,
  `precio_venta` float DEFAULT '0',
  `IVA` tinyint NOT NULL,
  `active` int DEFAULT '1',
  `ganancia` float DEFAULT '0.15',
  `codigo` varchar(500) NOT NULL,
  `algoritmo` int DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `id_categoria`, `id_unidad`, `id_marca`, `valor_unidad`, `nombre`, `imagen`, `stock_min`, `stock_max`, `precio_venta`, `IVA`, `active`, `ganancia`, `codigo`, `algoritmo`) VALUES
(114, 2, 1, 6, 1, 'BBB', 'banner_productos.png', 7, 123, 287.5, 0, 1, 0.15, '123123123123', 1),
(115, 2, 1, 1, 2, 'sdfksdf', 'banner_productos.png', 2, 234, 234, 0, 1, 0.15, '344323423423', 0),
(116, 3, 1, 1, 11, 'Holadenuevo', 'producto_Holadenuevo_ubicacion.png', 1, 12, 12, 0, 1, 0.15, '129873192873', 1),
(117, 3, 1, 1, 11, 'otromas', 'banner_productos.png', 1, 123, 13.8, 0, 1, 0.15, '231231231231', 1),
(118, 2, 1, 1, 30, 'ymasasgdjas', 'banner_productos.png', 231, 123, 11, 0, 0, 0.3, '456456456456', 0),
(119, 4, 1, 1, 30, 'nombre', 'producto_nombre_DIABLITOS-UNDERWOOD.jpg', 1, 123, 123, 0, 1, 0.15, '387503485739', 1),
(120, 3, 1, 1, 1, 'nombr', 'producto_nombr_telefono.png', 2, 234, 345, 0, 0, 0.15, '453489057398', 0),
(121, 5, 1, 1, 1, 'Refresco', 'producto_Refresco_ImgThumb.jpg', 1, 2, 21, 0, 1, 0.15, '111111111111', 0),
(123, 3, 1, 6, 1, 'Papelon', 'producto_Papelon_Captura de pantalla 2024-10-02 193843.png', 2, 2, 12, 0, 1, 0.15, '564191898948', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `id` int NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `razon_social` varchar(50) NOT NULL DEFAULT 'natural',
  `rif` varchar(15) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `direccion` varchar(45) NOT NULL,
  `active` tinyint DEFAULT '1',
  `telefono2` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`id`, `nombre`, `razon_social`, `rif`, `telefono`, `correo`, `direccion`, `active`, `telefono2`) VALUES
(1, 'Erseñor', 'DeAbajo', 'V-123123123', '04121338031', 'jo.hw722@gmail.com', 'Calle 10 entre carreras 3 y 7', 1, ''),
(2, 'Atun', 'RamonElFeodwenuevo', 'V-4573485790', '09521325', 'test@example.us', '1600 Fake Street', 1, ''),
(3, 'Luis', 'Montecarmelo', 'V-30087582', '04161214717', 'felix3554@gmail.com', 'nose', 1, '04161214717');

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `ratio_ventas`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `ratio_ventas` (
`id` int
,`nombre` varchar(50)
,`unidad_valor` float
,`unidad` varchar(45)
,`marca` varchar(100)
,`ratio_ventas` decimal(37,4)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro_ventas`
--

CREATE TABLE `registro_ventas` (
  `id` int NOT NULL,
  `monto_final` float NOT NULL,
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_cliente` int NOT NULL,
  `id_caja` int NOT NULL,
  `IVA` float NOT NULL DEFAULT '0',
  `active` tinyint NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `registro_ventas`
--

INSERT INTO `registro_ventas` (`id`, `monto_final`, `fecha`, `id_cliente`, `id_caja`, `IVA`, `active`) VALUES
(1, 615, '2024-10-28 19:22:00', 1, 1, 0, 1),
(2, 615, '2024-10-28 19:22:19', 1, 1, 0, 1),
(3, 234, '2024-10-30 20:23:04', 3, 1, 0, 1),
(4, 1170, '2024-10-30 20:25:54', 2, 1, 0, 1),
(5, 1170, '2024-10-30 20:25:59', 2, 1, 0, 1),
(6, 2808, '2024-10-30 20:40:39', 3, 1, 0, 0),
(7, 27.6, '2024-10-30 20:51:14', 2, 1, 0, 0),
(8, 27.6, '2024-10-30 21:07:27', 2, 1, 0, 0),
(9, 27.6, '2024-10-30 21:08:20', 2, 1, 0, 0),
(10, 27.6, '2024-10-30 21:17:26', 1, 1, 0, 0),
(11, 13.8, '2024-10-30 21:22:11', 3, 1, 0, 0),
(12, 287.5, '2024-11-04 13:38:37', 3, 8, 0, 1),
(13, 287.5, '2024-11-04 13:38:38', 3, 8, 0, 1),
(14, 287.5, '2024-11-04 13:38:39', 3, 8, 0, 1),
(15, 287.5, '2024-11-04 13:38:39', 3, 8, 0, 1),
(16, 287.5, '2024-11-04 13:38:40', 3, 8, 0, 1),
(17, 287.5, '2024-11-04 13:38:40', 3, 8, 0, 1),
(18, 575, '2024-11-04 13:40:21', 3, 8, 0, 1),
(19, 575, '2024-11-04 13:40:55', 3, 8, 0, 1),
(20, 575, '2024-11-04 13:41:41', 3, 8, 0, 1),
(21, 575, '2024-11-04 13:43:05', 3, 8, 0, 1),
(22, 575, '2024-11-04 13:43:27', 3, 8, 0, 1);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `rotacion_inventario`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `rotacion_inventario` (
`Enero` double
,`Febrero` double
,`Marzo` double
,`Abril` double
,`Mayo` double
,`Junio` double
,`Julio` double
,`Agosto` double
,`Septiembre` double
,`Octubre` double
,`Noviembre` double
,`Diciembre` double
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_empaquetado`
--

CREATE TABLE `tipo_empaquetado` (
  `id` int NOT NULL,
  `nombre` varchar(30) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo_empaquetado`
--

INSERT INTO `tipo_empaquetado` (`id`, `nombre`) VALUES
(3, 'Bulto');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_empaquetado_por_categoria`
--

CREATE TABLE `tipo_empaquetado_por_categoria` (
  `id` int NOT NULL,
  `id_categoria` int NOT NULL,
  `id_tipo_empaquetado` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `total_productos_categoria`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `total_productos_categoria` (
`categoria` varchar(50)
,`total_productos` bigint
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `total_stock_categoria`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `total_stock_categoria` (
`id` int
,`nombre` varchar(50)
,`total` decimal(54,0)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unidades`
--

CREATE TABLE `unidades` (
  `id` int NOT NULL,
  `nombre` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `unidades`
--

INSERT INTO `unidades` (`id`, `nombre`) VALUES
(1, 'L'),
(2, 'aasd');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `correo` varchar(45) NOT NULL,
  `hash` text NOT NULL,
  `rol` int NOT NULL DEFAULT '3',
  `active` tinyint NOT NULL DEFAULT '1',
  `semilla` varchar(45) NOT NULL,
  `sesion_id` varchar(145) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `correo`, `hash`, `rol`, `active`, `semilla`, `sesion_id`) VALUES
(1, 'Edouard', 'nose@gmail.com', '$2y$10$pVahKWT/D1fO2rT.Bo5/qO3M8QgCiEiXDkED0FiH1S1droi5UoKcq', 1, 0, '1234', 'bUXNoKk2Jq'),
(14, 'Luis', 'carlos1@gmail.com', '$2y$10$rVPFX8tUMXcE3BhVtzLInui7ndSsKnp/jD4.KuRVi1ecFF5U0i9eq', 3, 0, 'XzQE2wS1yeY9xlHokgOh', 'qRHZID3ThU'),
(15, 'Luis', 'carlos10@gmail.com', '$2y$10$37j7VHUJIOyu7PSm9uJU8u6jEAWYzaWFX63.xqF62wg3liGiCtI62', 3, 0, '5BNQbycgf6R4IzoFLDpP', 'vBL3iY6OeS');

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `valortotalinventario`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `valortotalinventario` (
`nombre` varchar(50)
,`valor` double
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `valor_promedio_inventario_mensual`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `valor_promedio_inventario_mensual` (
`Enero` double
,`Febrero` double
,`Marzo` double
,`Abril` double
,`Mayo` double
,`Junio` double
,`Julio` double
,`Agosto` double
,`Septiembre` double
,`Octubre` double
,`Noviembre` double
,`Diciembre` double
);

-- --------------------------------------------------------

--
-- Estructura para la vista `capital`
--
DROP TABLE IF EXISTS `capital`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `capital`  AS SELECT round(sum(`movimientos_capital`.`monto`),2) AS `capital` FROM `movimientos_capital` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `clientesfrecuentes`
--
DROP TABLE IF EXISTS `clientesfrecuentes`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `clientesfrecuentes`  AS SELECT `rv`.`id_cliente` AS `idCliente`, `c`.`nombre` AS `Cliente`, count(`rv`.`id`) AS `Compras`, `pmc`.`Productos_Mas_Comprados` AS `pmc` FROM ((`registro_ventas` `rv` left join `clientes` `c` on((`rv`.`id_cliente` = `c`.`id`))) left join (select `rv2`.`id_cliente` AS `id_cliente`,group_concat(`p`.`nombre` order by `prod`.`Frecuencia` DESC separator ', ') AS `Productos_Mas_Comprados` from (((`factura` `f` left join `productos` `p` on((`f`.`id_productos` = `p`.`id`))) left join `registro_ventas` `rv2` on((`f`.`id_registro_ventas` = `rv2`.`id`))) left join (select `f`.`id_registro_ventas` AS `id_registro_ventas`,`f`.`id_productos` AS `id_productos`,count(`f`.`id`) AS `Frecuencia` from `factura` `f` group by `f`.`id_registro_ventas`,`f`.`id_productos`) `prod` on(((`f`.`id_registro_ventas` = `prod`.`id_registro_ventas`) and (`f`.`id_productos` = `prod`.`id_productos`)))) group by `rv2`.`id_cliente`) `pmc` on((`rv`.`id_cliente` = `pmc`.`id_cliente`))) GROUP BY `rv`.`id_cliente` ORDER BY count(`rv`.`id`) DESC LIMIT 0, 5 ;

-- --------------------------------------------------------

--
-- Estructura para la vista `coste_productos_vendidos`
--
DROP TABLE IF EXISTS `coste_productos_vendidos`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `coste_productos_vendidos`  AS SELECT coalesce(round(sum((case when (month(`rv`.`fecha`) = 1) then `p`.`monto` else 0 end)),2),0) AS `Enero`, coalesce(round(sum((case when (month(`rv`.`fecha`) = 2) then `p`.`monto` else 0 end)),2),0) AS `Febrero`, coalesce(round(sum((case when (month(`rv`.`fecha`) = 3) then `p`.`monto` else 0 end)),2),0) AS `Marzo`, coalesce(round(sum((case when (month(`rv`.`fecha`) = 4) then `p`.`monto` else 0 end)),2),0) AS `Abril`, coalesce(round(sum((case when (month(`rv`.`fecha`) = 5) then `p`.`monto` else 0 end)),2),0) AS `Mayo`, coalesce(round(sum((case when (month(`rv`.`fecha`) = 6) then `p`.`monto` else 0 end)),2),0) AS `Junio`, coalesce(round(sum((case when (month(`rv`.`fecha`) = 7) then `p`.`monto` else 0 end)),2),0) AS `Julio`, coalesce(round(sum((case when (month(`rv`.`fecha`) = 8) then `p`.`monto` else 0 end)),2),0) AS `Agosto`, coalesce(round(sum((case when (month(`rv`.`fecha`) = 9) then `p`.`monto` else 0 end)),2),0) AS `Septiembre`, coalesce(round(sum((case when (month(`rv`.`fecha`) = 10) then `p`.`monto` else 0 end)),2),0) AS `Octubre`, coalesce(round(sum((case when (month(`rv`.`fecha`) = 11) then `p`.`monto` else 0 end)),2),0) AS `Noviembre`, coalesce(round(sum((case when (month(`rv`.`fecha`) = 12) then `p`.`monto` else 0 end)),2),0) AS `Diciembre` FROM (`pagos` `p` join `registro_ventas` `rv` on((`p`.`id_venta` = `rv`.`id`))) WHERE (year(`rv`.`fecha`) = year(now())) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `costo_entradas_mensuales`
--
DROP TABLE IF EXISTS `costo_entradas_mensuales`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `costo_entradas_mensuales`  AS SELECT coalesce(round(sum((case when (month(`e`.`fecha_compra`) = 1) then `e2`.`precio_compra` else 0 end)),2),0) AS `Enero`, coalesce(round(sum((case when (month(`e`.`fecha_compra`) = 2) then `e2`.`precio_compra` else 0 end)),2),0) AS `Febrero`, coalesce(round(sum((case when (month(`e`.`fecha_compra`) = 3) then `e2`.`precio_compra` else 0 end)),2),0) AS `Marzo`, coalesce(round(sum((case when (month(`e`.`fecha_compra`) = 4) then `e2`.`precio_compra` else 0 end)),2),0) AS `Abril`, coalesce(round(sum((case when (month(`e`.`fecha_compra`) = 5) then `e2`.`precio_compra` else 0 end)),2),0) AS `Mayo`, coalesce(round(sum((case when (month(`e`.`fecha_compra`) = 6) then `e2`.`precio_compra` else 0 end)),2),0) AS `Junio`, coalesce(round(sum((case when (month(`e`.`fecha_compra`) = 7) then `e2`.`precio_compra` else 0 end)),2),0) AS `Julio`, coalesce(round(sum((case when (month(`e`.`fecha_compra`) = 8) then `e2`.`precio_compra` else 0 end)),2),0) AS `Agosto`, coalesce(round(sum((case when (month(`e`.`fecha_compra`) = 9) then `e2`.`precio_compra` else 0 end)),2),0) AS `Septiembre`, coalesce(round(sum((case when (month(`e`.`fecha_compra`) = 10) then `e2`.`precio_compra` else 0 end)),2),0) AS `Octubre`, coalesce(round(sum((case when (month(`e`.`fecha_compra`) = 11) then `e2`.`precio_compra` else 0 end)),2),0) AS `Noviembre`, coalesce(round(sum((case when (month(`e`.`fecha_compra`) = 12) then `e2`.`precio_compra` else 0 end)),2),0) AS `Diciembre` FROM (`detalles_entradas` `e2` join `entradas` `e` on((`e`.`id` = `e2`.`id_entrada`))) WHERE (year(`e`.`fecha_compra`) = year(now())) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `detalles_capital`
--
DROP TABLE IF EXISTS `detalles_capital`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `detalles_capital`  AS SELECT (select round(sum((case when (`m`.`monto` like '-%') then `m`.`monto` else 0 end)),2) from `movimientos_capital` `m`) AS `Gastos`, (select round(sum((case when (not((`m`.`monto` like '-%'))) then `m`.`monto` else 0 end)),2) AS `Ingresos` from `movimientos_capital` `m`) AS `Ingresos`, (select coalesce(round(sum(`p`.`monto`),2),0) from `pagos` `p`) AS `Ventas`, (select `dinero`.`monto` from `dinero`) AS `capital` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `ganacias_mensuales`
--
DROP TABLE IF EXISTS `ganacias_mensuales`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `ganacias_mensuales`  AS SELECT (select coalesce(round((sum(`m`.`monto`) + (select sum(`m`.`monto`) from `movimientos_capital` `m` where ((`m`.`monto` like '-%') and (month(`m`.`fecha`) = 1)))),2),0) from `movimientos_capital` `m` where ((not((`m`.`monto` like '-%'))) and (month(`m`.`fecha`) = 1))) AS `Enero`, (select coalesce(round((sum(`m`.`monto`) + (select sum(`m`.`monto`) from `movimientos_capital` `m` where ((`m`.`monto` like '-%') and (month(`m`.`fecha`) = 2)))),2),0) from `movimientos_capital` `m` where ((not((`m`.`monto` like '-%'))) and (month(`m`.`fecha`) = 2))) AS `Febrero`, (select coalesce(round((sum(`m`.`monto`) + (select sum(`m`.`monto`) from `movimientos_capital` `m` where ((`m`.`monto` like '-%') and (month(`m`.`fecha`) = 3)))),2),0) from `movimientos_capital` `m` where ((not((`m`.`monto` like '-%'))) and (month(`m`.`fecha`) = 3))) AS `Marzo`, (select coalesce(round((sum(`m`.`monto`) + (select sum(`m`.`monto`) from `movimientos_capital` `m` where ((`m`.`monto` like '-%') and (month(`m`.`fecha`) = 4)))),2),0) from `movimientos_capital` `m` where ((not((`m`.`monto` like '-%'))) and (month(`m`.`fecha`) = 4))) AS `Abril`, (select coalesce(round((sum(`m`.`monto`) + (select sum(`m`.`monto`) from `movimientos_capital` `m` where ((`m`.`monto` like '-%') and (month(`m`.`fecha`) = 5)))),2),0) from `movimientos_capital` `m` where ((not((`m`.`monto` like '-%'))) and (month(`m`.`fecha`) = 5))) AS `Mayo`, (select coalesce(round((sum(`m`.`monto`) + (select sum(`m`.`monto`) from `movimientos_capital` `m` where ((`m`.`monto` like '-%') and (month(`m`.`fecha`) = 6)))),2),0) from `movimientos_capital` `m` where ((not((`m`.`monto` like '-%'))) and (month(`m`.`fecha`) = 6))) AS `Junio`, (select coalesce(round((sum(`m`.`monto`) + (select sum(`m`.`monto`) from `movimientos_capital` `m` where ((`m`.`monto` like '-%') and (month(`m`.`fecha`) = 7)))),2),0) from `movimientos_capital` `m` where ((not((`m`.`monto` like '-%'))) and (month(`m`.`fecha`) = 7))) AS `Julio`, (select coalesce(round((sum(`m`.`monto`) + (select sum(`m`.`monto`) from `movimientos_capital` `m` where ((`m`.`monto` like '-%') and (month(`m`.`fecha`) = 8)))),2),0) from `movimientos_capital` `m` where ((not((`m`.`monto` like '-%'))) and (month(`m`.`fecha`) = 8))) AS `Agosto`, (select coalesce(round((sum(`m`.`monto`) + (select sum(`m`.`monto`) from `movimientos_capital` `m` where ((`m`.`monto` like '-%') and (month(`m`.`fecha`) = 9)))),2),0) from `movimientos_capital` `m` where ((not((`m`.`monto` like '-%'))) and (month(`m`.`fecha`) = 9))) AS `Septiembre`, (select coalesce(round((sum(`m`.`monto`) + (select sum(`m`.`monto`) from `movimientos_capital` `m` where ((`m`.`monto` like '-%') and (month(`m`.`fecha`) = 10)))),2),0) from `movimientos_capital` `m` where ((not((`m`.`monto` like '-%'))) and (month(`m`.`fecha`) = 10))) AS `Octubre`, (select coalesce(round((sum(`m`.`monto`) + (select sum(`m`.`monto`) from `movimientos_capital` `m` where ((`m`.`monto` like '-%') and (month(`m`.`fecha`) = 11)))),2),0) from `movimientos_capital` `m` where ((not((`m`.`monto` like '-%'))) and (month(`m`.`fecha`) = 11))) AS `Noviembre`, (select coalesce(round((sum(`m`.`monto`) + (select sum(`m`.`monto`) from `movimientos_capital` `m` where ((`m`.`monto` like '-%') and (month(`m`.`fecha`) = 12)))),2),0) from `movimientos_capital` `m` where ((not((`m`.`monto` like '-%'))) and (month(`m`.`fecha`) = 12))) AS `Diciembre` FROM `movimientos_capital` AS `m` WHERE (year(`m`.`fecha`) = year(now())) LIMIT 0, 1 ;

-- --------------------------------------------------------

--
-- Estructura para la vista `max_ventas`
--
DROP TABLE IF EXISTS `max_ventas`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `max_ventas`  AS SELECT `p`.`id` AS `id`, `p`.`nombre` AS `nombre`, `p`.`valor_unidad` AS `unidad_valor`, (select `unidades`.`nombre` from `unidades` where (`unidades`.`id` = `p`.`id_unidad`)) AS `unidad`, (select `marcas`.`nombre` from `marcas` where (`marcas`.`id` = `p`.`id_marca`)) AS `marca`, (select sum(`f`.`cantidad`) from `factura` `f` where (`f`.`id_productos` = `p`.`id`)) AS `cantidad` FROM `productos` AS `p` WHERE (`p`.`active` = 1) ORDER BY (select sum(`f`.`cantidad`) from `factura` `f` where (`f`.`id_productos` = `p`.`id`)) DESC LIMIT 0, 5 ;

-- --------------------------------------------------------

--
-- Estructura para la vista `min_ventas`
--
DROP TABLE IF EXISTS `min_ventas`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `min_ventas`  AS SELECT `p`.`id` AS `id`, `p`.`nombre` AS `nombre`, `p`.`valor_unidad` AS `unidad_valor`, (select `unidades`.`nombre` from `unidades` where (`unidades`.`id` = `p`.`id_unidad`)) AS `unidad`, (select `marcas`.`nombre` from `marcas` where (`marcas`.`id` = `p`.`id_marca`)) AS `marca`, (select sum(`f`.`cantidad`) from `factura` `f` where (`f`.`id_productos` = `p`.`id`)) AS `cantidad` FROM `productos` AS `p` WHERE ((`p`.`active` = 1) AND ((select sum(`f`.`cantidad`) from `factura` `f` where (`f`.`id_productos` = `p`.`id`)) is not null)) ORDER BY (select sum(`f`.`cantidad`) from `factura` `f` where (`f`.`id_productos` = `p`.`id`)) ASC LIMIT 0, 5 ;

-- --------------------------------------------------------

--
-- Estructura para la vista `ratio_ventas`
--
DROP TABLE IF EXISTS `ratio_ventas`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `ratio_ventas`  AS SELECT `p`.`id` AS `id`, `p`.`nombre` AS `nombre`, `p`.`valor_unidad` AS `unidad_valor`, (select `unidades`.`nombre` from `unidades` where (`unidades`.`id` = `p`.`id_unidad`)) AS `unidad`, (select `marcas`.`nombre` from `marcas` where (`marcas`.`id` = `p`.`id_marca`)) AS `marca`, (1 - ((select sum(`c`.`existencia`) from `detalles_entradas` `c` where (`c`.`id_producto` = `p`.`id`)) / (select sum(`a`.`cantidad`) from `detalles_entradas` `a` where (`a`.`id_producto` = `p`.`id`)))) AS `ratio_ventas` FROM `productos` AS `p` WHERE (`p`.`active` = 1) LIMIT 0, 5 ;

-- --------------------------------------------------------

--
-- Estructura para la vista `rotacion_inventario`
--
DROP TABLE IF EXISTS `rotacion_inventario`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `rotacion_inventario`  AS SELECT coalesce(round(((select sum(`p`.`monto`) from (`pagos` `p` join `registro_ventas` `rv` on((`p`.`id_venta` = `rv`.`id`))) where (month(`rv`.`fecha`) = 1)) / (select sum((`e`.`existencia` * `e`.`precio_compra`)) from (`detalles_entradas` `e` join `entradas` `e2` on((`e2`.`id` = `e`.`id_entrada`))) where (month(`e2`.`fecha_compra`) = 1))),2),0) AS `Enero`, coalesce(round(((select sum(`p`.`monto`) from (`pagos` `p` join `registro_ventas` `rv` on((`p`.`id_venta` = `rv`.`id`))) where (month(`rv`.`fecha`) = 2)) / (select sum((`e`.`existencia` * `e`.`precio_compra`)) from (`detalles_entradas` `e` join `entradas` `e2` on((`e2`.`id` = `e`.`id_entrada`))) where (month(`e2`.`fecha_compra`) = 2))),2),0) AS `Febrero`, coalesce(round(((select sum(`p`.`monto`) from (`pagos` `p` join `registro_ventas` `rv` on((`p`.`id_venta` = `rv`.`id`))) where (month(`rv`.`fecha`) = 3)) / (select sum((`e`.`existencia` * `e`.`precio_compra`)) from (`detalles_entradas` `e` join `entradas` `e2` on((`e2`.`id` = `e`.`id_entrada`))) where (month(`e2`.`fecha_compra`) = 3))),2),0) AS `Marzo`, coalesce(round(((select sum(`p`.`monto`) from (`pagos` `p` join `registro_ventas` `rv` on((`p`.`id_venta` = `rv`.`id`))) where (month(`rv`.`fecha`) = 4)) / (select sum((`e`.`existencia` * `e`.`precio_compra`)) from (`detalles_entradas` `e` join `entradas` `e2` on((`e2`.`id` = `e`.`id_entrada`))) where (month(`e2`.`fecha_compra`) = 4))),2),0) AS `Abril`, coalesce(round(((select sum(`p`.`monto`) from (`pagos` `p` join `registro_ventas` `rv` on((`p`.`id_venta` = `rv`.`id`))) where (month(`rv`.`fecha`) = 5)) / (select sum((`e`.`existencia` * `e`.`precio_compra`)) from (`detalles_entradas` `e` join `entradas` `e2` on((`e2`.`id` = `e`.`id_entrada`))) where (month(`e2`.`fecha_compra`) = 5))),2),0) AS `Mayo`, coalesce(round(((select sum(`p`.`monto`) from (`pagos` `p` join `registro_ventas` `rv` on((`p`.`id_venta` = `rv`.`id`))) where (month(`rv`.`fecha`) = 6)) / (select sum((`e`.`existencia` * `e`.`precio_compra`)) from (`detalles_entradas` `e` join `entradas` `e2` on((`e2`.`id` = `e`.`id_entrada`))) where (month(`e2`.`fecha_compra`) = 6))),2),0) AS `Junio`, coalesce(round(((select sum(`p`.`monto`) from (`pagos` `p` join `registro_ventas` `rv` on((`p`.`id_venta` = `rv`.`id`))) where (month(`rv`.`fecha`) = 7)) / (select sum((`e`.`existencia` * `e`.`precio_compra`)) from (`detalles_entradas` `e` join `entradas` `e2` on((`e2`.`id` = `e`.`id_entrada`))) where (month(`e2`.`fecha_compra`) = 7))),2),0) AS `Julio`, coalesce(round(((select sum(`p`.`monto`) from (`pagos` `p` join `registro_ventas` `rv` on((`p`.`id_venta` = `rv`.`id`))) where (month(`rv`.`fecha`) = 8)) / (select sum((`e`.`existencia` * `e`.`precio_compra`)) from (`detalles_entradas` `e` join `entradas` `e2` on((`e2`.`id` = `e`.`id_entrada`))) where (month(`e2`.`fecha_compra`) = 8))),2),0) AS `Agosto`, coalesce(round(((select sum(`p`.`monto`) from (`pagos` `p` join `registro_ventas` `rv` on((`p`.`id_venta` = `rv`.`id`))) where (month(`rv`.`fecha`) = 9)) / (select sum((`e`.`existencia` * `e`.`precio_compra`)) from (`detalles_entradas` `e` join `entradas` `e2` on((`e2`.`id` = `e`.`id_entrada`))) where (month(`e2`.`fecha_compra`) = 9))),2),0) AS `Septiembre`, coalesce(round(((select sum(`p`.`monto`) from (`pagos` `p` join `registro_ventas` `rv` on((`p`.`id_venta` = `rv`.`id`))) where (month(`rv`.`fecha`) = 10)) / (select sum((`e`.`existencia` * `e`.`precio_compra`)) from (`detalles_entradas` `e` join `entradas` `e2` on((`e2`.`id` = `e`.`id_entrada`))) where (month(`e2`.`fecha_compra`) = 10))),2),0) AS `Octubre`, coalesce(round(((select sum(`p`.`monto`) from (`pagos` `p` join `registro_ventas` `rv` on((`p`.`id_venta` = `rv`.`id`))) where (month(`rv`.`fecha`) = 11)) / (select sum((`e`.`existencia` * `e`.`precio_compra`)) from (`detalles_entradas` `e` join `entradas` `e2` on((`e2`.`id` = `e`.`id_entrada`))) where (month(`e2`.`fecha_compra`) = 11))),2),0) AS `Noviembre`, coalesce(round(((select sum(`p`.`monto`) from (`pagos` `p` join `registro_ventas` `rv` on((`p`.`id_venta` = `rv`.`id`))) where (month(`rv`.`fecha`) = 12)) / (select sum((`e`.`existencia` * `e`.`precio_compra`)) from (`detalles_entradas` `e` join `entradas` `e2` on((`e2`.`id` = `e`.`id_entrada`))) where (month(`e2`.`fecha_compra`) = 12))),2),0) AS `Diciembre` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `total_productos_categoria`
--
DROP TABLE IF EXISTS `total_productos_categoria`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `total_productos_categoria`  AS SELECT `c`.`nombre` AS `categoria`, count(`p`.`id`) AS `total_productos` FROM (`categoria` `c` left join `productos` `p` on((`c`.`id` = `p`.`id_categoria`))) WHERE (`p`.`active` = 1) GROUP BY `c`.`id`, `c`.`nombre` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `total_stock_categoria`
--
DROP TABLE IF EXISTS `total_stock_categoria`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `total_stock_categoria`  AS SELECT `c`.`id` AS `id`, `c`.`nombre` AS `nombre`, (select sum((select sum(`e`.`existencia`) from `detalles_entradas` `e` where (`e`.`id_producto` = `p`.`id`))) from `productos` `p` where (`p`.`id_categoria` = `c`.`id`)) AS `total` FROM `categoria` AS `c` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `valortotalinventario`
--
DROP TABLE IF EXISTS `valortotalinventario`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `valortotalinventario`  AS SELECT (select `categoria`.`nombre` from `categoria` where (`categoria`.`id` = `p`.`id_categoria`)) AS `nombre`, round(sum(((select sum(`e`.`existencia`) from `detalles_entradas` `e` where (`e`.`id_producto` = `p`.`id`)) * `p`.`precio_venta`)),2) AS `valor` FROM `productos` AS `p` GROUP BY `p`.`id_categoria` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `valor_promedio_inventario_mensual`
--
DROP TABLE IF EXISTS `valor_promedio_inventario_mensual`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `valor_promedio_inventario_mensual`  AS SELECT coalesce(round((select sum((`e`.`existencia` * `e`.`precio_compra`)) from (`detalles_entradas` `e` join `entradas` `e2` on((`e2`.`id` = `e`.`id_entrada`))) where (month(`e2`.`fecha_compra`) = 1)),0),0) AS `Enero`, coalesce(round((select sum((`e`.`existencia` * `e`.`precio_compra`)) from (`detalles_entradas` `e` join `entradas` `e2` on((`e2`.`id` = `e`.`id_entrada`))) where (month(`e2`.`fecha_compra`) = 2)),0),0) AS `Febrero`, coalesce(round((select sum((`e`.`existencia` * `e`.`precio_compra`)) from (`detalles_entradas` `e` join `entradas` `e2` on((`e2`.`id` = `e`.`id_entrada`))) where (month(`e2`.`fecha_compra`) = 3)),0),0) AS `Marzo`, coalesce(round((select sum((`e`.`existencia` * `e`.`precio_compra`)) from (`detalles_entradas` `e` join `entradas` `e2` on((`e2`.`id` = `e`.`id_entrada`))) where (month(`e2`.`fecha_compra`) = 4)),0),0) AS `Abril`, coalesce(round((select sum((`e`.`existencia` * `e`.`precio_compra`)) from (`detalles_entradas` `e` join `entradas` `e2` on((`e2`.`id` = `e`.`id_entrada`))) where (month(`e2`.`fecha_compra`) = 5)),0),0) AS `Mayo`, coalesce(round((select sum((`e`.`existencia` * `e`.`precio_compra`)) from (`detalles_entradas` `e` join `entradas` `e2` on((`e2`.`id` = `e`.`id_entrada`))) where (month(`e2`.`fecha_compra`) = 6)),0),0) AS `Junio`, coalesce(round((select sum((`e`.`existencia` * `e`.`precio_compra`)) from (`detalles_entradas` `e` join `entradas` `e2` on((`e2`.`id` = `e`.`id_entrada`))) where (month(`e2`.`fecha_compra`) = 7)),0),0) AS `Julio`, coalesce(round((select sum((`e`.`existencia` * `e`.`precio_compra`)) from (`detalles_entradas` `e` join `entradas` `e2` on((`e2`.`id` = `e`.`id_entrada`))) where (month(`e2`.`fecha_compra`) = 8)),0),0) AS `Agosto`, coalesce(round((select sum((`e`.`existencia` * `e`.`precio_compra`)) from (`detalles_entradas` `e` join `entradas` `e2` on((`e2`.`id` = `e`.`id_entrada`))) where (month(`e2`.`fecha_compra`) = 9)),0),0) AS `Septiembre`, coalesce(round((select sum((`e`.`existencia` * `e`.`precio_compra`)) from (`detalles_entradas` `e` join `entradas` `e2` on((`e2`.`id` = `e`.`id_entrada`))) where (month(`e2`.`fecha_compra`) = 10)),0),0) AS `Octubre`, coalesce(round((select sum((`e`.`existencia` * `e`.`precio_compra`)) from (`detalles_entradas` `e` join `entradas` `e2` on((`e2`.`id` = `e`.`id_entrada`))) where (month(`e2`.`fecha_compra`) = 11)),0),0) AS `Noviembre`, coalesce(round((select sum((`e`.`existencia` * `e`.`precio_compra`)) from (`detalles_entradas` `e` join `entradas` `e2` on((`e2`.`id` = `e`.`id_entrada`))) where (month(`e2`.`fecha_compra`) = 12)),0),0) AS `Diciembre` ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `bitacora`
--
ALTER TABLE `bitacora`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario_idx` (`id_usuario`);

--
-- Indices de la tabla `caja`
--
ALTER TABLE `caja`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user_idx` (`id_usuario`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `configuraciones`
--
ALTER TABLE `configuraciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `credito`
--
ALTER TABLE `credito`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_registro_ventas_idx` (`id_rv`);

--
-- Indices de la tabla `detalles_entradas`
--
ALTER TABLE `detalles_entradas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_producto` (`id_producto`),
  ADD KEY `id_entradas1` (`id_entrada`),
  ADD KEY `id_empaque_idx` (`id_empaquetado`);

--
-- Indices de la tabla `dinero`
--
ALTER TABLE `dinero`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `entradas`
--
ALTER TABLE `entradas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_proveedor` (`id_proveedor`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_productos_has_registro_ventas_registro_ventas1_idx` (`id_registro_ventas`),
  ADD KEY `fk_productos_has_registro_ventas_productos1_idx` (`id_productos`);

--
-- Indices de la tabla `marcas`
--
ALTER TABLE `marcas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `metodo_pago`
--
ALTER TABLE `metodo_pago`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `movimientos_capital`
--
ALTER TABLE `movimientos_capital`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_venta_idx` (`id_venta`),
  ADD KEY `id_metodo_pago_idx` (`id_metodo_pago`);

--
-- Indices de la tabla `pagos_entradas`
--
ALTER TABLE `pagos_entradas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_metodo_pago2` (`id_metodo_pago`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuarios_idx` (`id_usuario`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`),
  ADD KEY `id_categoria_idx` (`id_categoria`),
  ADD KEY `id_stock_max_min_idx` (`id_unidad`),
  ADD KEY `id_marca_idx` (`id_marca`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `registro_ventas`
--
ALTER TABLE `registro_ventas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_cliente_idx` (`id_cliente`),
  ADD KEY `id_caja_idx` (`id_caja`);

--
-- Indices de la tabla `tipo_empaquetado`
--
ALTER TABLE `tipo_empaquetado`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_empaquetado_por_categoria`
--
ALTER TABLE `tipo_empaquetado_por_categoria`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_categoria` (`id_categoria`),
  ADD KEY `id_tipo_empaquetado` (`id_tipo_empaquetado`);

--
-- Indices de la tabla `unidades`
--
ALTER TABLE `unidades`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `bitacora`
--
ALTER TABLE `bitacora`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=166;

--
-- AUTO_INCREMENT de la tabla `caja`
--
ALTER TABLE `caja`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `configuraciones`
--
ALTER TABLE `configuraciones`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `credito`
--
ALTER TABLE `credito`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `detalles_entradas`
--
ALTER TABLE `detalles_entradas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `dinero`
--
ALTER TABLE `dinero`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `entradas`
--
ALTER TABLE `entradas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `marcas`
--
ALTER TABLE `marcas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `metodo_pago`
--
ALTER TABLE `metodo_pago`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `movimientos_capital`
--
ALTER TABLE `movimientos_capital`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pagos`
--
ALTER TABLE `pagos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `pagos_entradas`
--
ALTER TABLE `pagos_entradas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `registro_ventas`
--
ALTER TABLE `registro_ventas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `tipo_empaquetado`
--
ALTER TABLE `tipo_empaquetado`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tipo_empaquetado_por_categoria`
--
ALTER TABLE `tipo_empaquetado_por_categoria`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `unidades`
--
ALTER TABLE `unidades`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `bitacora`
--
ALTER TABLE `bitacora`
  ADD CONSTRAINT `id_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `caja`
--
ALTER TABLE `caja`
  ADD CONSTRAINT `id_user` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `credito`
--
ALTER TABLE `credito`
  ADD CONSTRAINT `id_rv` FOREIGN KEY (`id_rv`) REFERENCES `registro_ventas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalles_entradas`
--
ALTER TABLE `detalles_entradas`
  ADD CONSTRAINT `id_empaque` FOREIGN KEY (`id_empaquetado`) REFERENCES `tipo_empaquetado` (`id`),
  ADD CONSTRAINT `id_entradas1` FOREIGN KEY (`id_entrada`) REFERENCES `entradas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_producto` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `entradas`
--
ALTER TABLE `entradas`
  ADD CONSTRAINT `entradas_ibfk_2` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `factura`
--
ALTER TABLE `factura`
  ADD CONSTRAINT `fk_productos_has_registro_ventas_productos1` FOREIGN KEY (`id_productos`) REFERENCES `productos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_productos_has_registro_ventas_registro_ventas1` FOREIGN KEY (`id_registro_ventas`) REFERENCES `registro_ventas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD CONSTRAINT `id_metodo_pago` FOREIGN KEY (`id_metodo_pago`) REFERENCES `metodo_pago` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_venta` FOREIGN KEY (`id_venta`) REFERENCES `registro_ventas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `pagos_entradas`
--
ALTER TABLE `pagos_entradas`
  ADD CONSTRAINT `id_metodo_pago2` FOREIGN KEY (`id_metodo_pago`) REFERENCES `metodo_pago` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD CONSTRAINT `id_usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `id_marca_idx` FOREIGN KEY (`id_marca`) REFERENCES `marcas` (`id`);

--
-- Filtros para la tabla `registro_ventas`
--
ALTER TABLE `registro_ventas`
  ADD CONSTRAINT `id_caja` FOREIGN KEY (`id_caja`) REFERENCES `caja` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_cliente` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tipo_empaquetado_por_categoria`
--
ALTER TABLE `tipo_empaquetado_por_categoria`
  ADD CONSTRAINT `id_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_tipo_empaquetado` FOREIGN KEY (`id_tipo_empaquetado`) REFERENCES `tipo_empaquetado` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

DELIMITER $$
--
-- Eventos
--
CREATE DEFINER=`root`@`localhost` EVENT `check_and_notify` ON SCHEDULE EVERY 1 DAY STARTS '2024-06-23 10:04:00' ON COMPLETION NOT PRESERVE ENABLE DO CALL check_and_notify()$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
