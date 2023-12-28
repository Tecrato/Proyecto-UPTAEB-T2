-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-12-2023 a las 04:08:16
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

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

INSERT INTO `categoria` (`id`, `nombre`, `descripcion`) VALUES(1, 'bebida', NULL);
INSERT INTO `categoria` (`id`, `nombre`, `descripcion`) VALUES(2, 'empaquetados', NULL);

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
  `telefono` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `nombre`, `cedula`, `apellido`, `documento`, `direccion`, `telefono`) VALUES(1, 'erfulano', '16498357', 'detal', 'V', 'En su casa, nose', '04122943118');
INSERT INTO `clientes` (`id`, `nombre`, `cedula`, `apellido`, `documento`, `direccion`, `telefono`) VALUES(4, '111qwe', '123q', 'V', '3', '23423', '1231231231');

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
  `existencia` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `entradas`
--

INSERT INTO `entradas` (`id`, `id_producto`, `id_proveedor`, `cantidad`, `fecha_compra`, `fecha_vencimiento`, `precio_compra`, `existencia`) VALUES(1, 1, 1, 1, '2023-11-03', '2023-11-17', 12, 0);
INSERT INTO `entradas` (`id`, `id_producto`, `id_proveedor`, `cantidad`, `fecha_compra`, `fecha_vencimiento`, `precio_compra`, `existencia`) VALUES(2, 1, 1, 667, '2023-11-22', '2023-11-18', 45, 599);
INSERT INTO `entradas` (`id`, `id_producto`, `id_proveedor`, `cantidad`, `fecha_compra`, `fecha_vencimiento`, `precio_compra`, `existencia`) VALUES(5, 1, 1, 2, '2023-11-29', '2023-12-16', 12, 2);
INSERT INTO `entradas` (`id`, `id_producto`, `id_proveedor`, `cantidad`, `fecha_compra`, `fecha_vencimiento`, `precio_compra`, `existencia`) VALUES(6, 5, 1, 232, '2023-12-07', '2023-12-30', 2, 232);

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

INSERT INTO `factura` (`id`, `id_registro_ventas`, `id_productos`, `cantidad`, `coste_producto_total`) VALUES(1, 8, 1, 20, 4680);
INSERT INTO `factura` (`id`, `id_registro_ventas`, `id_productos`, `cantidad`, `coste_producto_total`) VALUES(2, 9, 1, 6, 1404);
INSERT INTO `factura` (`id`, `id_registro_ventas`, `id_productos`, `cantidad`, `coste_producto_total`) VALUES(3, 16, 1, 1, 234);
INSERT INTO `factura` (`id`, `id_registro_ventas`, `id_productos`, `cantidad`, `coste_producto_total`) VALUES(4, 17, 1, 1, 234);

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
  `IVA` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `id_categoria`, `id_unidad`, `nombre`, `marca`, `imagen`, `stock_min`, `stock_max`, `precio_venta`, `IVA`) VALUES(1, 1, 1, 'Harina', 'Arepasss', 'banner_productos.png', 1, 12, 234, 1);
INSERT INTO `productos` (`id`, `id_categoria`, `id_unidad`, `nombre`, `marca`, `imagen`, `stock_min`, `stock_max`, `precio_venta`, `IVA`) VALUES(5, 1, 1, '12', '1', 'banner_productos.png', 1, 12, 5, 0);

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
  `direccion` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`id`, `nombre`, `razon_social`, `rif`, `telefono`, `correo`, `direccion`) VALUES(1, 'tyrty', 'nn', 'j-00000000', '1231231231', 'nose@gmail.com', '54764576');

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
  `id_usuario` int(11) NOT NULL,
  `IVA` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `registro_ventas`
--

INSERT INTO `registro_ventas` (`id`, `monto_final`, `metodo_pago`, `fecha`, `id_cliente`, `id_usuario`, `IVA`) VALUES(3, 3257.28, 'Transferencia', '2023-11-02 16:51:59', 1, 1, 449);
INSERT INTO `registro_ventas` (`id`, `monto_final`, `metodo_pago`, `fecha`, `id_cliente`, `id_usuario`, `IVA`) VALUES(4, 3257.28, 'Pago Movil', '2023-11-02 16:52:45', 1, 1, 449);
INSERT INTO `registro_ventas` (`id`, `monto_final`, `metodo_pago`, `fecha`, `id_cliente`, `id_usuario`, `IVA`) VALUES(5, 3257.28, 'Punto de Venta', '2023-11-02 16:53:47', 1, 1, 449);
INSERT INTO `registro_ventas` (`id`, `monto_final`, `metodo_pago`, `fecha`, `id_cliente`, `id_usuario`, `IVA`) VALUES(6, 5428.8, 'Efectivo', '2023-11-02 16:54:36', 1, 1, 749);
INSERT INTO `registro_ventas` (`id`, `monto_final`, `metodo_pago`, `fecha`, `id_cliente`, `id_usuario`, `IVA`) VALUES(7, 5428.8, 'Pago Movil', '2023-11-02 16:55:31', 1, 1, 749);
INSERT INTO `registro_ventas` (`id`, `monto_final`, `metodo_pago`, `fecha`, `id_cliente`, `id_usuario`, `IVA`) VALUES(8, 5428.8, 'Transferencia', '2023-11-02 16:57:13', 1, 1, 749);
INSERT INTO `registro_ventas` (`id`, `monto_final`, `metodo_pago`, `fecha`, `id_cliente`, `id_usuario`, `IVA`) VALUES(9, 1628.64, 'Pago Movil', '2023-11-02 22:20:56', 1, 1, 225);
INSERT INTO `registro_ventas` (`id`, `monto_final`, `metodo_pago`, `fecha`, `id_cliente`, `id_usuario`, `IVA`) VALUES(10, 271.44, 'Punto de Venta', '2023-11-02 23:59:42', 1, 1, 37);
INSERT INTO `registro_ventas` (`id`, `monto_final`, `metodo_pago`, `fecha`, `id_cliente`, `id_usuario`, `IVA`) VALUES(11, 271.44, 'Transferencia', '2023-11-03 00:00:35', 1, 1, 37);
INSERT INTO `registro_ventas` (`id`, `monto_final`, `metodo_pago`, `fecha`, `id_cliente`, `id_usuario`, `IVA`) VALUES(12, 271.44, 'Punto de Venta', '2023-11-03 00:01:41', 1, 1, 37);
INSERT INTO `registro_ventas` (`id`, `monto_final`, `metodo_pago`, `fecha`, `id_cliente`, `id_usuario`, `IVA`) VALUES(13, 271.44, 'Transferencia', '2023-11-03 00:02:17', 1, 1, 37);
INSERT INTO `registro_ventas` (`id`, `monto_final`, `metodo_pago`, `fecha`, `id_cliente`, `id_usuario`, `IVA`) VALUES(14, 271.44, 'Punto de Venta', '2023-11-03 00:03:01', 1, 1, 37);
INSERT INTO `registro_ventas` (`id`, `monto_final`, `metodo_pago`, `fecha`, `id_cliente`, `id_usuario`, `IVA`) VALUES(15, 271.44, 'Transferencia', '2023-11-03 00:03:34', 1, 1, 37);
INSERT INTO `registro_ventas` (`id`, `monto_final`, `metodo_pago`, `fecha`, `id_cliente`, `id_usuario`, `IVA`) VALUES(16, 271.44, 'Transferencia', '2023-11-03 00:06:15', 1, 1, 37);
INSERT INTO `registro_ventas` (`id`, `monto_final`, `metodo_pago`, `fecha`, `id_cliente`, `id_usuario`, `IVA`) VALUES(17, 271.44, 'Transferencia', '2023-11-03 00:07:31', 1, 1, 37);

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

INSERT INTO `unidades` (`id`, `nombre`) VALUES(1, 'g');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `correo` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `rol` int(11) NOT NULL DEFAULT 3
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `correo`, `password`, `rol`) VALUES(1, 'Edouard', 'nose@gmail.com', '12345', 1);
INSERT INTO `usuarios` (`id`, `nombre`, `correo`, `password`, `rol`) VALUES(2, 'nose', 'pinchos792003@gmail.com', 'asd', 3);

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
  ADD UNIQUE KEY `registro_ventas_id_UNIQUE` (`id_registro_ventas`),
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `entradas`
--
ALTER TABLE `entradas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `registro_ventas`
--
ALTER TABLE `registro_ventas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `unidades`
--
ALTER TABLE `unidades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  ADD CONSTRAINT `id_cliente` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id`),
  ADD CONSTRAINT `id_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`);


--
-- Metadatos
--
USE `phpmyadmin`;

--
-- Metadatos para la tabla categoria
--

--
-- Metadatos para la tabla clientes
--

--
-- Metadatos para la tabla entradas
--

--
-- Metadatos para la tabla factura
--

--
-- Metadatos para la tabla productos
--

--
-- Metadatos para la tabla proveedores
--

--
-- Metadatos para la tabla registro_ventas
--

--
-- Metadatos para la tabla unidades
--

--
-- Metadatos para la tabla usuarios
--

--
-- Metadatos para la base de datos proyecto
--

--
-- Volcado de datos para la tabla `pma__pdf_pages`
--

INSERT INTO `pma__pdf_pages` (`db_name`, `page_descr`) VALUES('proyecto', 'proyecto');

SET @LAST_PAGE = LAST_INSERT_ID();

--
-- Volcado de datos para la tabla `pma__table_coords`
--

INSERT INTO `pma__table_coords` (`db_name`, `table_name`, `pdf_page_number`, `x`, `y`) VALUES('proyecto', 'categoria', @LAST_PAGE, 97, 436);
INSERT INTO `pma__table_coords` (`db_name`, `table_name`, `pdf_page_number`, `x`, `y`) VALUES('proyecto', 'clientes', @LAST_PAGE, 734, 236);
INSERT INTO `pma__table_coords` (`db_name`, `table_name`, `pdf_page_number`, `x`, `y`) VALUES('proyecto', 'factura', @LAST_PAGE, 302, 315);
INSERT INTO `pma__table_coords` (`db_name`, `table_name`, `pdf_page_number`, `x`, `y`) VALUES('proyecto', 'productos', @LAST_PAGE, 98, 173);
INSERT INTO `pma__table_coords` (`db_name`, `table_name`, `pdf_page_number`, `x`, `y`) VALUES('proyecto', 'proveedores', @LAST_PAGE, 506, 99);
INSERT INTO `pma__table_coords` (`db_name`, `table_name`, `pdf_page_number`, `x`, `y`) VALUES('proyecto', 'registro_ventas', @LAST_PAGE, 509, 319);
INSERT INTO `pma__table_coords` (`db_name`, `table_name`, `pdf_page_number`, `x`, `y`) VALUES('proyecto', 'unidades', @LAST_PAGE, 101, 99);
INSERT INTO `pma__table_coords` (`db_name`, `table_name`, `pdf_page_number`, `x`, `y`) VALUES('proyecto', 'usuarios', @LAST_PAGE, 737, 427);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
