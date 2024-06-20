-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-06-2024 a las 00:56:22
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyecto`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bitacora`
--

CREATE TABLE `bitacora` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `tabla` varchar(45) NOT NULL,
  `accion` varchar(45) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  `detalles` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `bitacora`
--

INSERT INTO `bitacora` (`id`, `id_usuario`, `tabla`, `accion`, `fecha`, `detalles`) VALUES
(30, 6, 'Metodos de Pago', 'Registrar', '2024-06-15 21:48:14', 'Metodo de Pago Registrado'),
(31, 6, 'Login', 'logueado', '2024-06-16 09:34:45', 'El usuario Edouard inicio sesion'),
(32, 6, 'Proveedor', 'Desactivado', '2024-06-16 09:34:56', 'Proveedor14 Eliminado'),
(33, 6, 'Metodo de Pago', 'Eliminar', '2024-06-16 09:39:04', 'Metodo de Pago 9 Eliminado'),
(34, 6, 'Metodo de Pago', 'Modificar', '2024-06-16 09:39:11', 'Metodo de Pago 8 Modificado'),
(35, 6, 'deslogin', 'des-logueado', '2024-06-16 13:40:53', 'el usuario Edouard se des-logueo'),
(36, 6, 'Login', 'logueado', '2024-06-16 13:41:08', 'El usuario Edouard inicio sesion'),
(37, 6, 'Cliente', 'Registrar', '2024-06-16 14:03:12', 'Cliente Registrado'),
(38, 6, 'Login', 'logueado', '2024-06-16 19:38:56', 'El usuario Edouard inicio sesion'),
(39, 6, 'Pagos', 'Registrar', '2024-06-16 22:08:24', 'Pago Registrado'),
(40, 6, 'registrar_ventas', 'agregar', '2024-06-16 22:08:24', 'se agrego una venta'),
(41, 6, 'deslogin', 'des-logueado', '2024-06-16 23:05:10', 'el usuario Edouard se des-logueo'),
(42, 6, 'Login', 'logueado', '2024-06-16 23:06:17', 'El usuario Edouard inicio sesion'),
(43, 6, 'Usuarios', 'Registrar', '2024-06-16 23:07:42', 'Usuario Registrado'),
(44, 6, 'deslogin', 'des-logueado', '2024-06-16 23:07:52', 'el usuario Edouard se des-logueo'),
(45, 6, 'Login', 'logueado', '2024-06-16 23:08:32', 'El usuario Edouard inicio sesion'),
(46, 6, 'Usuarios', 'Registrar', '2024-06-16 23:09:10', 'Usuario Registrado'),
(47, 6, 'deslogin', 'des-logueado', '2024-06-16 23:09:16', 'el usuario Edouard se des-logueo'),
(48, 10, 'Login', 'logueado', '2024-06-16 23:09:24', 'El usuario Alfredo inicio sesion'),
(49, 10, 'deslogin', 'des-logueado', '2024-06-16 23:23:16', 'el usuario Alfredo se des-logueo'),
(50, 6, 'Login', 'logueado', '2024-06-16 23:23:23', 'El usuario Edouard inicio sesion'),
(51, 6, 'Usuarios', 'Eliminados', '2024-06-17 00:57:07', 'Usuario  Eliminado'),
(52, 6, 'Usuarios', 'Eliminados', '2024-06-17 00:57:14', 'Usuario  Eliminado'),
(53, 6, 'deslogin', 'des-logueado', '2024-06-17 08:49:32', 'el usuario Edouard se des-logueo'),
(54, 6, 'Login', 'logueado', '2024-06-17 08:55:31', 'El usuario Edouard inicio sesion'),
(55, 6, 'Usuarios', 'Registrar', '2024-06-17 08:59:16', 'Usuario Registrado'),
(56, 6, 'Marcas', 'Registrar', '2024-06-17 09:07:48', 'Marca Registrada'),
(57, 6, 'deslogin', 'des-logueado', '2024-06-17 10:16:39', 'el usuario Edouard se des-logueo'),
(58, 6, 'Login', 'logueado', '2024-06-17 10:19:24', 'El usuario Edouard inicio sesion'),
(59, 6, 'Login', 'logueado', '2024-06-18 10:41:53', 'El usuario Edouard inicio sesion'),
(60, 6, 'Pagos', 'Registrar', '2024-06-18 11:37:59', 'Pago Registrado'),
(61, 6, 'Pagos', 'Registrar', '2024-06-18 11:37:59', 'Pago Registrado'),
(62, 6, 'registrar_ventas', 'agregar', '2024-06-18 11:37:59', 'se agrego una venta'),
(63, 6, 'Metodo de Pago', 'Modificar', '2024-06-18 11:43:21', 'Metodo de Pago 7 Modificado'),
(64, 6, 'Metodo de Pago', 'Modificar', '2024-06-18 11:43:27', 'Metodo de Pago 8 Modificado'),
(65, 6, 'deslogin', 'des-logueado', '2024-06-18 11:49:36', 'el usuario Edouard se des-logueo'),
(66, 6, 'Login', 'logueado', '2024-06-18 11:50:04', 'El usuario Edouard inicio sesion'),
(67, 6, 'Pagos', 'Registrar', '2024-06-18 11:55:45', 'Pago Registrado'),
(68, 6, 'registrar_ventas', 'agregar', '2024-06-18 11:55:45', 'se agrego una venta'),
(69, 6, 'deslogin', 'des-logueado', '2024-06-18 11:56:18', 'el usuario Edouard se des-logueo'),
(70, 10, 'Login', 'logueado', '2024-06-18 11:56:37', 'El usuario Alfredo inicio sesion'),
(71, 10, 'deslogin', 'des-logueado', '2024-06-18 12:04:44', 'el usuario Alfredo se des-logueo'),
(72, 6, 'Login', 'logueado', '2024-06-18 18:42:34', 'El usuario Edouard inicio sesion'),
(73, 6, 'deslogin', 'des-logueado', '2024-06-19 00:03:02', 'el usuario Edouard se des-logueo'),
(74, 6, 'Login', 'logueado', '2024-06-19 00:03:25', 'El usuario Edouard inicio sesion'),
(75, 6, 'Pagos', 'Registrar', '2024-06-19 00:36:21', 'Pago Registrado'),
(76, 6, 'registrar_ventas', 'agregar', '2024-06-19 00:36:21', 'se agrego una venta'),
(78, 6, 'Login', 'logueado', '2024-06-20 17:20:47', 'El usuario Edouard inicio sesion'),
(79, 6, 'Pagos', 'Registrar', '2024-06-20 17:22:27', 'Pago Registrado'),
(80, 6, 'registrar_ventas', 'agregar', '2024-06-20 17:22:27', 'se agrego una venta'),
(81, 6, 'Pagos', 'Registrar', '2024-06-20 17:24:43', 'Pago Registrado'),
(82, 6, 'registrar_ventas', 'agregar', '2024-06-20 17:24:43', 'se agrego una venta'),
(83, 6, 'Pagos', 'Registrar', '2024-06-20 17:26:14', 'Pago Registrado'),
(84, 6, 'registrar_ventas', 'agregar', '2024-06-20 17:26:14', 'se agrego una venta'),
(85, 6, 'Pagos', 'Registrar', '2024-06-20 17:28:16', 'Pago Registrado'),
(86, 6, 'registrar_ventas', 'agregar', '2024-06-20 17:28:16', 'se agrego una venta'),
(87, 6, 'Pagos', 'Registrar', '2024-06-20 17:29:35', 'Pago Registrado'),
(88, 6, 'registrar_ventas', 'agregar', '2024-06-20 17:29:35', 'se agrego una venta'),
(89, 6, 'Pagos', 'Registrar', '2024-06-20 17:30:28', 'Pago Registrado'),
(90, 6, 'registrar_ventas', 'agregar', '2024-06-20 17:30:28', 'se agrego una venta'),
(91, 6, 'Pagos', 'Registrar', '2024-06-20 17:31:25', 'Pago Registrado'),
(92, 6, 'registrar_ventas', 'agregar', '2024-06-20 17:31:25', 'se agrego una venta');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caja`
--

CREATE TABLE `caja` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `monto_inicial` varchar(45) NOT NULL,
  `monto_final` varchar(45) NOT NULL,
  `fecha` datetime NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `caja`
--

INSERT INTO `caja` (`id`, `id_usuario`, `monto_inicial`, `monto_final`, `fecha`, `status`) VALUES
(1, 6, '100', '', '2024-06-20 23:23:53', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id`, `nombre`) VALUES
(1, 'bebida'),
(2, 'empaquetados');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(500) NOT NULL,
  `cedula` varchar(45) NOT NULL,
  `apellido` varchar(45) NOT NULL,
  `documento` varchar(1) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `active` tinyint(4) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `nombre`, `cedula`, `apellido`, `documento`, `direccion`, `telefono`, `active`) VALUES
(12, 'Alejandro', '30087582', 'Vargas', 'V', 'Avenida 15, local numero5', '+584126742231', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracion`
--

CREATE TABLE `configuracion` (
  `id` int(11) NOT NULL,
  `monto_capital` varchar(45) NOT NULL,
  `monto_dolar_paralelo` varchar(45) NOT NULL,
  `monto_dolar_bcv` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `credito`
--

CREATE TABLE `credito` (
  `id` int(11) NOT NULL,
  `id_rv` int(11) NOT NULL,
  `fecha_limite` datetime NOT NULL,
  `monto_final` float NOT NULL,
  `status` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entradas`
--

CREATE TABLE `entradas` (
  `id` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `id_proveedor` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `fecha_compra` date NOT NULL,
  `fecha_vencimiento` date NOT NULL,
  `precio_compra` float NOT NULL,
  `existencia` int(11) NOT NULL DEFAULT 0,
  `active` tinyint(4) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `entradas`
--

INSERT INTO `entradas` (`id`, `id_producto`, `id_proveedor`, `cantidad`, `fecha_compra`, `fecha_vencimiento`, `precio_compra`, `existencia`, `active`) VALUES
(67, 31, 8, 5, '2024-05-27', '2024-06-29', 15, 0, 1),
(68, 32, 8, 2, '2024-05-27', '2024-06-29', 5, 0, 1),
(69, 33, 8, 5, '2024-05-27', '2024-07-06', 9, 0, 1),
(70, 31, 8, 5, '2024-05-26', '2024-07-06', 10, 5, 1),
(71, 34, 8, 5, '2024-05-26', '2024-07-27', 15, 5, 1),
(72, 31, 8, 215, '2024-06-06', '2024-07-05', 21, 202, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `id` int(11) NOT NULL,
  `id_registro_ventas` int(11) NOT NULL,
  `id_productos` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `coste_producto_total` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `factura`
--

INSERT INTO `factura` (`id`, `id_registro_ventas`, `id_productos`, `cantidad`, `coste_producto_total`) VALUES
(1, 59, 31, 2, 20.02),
(2, 60, 31, 1, 10.01),
(3, 61, 31, 1, 10.01),
(4, 62, 31, 1, 10.01),
(5, 63, 31, 1, 10.01),
(6, 64, 31, 1, 10.01),
(7, 65, 31, 1, 10.01),
(8, 66, 31, 2, 20.02);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marcas`
--

CREATE TABLE `marcas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
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
`id` int(11)
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
  `id` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `active` tinyint(4) NOT NULL
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
`id` int(11)
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
  `id` int(11) NOT NULL,
  `monto` int(11) NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos`
--

CREATE TABLE `pagos` (
  `id` int(11) NOT NULL,
  `id_venta` int(11) NOT NULL,
  `id_metodo_pago` int(11) NOT NULL,
  `monto` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pagos`
--

INSERT INTO `pagos` (`id`, `id_venta`, `id_metodo_pago`, `monto`) VALUES
(1, 59, 7, 23.22),
(2, 60, 7, 11.61),
(3, 61, 7, 11.61),
(4, 62, 7, 11.61),
(5, 63, 7, 11.61),
(6, 64, 7, 11.61),
(7, 65, 7, 11.61),
(8, 66, 7, 23.22);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `tabla` varchar(20) DEFAULT NULL,
  `permiso` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`id`, `id_usuario`, `tabla`, `permiso`) VALUES
(1, 6, 'productos', 'buscar'),
(2, 6, 'categorias', 'buscar'),
(3, 6, 'marcas', 'buscar'),
(4, 6, 'productos', 'modificar');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `id_unidad` int(11) NOT NULL,
  `id_marca` int(11) NOT NULL,
  `valor_unidad` float NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `imagen` varchar(500) NOT NULL DEFAULT 'banner_productos.png',
  `stock_min` int(11) NOT NULL,
  `stock_max` int(11) NOT NULL,
  `precio_venta` float NOT NULL DEFAULT 0,
  `IVA` tinyint(4) NOT NULL,
  `active` tinyint(4) DEFAULT 1,
  `ganancia` float NOT NULL,
  `codigo` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `id_categoria`, `id_unidad`, `id_marca`, `valor_unidad`, `nombre`, `imagen`, `stock_min`, `stock_max`, `precio_venta`, `IVA`, `active`, `ganancia`, `codigo`) VALUES
(1, 1, 1, 1, 150, 'pan', 'afafef', 5, 10, 15, 0, 1, 0, ''),
(31, 1, 2, 1, 1, 'Azucar', 'producto_Azucar_5e5294ee-d7d2-424d-ac2e-5802bbad41ab.jpeg', 5, 10, 10.01, 1, 1, 0, ''),
(32, 2, 2, 3, 1, 'Harina', 'producto_Harina_2551fe44-3bc1-476e-b084-e7ff84eb8600.jpeg', 10, 20, 10.01, 0, 1, 0, ''),
(33, 2, 2, 1, 1, 'Arroz', 'producto_Arroz_2c51307c-9d9f-41fb-9419-1e61a44891f0.jpeg', 5, 10, 15.01, 0, 1, 0, ''),
(34, 2, 2, 12, 1, 'Pasta', 'producto_Pasta_arroz.jpeg', 5, 20, 15, 0, 1, 0, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `razon_social` varchar(50) NOT NULL DEFAULT 'natural',
  `rif` varchar(15) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `direccion` varchar(45) NOT NULL,
  `active` tinyint(4) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

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
`id` int(11)
,`nombre` varchar(50)
,`ratio_ventas` decimal(37,4)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro_ventas`
--

CREATE TABLE `registro_ventas` (
  `id` int(11) NOT NULL,
  `monto_final` float NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  `id_cliente` int(11) NOT NULL,
  `id_caja` int(11) DEFAULT NULL,
  `IVA` float NOT NULL DEFAULT 0,
  `active` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `registro_ventas`
--

INSERT INTO `registro_ventas` (`id`, `monto_final`, `fecha`, `id_cliente`, `id_caja`, `IVA`, `active`) VALUES
(59, 23.22, '2024-06-19 00:36:21', 12, NULL, 3.2, 1),
(60, 11.61, '2024-06-20 17:22:27', 12, NULL, 1.6, 1),
(61, 11.61, '2024-06-20 17:24:43', 12, NULL, 1.6, 1),
(62, 11.61, '2024-06-20 17:26:14', 12, NULL, 1.6, 1),
(63, 11.61, '2024-06-20 17:28:16', 12, NULL, 1.6, 1),
(64, 11.61, '2024-06-20 17:29:35', 12, 1, 1.6, 1),
(65, 11.61, '2024-06-20 17:30:28', 12, 1, 1.6, 1),
(66, 23.22, '2024-06-20 17:31:25', 12, 1, 3.2, 1);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `total_productos_categoria`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `total_productos_categoria` (
`categoria` varchar(50)
,`total_productos` bigint(21)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `total_stock_categoria`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `total_stock_categoria` (
`id` int(11)
,`nombre` varchar(50)
,`total` decimal(54,0)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unidades`
--

CREATE TABLE `unidades` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

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
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `correo` varchar(45) NOT NULL,
  `hash` text NOT NULL,
  `rol` int(11) NOT NULL DEFAULT 3,
  `active` tinyint(4) NOT NULL DEFAULT 1,
  `semilla` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `correo`, `hash`, `rol`, `active`, `semilla`) VALUES
(5, 'asd', 'jaja@gmail.com', '$2y$10$fdgc0QZ4YyBMB3ix3jV5AOesVSZFCRrTZ.UUHr61qjviWGq7zi7h2', 1, 1, ''),
(6, 'Edouard', 'nose@gmail.com', '$2y$10$7L2.rmi.NOr9wz7vSo1SYu58aIcXZLOVZkfZ2sZPx1moc4vfMjQBW', 1, 1, ''),
(7, 'John', 'johnconnor@gmail.com', '$2y$10$EgZWh1WmrpMGrsF9K2DjyeL5YTds6aS3.Rku/.h8P7wk7ltODzf9e', 2, 1, ''),
(10, 'Alfredo', 'alfredo@gmail.com', '$2y$10$8nUZSX2kXCVysLvCLirVyuhfeUSB0uICkZsl3kiDJY4kqlZCI8DKu', 2, 1, ''),
(11, 'Pedro', 'garnicaluis391@gmail.com', '$2y$10$hK9fotzmkm/BvMtkUEiK0e8kdG/PtmF13R.Wpn.lIRWC29F1c1i3m', 1, 1, '');

-- --------------------------------------------------------

--
-- Estructura para la vista `max_ventas`
--
DROP TABLE IF EXISTS `max_ventas`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `max_ventas`  AS SELECT `p`.`id` AS `id`, `p`.`nombre` AS `nombre`, `p`.`valor_unidad` AS `unidad_valor`, (select `unidades`.`nombre` from `unidades` where `unidades`.`id` = `p`.`id_unidad`) AS `unidad`, (select `marcas`.`nombre` from `marcas` where `marcas`.`id` = `p`.`id_marca`) AS `marca`, (select sum(`f`.`cantidad`) from `factura` `f` where `f`.`id_productos` = `p`.`id`) AS `cantidad` FROM `productos` AS `p` WHERE `p`.`active` = 1 ORDER BY (select sum(`f`.`cantidad`) from `factura` `f` where `f`.`id_productos` = `p`.`id`) DESC ;

-- --------------------------------------------------------

--
-- Estructura para la vista `min_ventas`
--
DROP TABLE IF EXISTS `min_ventas`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `min_ventas`  AS SELECT `p`.`id` AS `id`, `p`.`nombre` AS `nombre`, `p`.`valor_unidad` AS `unidad_valor`, (select `unidades`.`nombre` from `unidades` where `unidades`.`id` = `p`.`id_unidad`) AS `unidad`, (select `marcas`.`nombre` from `marcas` where `marcas`.`id` = `p`.`id_marca`) AS `marca`, (select sum(`f`.`cantidad`) from `factura` `f` where `f`.`id_productos` = `p`.`id`) AS `cantidad` FROM `productos` AS `p` WHERE `p`.`active` = 1 ORDER BY (select sum(`f`.`cantidad`) from `factura` `f` where `f`.`id_productos` = `p`.`id`) ASC ;

-- --------------------------------------------------------

--
-- Estructura para la vista `ratio_ventas`
--
DROP TABLE IF EXISTS `ratio_ventas`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `ratio_ventas`  AS SELECT `p`.`id` AS `id`, `p`.`nombre` AS `nombre`, 1 - (select sum(`c`.`existencia`) from `entradas` `c` where `c`.`id_producto` = `p`.`id`) / (select sum(`a`.`cantidad`) from `entradas` `a` where `a`.`id_producto` = `p`.`id`) AS `ratio_ventas` FROM `productos` AS `p` WHERE `p`.`active` = 1 ;

-- --------------------------------------------------------

--
-- Estructura para la vista `total_productos_categoria`
--
DROP TABLE IF EXISTS `total_productos_categoria`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `total_productos_categoria`  AS SELECT `c`.`nombre` AS `categoria`, count(`p`.`id`) AS `total_productos` FROM (`categoria` `c` left join `productos` `p` on(`c`.`id` = `p`.`id_categoria`)) WHERE `p`.`active` = 1 GROUP BY `c`.`id`, `c`.`nombre` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `total_stock_categoria`
--
DROP TABLE IF EXISTS `total_stock_categoria`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `total_stock_categoria`  AS SELECT `c`.`id` AS `id`, `c`.`nombre` AS `nombre`, (select sum((select sum(`e`.`existencia`) from `entradas` `e` where `e`.`id_producto` = `p`.`id`)) from `productos` `p` where `p`.`id_categoria` = `c`.`id`) AS `total` FROM `categoria` AS `c` ;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT de la tabla `caja`
--
ALTER TABLE `caja`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `credito`
--
ALTER TABLE `credito`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `entradas`
--
ALTER TABLE `entradas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `marcas`
--
ALTER TABLE `marcas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `metodo_pago`
--
ALTER TABLE `metodo_pago`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `movimientos_capital`
--
ALTER TABLE `movimientos_capital`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pagos`
--
ALTER TABLE `pagos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `registro_ventas`
--
ALTER TABLE `registro_ventas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT de la tabla `unidades`
--
ALTER TABLE `unidades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `bitacora`
--
ALTER TABLE `bitacora`
  ADD CONSTRAINT `id_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `caja`
--
ALTER TABLE `caja`
  ADD CONSTRAINT `id_user` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `credito`
--
ALTER TABLE `credito`
  ADD CONSTRAINT `id_rv` FOREIGN KEY (`id_rv`) REFERENCES `registro_ventas` (`id`);

--
-- Filtros para la tabla `entradas`
--
ALTER TABLE `entradas`
  ADD CONSTRAINT `entradas_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id`),
  ADD CONSTRAINT `entradas_ibfk_2` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedores` (`id`);

--
-- Filtros para la tabla `factura`
--
ALTER TABLE `factura`
  ADD CONSTRAINT `fk_productos_has_registro_ventas_productos1` FOREIGN KEY (`id_productos`) REFERENCES `productos` (`id`),
  ADD CONSTRAINT `fk_productos_has_registro_ventas_registro_ventas1` FOREIGN KEY (`id_registro_ventas`) REFERENCES `registro_ventas` (`id`);

--
-- Filtros para la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD CONSTRAINT `id_metodo_pago` FOREIGN KEY (`id_metodo_pago`) REFERENCES `metodo_pago` (`id`),
  ADD CONSTRAINT `id_venta` FOREIGN KEY (`id_venta`) REFERENCES `registro_ventas` (`id`);

--
-- Filtros para la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD CONSTRAINT `id_usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `id_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id`),
  ADD CONSTRAINT `id_marca` FOREIGN KEY (`id_marca`) REFERENCES `marcas` (`id`),
  ADD CONSTRAINT `id_unidad` FOREIGN KEY (`id_unidad`) REFERENCES `unidades` (`id`);

--
-- Filtros para la tabla `registro_ventas`
--
ALTER TABLE `registro_ventas`
  ADD CONSTRAINT `id_caja` FOREIGN KEY (`id_caja`) REFERENCES `caja` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_cliente` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
