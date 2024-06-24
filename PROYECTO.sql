-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-06-2024 a las 22:08:20
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
-- Base de datos: `proyecto_4`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `AsignarTotalVentasDia` (IN `id_caja` INT(250))   BEGIN
    DECLARE asignar_total_ventas FLOAT;
	SELECT SUM(rv.monto_final) INTO asignar_total_ventas FROM registro_ventas rv WHERE rv.id_caja = id_caja;
	UPDATE caja c SET c.monto_final = asignar_total_ventas, c.fecha_cierre = CURRENT_TIMESTAMP, c.estado = 1, c.total_ventas = (SELECT COUNT(rv2.id) FROM registro_ventas rv2 WHERE rv2.id_caja = c.id) WHERE c.id = id_caja AND c.estado = 0;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `check_and_notify` ()   BEGIN
    DECLARE done INT DEFAULT FALSE;
    DECLARE entrada_id INT;
    DECLARE entrada_fecha_venc DATE;
    DECLARE diff INT;
    DECLARE cur CURSOR FOR SELECT id, fecha_vencimiento FROM entradas WHERE active = 1;
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;

    OPEN cur;

    read_loop: LOOP
        FETCH cur INTO entrada_id, entrada_fecha_venc;
        IF done THEN
            LEAVE read_loop;
        END IF;

        SET diff = dias_diferencia(entrada_fecha_venc, CURDATE());

        CASE diff
            WHEN 10 THEN
                INSERT INTO notificaciones (id_usuario, status, mensaje, fecha)
                VALUES (1, 0, CONCAT('La entrada con ID ', entrada_id, ' vence en 10 días.'), NOW());
            WHEN 5 THEN
                INSERT INTO notificaciones (id_usuario, status, mensaje, fecha)
                VALUES (1, 0, CONCAT('La entrada con ID ', entrada_id, ' vence en 5 días.'), NOW());
            WHEN 2 THEN
                INSERT INTO notificaciones (id_usuario, status, mensaje, fecha)
                VALUES (1, 0, CONCAT('La entrada con ID ', entrada_id, ' vence en 2 días.'), NOW());
            WHEN 0 THEN
                INSERT INTO notificaciones (id_usuario, status, mensaje, fecha)
                VALUES (1, 0, CONCAT('La entrada con ID ', entrada_id, ' vence hoy.'), NOW());
     ELSE
     	SELECT * FROM entradas;
        END CASE;

    END LOOP;

    CLOSE cur;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `HOLA` (IN `id_caja` INT(250))   BEGIN
    DECLARE asignar_total_ventas FLOAT;
	SELECT SUM(rv.monto_final) INTO asignar_total_ventas FROM registro_ventas rv WHERE rv.id_caja = id_caja;
	UPDATE caja c SET c.monto_final = asignar_total_ventas, c.fecha_cierre = CURRENT_TIMESTAMP, c.estado = 1, c.total_ventas = (SELECT COUNT(rv2.id) FROM registro_ventas rv2 WHERE rv2.id_caja = c.id) WHERE c.id = id_caja AND c.estado = 0;
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
(207, 6, 'Caja', 'Abriendo', '2024-06-22 17:50:31', 'Caja abierta'),
(208, 6, 'Caja', 'Abriendo', '2024-06-22 21:18:57', 'Caja abierta'),
(209, 6, 'Pagos', 'Registrar', '2024-06-23 12:01:08', 'Pago Registrado'),
(210, 6, 'registrar_ventas', 'agregar', '2024-06-23 12:01:08', 'se agrego una venta'),
(211, 6, 'Caja', 'Abriendo', '2024-06-23 12:31:43', 'Caja abierta'),
(212, 6, 'Pagos', 'Registrar', '2024-06-23 12:32:20', 'Pago Registrado'),
(213, 6, 'registrar_ventas', 'agregar', '2024-06-23 12:32:20', 'se agrego una venta'),
(214, 6, 'Permisos', 'Eliminar', '2024-06-23 12:52:20', 'Permiso Eliminado'),
(215, 6, 'Permisos', 'Eliminar', '2024-06-23 12:52:22', 'Permiso Eliminado'),
(216, 6, 'Permisos', 'Eliminar', '2024-06-23 12:52:23', 'Permiso Eliminado'),
(217, 6, 'Caja', 'Abriendo', '2024-06-23 13:06:12', 'Caja abierta'),
(218, 6, 'Caja', 'Abriendo', '2024-06-23 15:55:18', 'Caja abierta'),
(219, 6, 'Caja', 'Abriendo', '2024-06-23 16:06:40', 'Caja abierta'),
(220, 6, 'Pagos', 'Registrar', '2024-06-23 16:07:32', 'Pago Registrado'),
(221, 6, 'registrar_ventas', 'agregar', '2024-06-23 16:07:32', 'se agrego una venta'),
(222, 6, 'Caja', 'Abriendo', '2024-06-23 16:11:44', 'Caja abierta'),
(223, 6, 'Caja', 'Abriendo', '2024-06-23 16:14:09', 'Caja abierta'),
(224, 6, 'Caja', 'Abriendo', '2024-06-23 16:21:15', 'Caja abierta'),
(225, 6, 'Caja', 'Abriendo', '2024-06-23 16:22:33', 'Caja abierta'),
(226, 6, 'Login', 'logueado', '2024-06-24 00:10:47', 'El usuario Edouard inicio sesion'),
(227, 6, 'Login', 'logueado', '2024-06-24 14:29:24', 'El usuario Edouard inicio sesion');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caja`
--

CREATE TABLE `caja` (
  `id` int NOT NULL,
  `id_usuario` int NOT NULL,
  `monto_inicial` float NOT NULL,
  `monto_final` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '0',
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
(29, 6, 4000, NULL, '2024-06-23 16:21:15', 1, '2024-06-23 16:22:25', 0, 0),
(30, 6, 45, NULL, '2024-06-23 16:22:33', 1, '2024-06-23 16:23:05', 0, 0);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `capital`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `capital` (
`sum(monto)` decimal(32,0)
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
(14, 'Aseo'),
(1, 'bebida'),
(2, 'empaquetados'),
(15, 'miselaneos');

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
(12, 'Alejandro', '30087582', 'Vargas', 'V', 'Avenida 15, local numero5', '+584126742231', 1);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `clientesfrecuentes`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `clientesfrecuentes` (
`idCliente` bigint
,`Cliente` varchar(500)
,`Compras` bigint
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracion`
--

CREATE TABLE `configuracion` (
  `id` int NOT NULL,
  `monto_capital` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `monto_dolar_paralelo` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `monto_dolar_bcv` varchar(45) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Estructura de tabla para la tabla `dinero`
--

CREATE TABLE `dinero` (
  `id` int NOT NULL,
  `monto` float NOT NULL,
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `dinero`
--

INSERT INTO `dinero` (`id`, `monto`, `fecha`) VALUES
(1, -348, '2024-06-22 09:11:17');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entradas`
--

CREATE TABLE `entradas` (
  `id` int NOT NULL,
  `id_producto` int NOT NULL,
  `id_proveedor` int NOT NULL,
  `cantidad` int NOT NULL,
  `fecha_compra` date NOT NULL,
  `fecha_vencimiento` date NOT NULL,
  `precio_compra` float NOT NULL,
  `existencia` int NOT NULL DEFAULT '0',
  `active` tinyint DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `entradas`
--

INSERT INTO `entradas` (`id`, `id_producto`, `id_proveedor`, `cantidad`, `fecha_compra`, `fecha_vencimiento`, `precio_compra`, `existencia`, `active`) VALUES
(106, 39, 8, 5, '2024-06-24', '2024-07-04', 6.8, 5, 1),
(107, 31, 8, 5, '2024-06-24', '2024-07-02', 4.9, 5, 1),
(108, 32, 8, 4, '2024-06-24', '2024-08-30', 6, 4, 1),
(109, 36, 8, 1, '2024-06-24', '2024-07-04', 21, 1, 1);

--
-- Disparadores `entradas`
--
DELIMITER $$
CREATE TRIGGER `entradas_agg` AFTER INSERT ON `entradas` FOR EACH ROW BEGIN
    DECLARE total_egreso FLOAT;
    SET total_egreso = NEW.cantidad * NEW.precio_compra;
    INSERT INTO movimientos_capital (monto, descripcion)
    VALUES (-total_egreso, 'Egreso por nuevas entradas');
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `precio_productos` AFTER INSERT ON `entradas` FOR EACH ROW BEGIN
    DECLARE v_ganancia DECIMAL(10,2);
    DECLARE v_precio_anterior DECIMAL(10,2);
    DECLARE v_stock_anterior INT;
    DECLARE v_algoritmo INT;
    DECLARE v_precio_nuevo DECIMAL(10,2);

    -- Obtén el valor de ganancia, precio anterior, stock anterior y algoritmo de la tabla productos
    SELECT p.ganancia, p.precio_venta, (SELECT SUM(e.existencia) FROM entradas as e WHERE e.id_producto=p.id) as stock, p.algoritmo INTO v_ganancia, v_precio_anterior, v_stock_anterior, v_algoritmo
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
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `id` int NOT NULL,
  `id_registro_ventas` int NOT NULL,
  `id_productos` int NOT NULL,
  `cantidad` int NOT NULL,
  `coste_producto_total` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

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
(1, 'polar'),
(3, 'Juana'),
(12, 'La cristal');

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
(7, 'Transferencia', 1),
(8, 'Efectivo', 1),
(9, 'Divisa', 1);

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
(1, -275, 'Egreso por nuevas entradas', '2024-06-22 17:14:04'),
(4, -375, 'Egreso por nuevas entradas', '2024-06-22 17:37:16'),
(9, -125, 'Egreso por nuevas entradas', '2024-06-22 17:49:47'),
(10, 191, 'Ingreso por facturacion', '2024-06-23 12:01:07'),
(11, 96, 'Ingreso por facturacion', '2024-06-23 12:32:20'),
(12, 96, 'Ingreso por facturacion', '2024-06-23 16:07:32'),
(13, -75, 'Egreso por nuevas entradas', '2024-06-23 19:04:47'),
(14, -150, 'Egreso por nuevas entradas', '2024-06-23 19:07:46'),
(15, -300, 'Egreso por nuevas entradas', '2024-06-23 19:09:37'),
(16, -8, 'Egreso por nuevas entradas', '2024-06-23 19:10:02'),
(17, -34, 'Egreso por nuevas entradas', '2024-06-23 20:56:57'),
(18, -24, 'Egreso por nuevas entradas', '2024-06-24 00:18:04'),
(19, -24, 'Egreso por nuevas entradas', '2024-06-24 00:18:56'),
(20, -21, 'Egreso por nuevas entradas', '2024-06-24 00:27:12');

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
  `mensaje` varchar(250) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `notificaciones`
--

INSERT INTO `notificaciones` (`id`, `id_usuario`, `status`, `mensaje`, `fecha`) VALUES
(24, 1, 0, 'La entrada con ID 106 vence en 10 días.', '2024-06-24 16:07:00'),
(25, 1, 0, 'La entrada con ID 109 vence en 10 días.', '2024-06-24 16:07:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos`
--

CREATE TABLE `pagos` (
  `id` int NOT NULL,
  `id_venta` int NOT NULL,
  `id_metodo_pago` int NOT NULL,
  `monto` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(2, 6, 'categorias', 'buscar'),
(3, 6, 'marcas', 'buscar'),
(4, 6, 'productos', 'modificar'),
(5, 6, 'unidades', 'buscar');

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
  `active` tinyint DEFAULT '1',
  `ganancia` float NOT NULL,
  `codigo` varchar(500) NOT NULL,
  `algoritmo` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `id_categoria`, `id_unidad`, `id_marca`, `valor_unidad`, `nombre`, `imagen`, `stock_min`, `stock_max`, `precio_venta`, `IVA`, `active`, `ganancia`, `codigo`, `algoritmo`) VALUES
(1, 1, 1, 1, 150, 'pan', 'afafef', 5, 10, 29.718, 0, 1, 0.3, '123456789012', 2),
(31, 1, 2, 1, 1, 'Azucar', 'producto_Azucar_5e5294ee-d7d2-424d-ac2e-5802bbad41ab.jpeg', 5, 10, 7.35, 1, 1, 0.5, '', 1),
(32, 2, 2, 3, 1, 'Harina', 'producto_Harina_2551fe44-3bc1-476e-b084-e7ff84eb8600.jpeg', 10, 20, 9.25, 0, 1, 0, '', 2),
(33, 2, 2, 1, 1, 'Arroz', 'producto_Arroz_2c51307c-9d9f-41fb-9419-1e61a44891f0.jpeg', 5, 10, 15.01, 0, 1, 0, '', NULL),
(34, 2, 2, 12, 1, 'Pasta', 'producto_Pasta_arroz.jpeg', 5, 20, 15, 0, 1, 0, '', NULL),
(35, 1, 2, 1, 10, 'Hfgrtg', 'producto_Hfgrtg_1626311193_Naruto - boruto (383).jpg', 1, 12, 10, 1, 1, 0, '111111111111', NULL),
(36, 15, 1, 1, 1, 'Alcohol', 'producto_Alcohol_ImgThumb.jpg', 5, 10, 21, 0, 1, 0, '754123698547', 1),
(37, 14, 1, 1, 1, 'mmaamama', 'producto_mmaamama_leche-en-polvo-la-campiña-250g_pic299027ni0t0.jpg', 8, 78, 25, 1, 1, 0, '785412369524', 1),
(38, 2, 2, 3, 1, 'pollo', 'producto_pollo_DIABLITOS-UNDERWOOD.jpg', 8, 78, 85, 0, 1, 0, '785412369524', 1),
(39, 2, 1, 1, 30, 'Atun', 'producto_Atun_unnamed (1).jpg', 2, 6, 6.8, 0, 1, 0, '123456788888', 1);

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
  `active` tinyint DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`id`, `nombre`, `razon_social`, `rif`, `telefono`, `correo`, `direccion`, `active`) VALUES
(1, 'tyrty', 'nn', 'J-00000000', '1231231231', 'nose@gmail.com', '54764576', 0),
(7, 'montecarmelo', 'Montecarmelo', 'J-00000000', '0000000', 'garnicaluis391@gmail.com', 'scacac', 0),
(8, 'Jose', 'Pan', 'J-00000000', '1231231231', 'ald@gmail.com', 'mmmda', 1),
(9, 'Alejandro', 'Tunal', 'V-30087582', '+584126742231', 'garnicaluis391@gmail.com', 'Avenida 15, local numero5', 0),
(14, 'Lorenzo', 'Hearshi', 'E-15930218', '+584125915587', 'polar@gmail.com', 'Direccion tal', 0),
(15, 'Mendoza', 'Chocolate', 'V-15930218', '+584125915587', 'polar@gmail.com', 'Direccion tal', 0);

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
(1, 'g'),
(2, 'Kg'),
(30, 'Pan');

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
  `semilla` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `correo`, `hash`, `rol`, `active`, `semilla`) VALUES
(5, 'asd', 'jaja@gmail.com', '$2y$10$fdgc0QZ4YyBMB3ix3jV5AOesVSZFCRrTZ.UUHr61qjviWGq7zi7h2', 1, 1, ''),
(6, 'Edouard', 'nose@gmail.com', '$2y$10$ey1aHUkj5We8D34bQSoAZesKdwW6tv26V9K.DtkHBfVrQFE7Wzj/e', 1, 1, 'MSKR0rIA3x95JGubVUWk'),
(7, 'John', 'johnconnor@gmail.com', '$2y$10$EgZWh1WmrpMGrsF9K2DjyeL5YTds6aS3.Rku/.h8P7wk7ltODzf9e', 2, 1, ''),
(10, 'Alfredo', 'alfredo@gmail.com', '$2y$10$8nUZSX2kXCVysLvCLirVyuhfeUSB0uICkZsl3kiDJY4kqlZCI8DKu', 2, 1, ''),
(11, 'Pedro', 'garnicaluis391@gmail.com', '$2y$10$hK9fotzmkm/BvMtkUEiK0e8kdG/PtmF13R.Wpn.lIRWC29F1c1i3m', 1, 1, ''),
(12, 'Juan', 'depanajuaner@gmail.com', '$2y$10$W7XfRH4IOSoK.KP67LnOUuaN4DzXX7jRwF4QfQxphpqCd38xVSDbu', 1, 1, 'MSKR0rIA3x95JGubVUWq'),
(13, 'Vanessa', 'yfvy87@gmail.com', '$2y$10$HZR6p6T5mhr0l.W0UnFcCeO1wDGD6wrrpPCmAcVoIRUYQbHDLIJC2', 2, 1, 'z1juwnyJTFxdCAGB3ihY');

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `valortotalinventario`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `valortotalinventario` (
`Nombre` varchar(50)
,`Value` double
);

-- --------------------------------------------------------

--
-- Estructura para la vista `capital`
--
DROP TABLE IF EXISTS `capital`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `capital`  AS SELECT sum(`movimientos_capital`.`monto`) AS `sum(monto)` FROM `movimientos_capital` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `clientesfrecuentes`
--
DROP TABLE IF EXISTS `clientesfrecuentes`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `clientesfrecuentes`  AS SELECT (select `registro_ventas`.`id_cliente`) AS `idCliente`, (select `clientes`.`nombre` from `clientes` where (`clientes`.`id` = `registro_ventas`.`id_cliente`)) AS `Cliente`, (select count(0) from `registro_ventas` where (`registro_ventas`.`id_cliente` = `idCliente`)) AS `Compras` FROM `registro_ventas` GROUP BY `registro_ventas`.`id_cliente` ORDER BY (select count(0) from `registro_ventas` where (`registro_ventas`.`id_cliente` = `idCliente`)) DESC LIMIT 0, 5 ;

-- --------------------------------------------------------

--
-- Estructura para la vista `max_ventas`
--
DROP TABLE IF EXISTS `max_ventas`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `max_ventas`  AS SELECT `p`.`id` AS `id`, `p`.`nombre` AS `nombre`, `p`.`valor_unidad` AS `unidad_valor`, (select `unidades`.`nombre` from `unidades` where (`unidades`.`id` = `p`.`id_unidad`)) AS `unidad`, (select `marcas`.`nombre` from `marcas` where (`marcas`.`id` = `p`.`id_marca`)) AS `marca`, (select sum(`f`.`cantidad`) from `factura` `f` where (`f`.`id_productos` = `p`.`id`)) AS `cantidad` FROM `productos` AS `p` WHERE (`p`.`active` = 1) ORDER BY (select sum(`f`.`cantidad`) from `factura` `f` where (`f`.`id_productos` = `p`.`id`)) ASC ;

-- --------------------------------------------------------

--
-- Estructura para la vista `min_ventas`
--
DROP TABLE IF EXISTS `min_ventas`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `min_ventas`  AS SELECT `p`.`id` AS `id`, `p`.`nombre` AS `nombre`, `p`.`valor_unidad` AS `unidad_valor`, (select `unidades`.`nombre` from `unidades` where (`unidades`.`id` = `p`.`id_unidad`)) AS `unidad`, (select `marcas`.`nombre` from `marcas` where (`marcas`.`id` = `p`.`id_marca`)) AS `marca`, (select sum(`f`.`cantidad`) from `factura` `f` where (`f`.`id_productos` = `p`.`id`)) AS `cantidad` FROM `productos` AS `p` WHERE (`p`.`active` = 1) ORDER BY (select sum(`f`.`cantidad`) from `factura` `f` where (`f`.`id_productos` = `p`.`id`)) ASC ;

-- --------------------------------------------------------

--
-- Estructura para la vista `ratio_ventas`
--
DROP TABLE IF EXISTS `ratio_ventas`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `ratio_ventas`  AS SELECT `p`.`id` AS `id`, `p`.`nombre` AS `nombre`, `p`.`valor_unidad` AS `unidad_valor`, (select `unidades`.`nombre` from `unidades` where (`unidades`.`id` = `p`.`id_unidad`)) AS `unidad`, (select `marcas`.`nombre` from `marcas` where (`marcas`.`id` = `p`.`id_marca`)) AS `marca`, (1 - ((select sum(`c`.`existencia`) from `entradas` `c` where (`c`.`id_producto` = `p`.`id`)) / (select sum(`a`.`cantidad`) from `entradas` `a` where (`a`.`id_producto` = `p`.`id`)))) AS `ratio_ventas` FROM `productos` AS `p` WHERE (`p`.`active` = 1) LIMIT 0, 5 ;

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

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `total_stock_categoria`  AS SELECT `c`.`id` AS `id`, `c`.`nombre` AS `nombre`, (select sum((select sum(`e`.`existencia`) from `entradas` `e` where (`e`.`id_producto` = `p`.`id`))) from `productos` `p` where (`p`.`id_categoria` = `c`.`id`)) AS `total` FROM `categoria` AS `c` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `valortotalinventario`
--
DROP TABLE IF EXISTS `valortotalinventario`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `valortotalinventario`  AS SELECT (select `categoria`.`nombre` from `categoria` where (`categoria`.`id` = `productos`.`id_categoria`)) AS `Nombre`, round(avg(`productos`.`precio_venta`),2) AS `Value` FROM `productos` GROUP BY `productos`.`id_categoria` ;

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
-- Indices de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `credito`
--
ALTER TABLE `credito`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_registro_ventas_idx` (`id_rv`);

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
  ADD KEY `id_producto` (`id_producto`),
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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=228;

--
-- AUTO_INCREMENT de la tabla `caja`
--
ALTER TABLE `caja`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `credito`
--
ALTER TABLE `credito`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `dinero`
--
ALTER TABLE `dinero`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `entradas`
--
ALTER TABLE `entradas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT de la tabla `marcas`
--
ALTER TABLE `marcas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `metodo_pago`
--
ALTER TABLE `metodo_pago`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `movimientos_capital`
--
ALTER TABLE `movimientos_capital`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `pagos`
--
ALTER TABLE `pagos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `registro_ventas`
--
ALTER TABLE `registro_ventas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT de la tabla `unidades`
--
ALTER TABLE `unidades`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `bitacora`
--
ALTER TABLE `bitacora`
  ADD CONSTRAINT `id_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Filtros para la tabla `caja`
--
ALTER TABLE `caja`
  ADD CONSTRAINT `id_user` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Filtros para la tabla `credito`
--
ALTER TABLE `credito`
  ADD CONSTRAINT `id_rv` FOREIGN KEY (`id_rv`) REFERENCES `registro_ventas` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Filtros para la tabla `entradas`
--
ALTER TABLE `entradas`
  ADD CONSTRAINT `entradas_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `entradas_ibfk_2` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `factura`
--
ALTER TABLE `factura`
  ADD CONSTRAINT `fk_productos_has_registro_ventas_productos1` FOREIGN KEY (`id_productos`) REFERENCES `productos` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_productos_has_registro_ventas_registro_ventas1` FOREIGN KEY (`id_registro_ventas`) REFERENCES `registro_ventas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD CONSTRAINT `id_metodo_pago` FOREIGN KEY (`id_metodo_pago`) REFERENCES `metodo_pago` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `id_venta` FOREIGN KEY (`id_venta`) REFERENCES `registro_ventas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD CONSTRAINT `id_usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `id_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `id_marca` FOREIGN KEY (`id_marca`) REFERENCES `marcas` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `id_unidad` FOREIGN KEY (`id_unidad`) REFERENCES `unidades` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Filtros para la tabla `registro_ventas`
--
ALTER TABLE `registro_ventas`
  ADD CONSTRAINT `id_caja` FOREIGN KEY (`id_caja`) REFERENCES `caja` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `id_cliente` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

DELIMITER $$
--
-- Eventos
--
CREATE DEFINER=`root`@`localhost` EVENT `check_and_notify` ON SCHEDULE EVERY 1 DAY STARTS '2024-06-23 00:00:00' ON COMPLETION NOT PRESERVE ENABLE DO CALL check_and_notify()$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
