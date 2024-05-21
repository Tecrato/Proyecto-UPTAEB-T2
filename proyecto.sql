-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-05-2024 a las 22:45:29
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
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id`, `nombre`, `descripcion`) VALUES
(1, 'bebida', NULL),
(2, 'empaquetados', NULL);

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
(1, 'Luis', '12345', 'Vargas', 'V', 'frente a mi casa', '0000000', 0),
(6, 'Jose', '25698863', 'Perez', 'V', 'Direccion tal', '04126742231', 1);

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
(1, 1, 7, 10, '2023-12-31', '2024-01-27', 20, 0, 1),
(2, 17, 7, 10, '2023-12-31', '2024-02-10', 20, 0, 1),
(3, 17, 1, 10, '2023-12-31', '2024-02-10', 25, 0, 1),
(4, 19, 7, 25, '2023-12-31', '2024-02-10', 10, 8, 1),
(5, 19, 7, 10, '2023-12-31', '2024-02-10', 26, 10, 1),
(6, 16, 7, 8, '2024-01-02', '2024-02-10', 20, 8, 1),
(7, 21, 7, 88, '2023-12-31', '2024-02-10', 20, 88, 1);

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
(1, 38, 1, 1, 20),
(2, 39, 1, 5, 100),
(3, 40, 1, 2, 40),
(5, 41, 1, 2, 40),
(6, 42, 17, 2, 20),
(8, 43, 17, 2, 20),
(10, 44, 19, 5, 50),
(11, 44, 17, 1, 10),
(12, 45, 19, 5, 50),
(13, 46, 17, 2, 20),
(14, 46, 19, 5, 50),
(15, 47, 17, 1, 10),
(16, 47, 19, 2, 20),
(17, 48, 17, 12, 120);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `id_unidad` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `marca` varchar(100) NOT NULL,
  `imagen` varchar(500) NOT NULL DEFAULT 'banner_productos.png',
  `stock_min` int(11) NOT NULL,
  `stock_max` int(11) NOT NULL,
  `precio_venta` float NOT NULL DEFAULT 0,
  `IVA` tinyint(4) NOT NULL,
  `active` tinyint(4) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `id_categoria`, `id_unidad`, `nombre`, `marca`, `imagen`, `stock_min`, `stock_max`, `precio_venta`, `IVA`, `active`) VALUES
(1, 1, 1, 'harina pan', 'pan', 'banner_productos.png', 10, 20, 20, 0, 1),
(16, 2, 1, 'Azucar', 'Azucar refinada blanca 500g', 'producto_Azucar_5e5294ee-d7d2-424d-ac2e-5802bbad41ab.jpeg', 5, 15, 10, 0, 0),
(17, 1, 1, 'Azu', 'marquita', 'banner_productos.png', 5, 15, 10, 0, 1),
(18, 2, 1, 'Pan', 'Polar', 'producto_Pan_7b37d828-2d86-40c5-b54a-9424c5dcc288.jpeg', 5, 15, 10, 0, 0),
(19, 1, 1, 'Panpapa', 'mary', 'banner_productos.png', 5, 15, 10, 0, 1),
(20, 1, 1, 'Jose', 'ujh', 'producto_Jose_2551fe44-3bc1-476e-b084-e7ff84eb8600.jpeg', 4, 4567, 56, 0, 0),
(21, 2, 1, 'Corto', 'ujh', 'producto_Corto_2551fe44-3bc1-476e-b084-e7ff84eb8600.jpeg', 4, 4567, 56, 0, 1),
(22, 2, 1, 'Abduzcan', 'ujh', 'producto_Abduzcan_5e5294ee-d7d2-424d-ac2e-5802bbad41ab.jpeg', 4, 4567, 56, 0, 1),
(23, 2, 1, 'Arroz', 'BLUE', 'producto_Arroz_5ce0e0f8-46df-4654-b37b-7d7f40d9bc6a.jpeg', 5, 15, 20, 1, 0),
(24, 1, 1, 'hola', 'ujh', 'producto_hola_5ce0e0f8-46df-4654-b37b-7d7f40d9bc6a.jpeg', 4, 4567, 56, 0, 0),
(29, 1, 1, 'queso', 'Churuguara', 'producto_queso_2c51307c-9d9f-41fb-9419-1e61a44891f0.jpeg', 5, 15, 20, 1, 1),
(30, 2, 1, 'doritos', 'mary', 'producto_doritos_bc7793c2-20fe-469c-b92c-7852f176f968.jpeg', 5, 15, 10, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `razon_social` varchar(50) NOT NULL DEFAULT 'natural',
  `rif` varchar(15) NOT NULL,
  `telefono` varchar(11) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `direccion` varchar(45) NOT NULL,
  `active` tinyint(4) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`id`, `nombre`, `razon_social`, `rif`, `telefono`, `correo`, `direccion`, `active`) VALUES
(1, 'tyrty', 'nn', 'j-00000000', '1231231231', 'nose@gmail.com', '54764576', 1),
(7, 'montecarmelo', 'Montecarmelo', 'j-00000000', '0000000', 'garnicaluis391@gmail.com', 'scacac', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro_ventas`
--

CREATE TABLE `registro_ventas` (
  `id` int(11) NOT NULL,
  `monto_final` float NOT NULL,
  `metodo_pago` varchar(50) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  `id_cliente` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `IVA` int(11) NOT NULL DEFAULT 0,
  `active` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `registro_ventas`
--

INSERT INTO `registro_ventas` (`id`, `monto_final`, `metodo_pago`, `fecha`, `id_cliente`, `id_usuario`, `IVA`, `active`) VALUES
(38, 20, 'Efectivo', '2024-01-27 09:08:56', 1, NULL, 0, 0),
(39, 100, 'Pago Movil', '2024-01-28 14:37:04', 1, NULL, 0, 1),
(40, 180, 'Punto de Venta', '2024-01-28 15:23:57', 1, NULL, 0, 1),
(41, 40, 'Pago Movil', '2024-01-28 15:30:30', 1, NULL, 0, 1),
(42, 40, 'Pago Movil', '2024-01-28 15:33:22', 1, NULL, 0, 1),
(43, 40, 'Pago Movil', '2024-01-28 15:35:02', 1, NULL, 0, 1),
(44, 60, 'Punto de Venta', '2024-01-28 15:38:11', 1, NULL, 0, 1),
(45, 50, 'Punto de Venta', '2024-01-28 18:41:00', 1, NULL, 0, 1),
(46, 70, 'Pago Movil', '2024-01-28 18:43:50', 6, NULL, 0, 1),
(47, 30, 'Punto de Venta', '2024-01-29 18:31:07', 1, NULL, 0, 0),
(48, 120, 'Punto de Venta', '2024-01-29 20:27:38', 6, NULL, 0, 1);

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
(1, 'g');

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
  `active` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `correo`, `hash`, `rol`, `active`) VALUES
(5, 'asd', 'jaja@gmail.com', '$2y$10$fdgc0QZ4YyBMB3ix3jV5AOesVSZFCRrTZ.UUHr61qjviWGq7zi7h2', 1, 1),
(6, 'Edouard', 'nose@gmail.com', '$2y$10$7L2.rmi.NOr9wz7vSo1SYu58aIcXZLOVZkfZ2sZPx1moc4vfMjQBW', 1, 1);

--
-- Índices para tablas volcadas
--

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
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`),
  ADD KEY `id_categoria_idx` (`id_categoria`),
  ADD KEY `id_stock_max_min_idx` (`id_unidad`);

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
  ADD KEY `id_usuario_idx` (`id_usuario`);

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
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `entradas`
--
ALTER TABLE `entradas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `registro_ventas`
--
ALTER TABLE `registro_ventas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT de la tabla `unidades`
--
ALTER TABLE `unidades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

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
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `id_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id`),
  ADD CONSTRAINT `id_stock_max_min` FOREIGN KEY (`id_unidad`) REFERENCES `unidades` (`id`);

--
-- Filtros para la tabla `registro_ventas`
--
ALTER TABLE `registro_ventas`
  ADD CONSTRAINT `aa` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `id_cliente` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
