-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-10-2023 a las 16:07:35
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
  `nombre` varchar(500) NOT NULL,
  `descripcion` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id`, `nombre`, `descripcion`) VALUES(1, 'comida', 'Cosas que se comen :V');
INSERT INTO `categoria` (`id`, `nombre`, `descripcion`) VALUES(2, 'limpieza', 'sin comentarios');
INSERT INTO `categoria` (`id`, `nombre`, `descripcion`) VALUES(3, 'charcuteria', 'los restos de los animales D:');
INSERT INTO `categoria` (`id`, `nombre`, `descripcion`) VALUES(100, 'otros', 'Cosas variadas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `Nombre` varchar(500) NOT NULL,
  `Cedula` varchar(45) NOT NULL,
  `Apellido` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `id_registro_ventas` int(11) NOT NULL,
  `id_productos` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `coste_producto_total` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lotes`
--

CREATE TABLE `lotes` (
  `id` int(11) NOT NULL,
  `id_producto` int(20) NOT NULL,
  `id_proveedor` int(20) NOT NULL,
  ` cantidad` int(11) NOT NULL,
  `fecha_compra` date NOT NULL,
  `fecha_vencimiento` date NOT NULL,
  `precio_compra` float NOT NULL,
  `restante` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `lotes`
--

INSERT INTO `lotes` (`id`, `id_producto`, `id_proveedor`, ` cantidad`, `fecha_compra`, `fecha_vencimiento`, `precio_compra`, `restante`) VALUES(3, 4, 4, 50, '2023-10-01', '2023-10-31', 0, 50);
INSERT INTO `lotes` (`id`, `id_producto`, `id_proveedor`, ` cantidad`, `fecha_compra`, `fecha_vencimiento`, `precio_compra`, `restante`) VALUES(4, 4, 4, 50, '2023-10-01', '2023-10-31', 0, 50);
INSERT INTO `lotes` (`id`, `id_producto`, `id_proveedor`, ` cantidad`, `fecha_compra`, `fecha_vencimiento`, `precio_compra`, `restante`) VALUES(5, 1, 4, 1, '2023-10-03', '2023-10-26', 12, 1);
INSERT INTO `lotes` (`id`, `id_producto`, `id_proveedor`, ` cantidad`, `fecha_compra`, `fecha_vencimiento`, `precio_compra`, `restante`) VALUES(6, 1, 4, 1, '2023-09-25', '2023-10-28', 12, 1);
INSERT INTO `lotes` (`id`, `id_producto`, `id_proveedor`, ` cantidad`, `fecha_compra`, `fecha_vencimiento`, `precio_compra`, `restante`) VALUES(7, 1, 4, 1, '2023-09-27', '2023-10-28', 12, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `id_unidad` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `imagen` varchar(500) NOT NULL DEFAULT 'banner_productos.png',
  `stock_min` int(11) NOT NULL,
  `stock_max` int(11) NOT NULL,
  `precio_venta` float NOT NULL DEFAULT 0,
  `IVA` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `id_categoria`, `id_unidad`, `nombre`, `descripcion`, `imagen`, `stock_min`, `stock_max`, `precio_venta`, `IVA`) VALUES(1, 1, 1, 'sert', 'asdasd', 'banner_productos.png', 1, 12, 0, 0);
INSERT INTO `productos` (`id`, `id_categoria`, `id_unidad`, `nombre`, `descripcion`, `imagen`, `stock_min`, `stock_max`, `precio_venta`, `IVA`) VALUES(2, 1, 1, 'asd', 'asdasd', 'banner_productos.png', 2, 23, 0, 0);
INSERT INTO `productos` (`id`, `id_categoria`, `id_unidad`, `nombre`, `descripcion`, `imagen`, `stock_min`, `stock_max`, `precio_venta`, `IVA`) VALUES(3, 1, 1, 'Pan', 'Es pan y tiene queso', 'banner_productos.png', 1, 20, 0, 0);
INSERT INTO `productos` (`id`, `id_categoria`, `id_unidad`, `nombre`, `descripcion`, `imagen`, `stock_min`, `stock_max`, `precio_venta`, `IVA`) VALUES(4, 1, 1, 'Harina', 'La original', 'banner_productos.png', 10, 20, 0, 1);
INSERT INTO `productos` (`id`, `id_categoria`, `id_unidad`, `nombre`, `descripcion`, `imagen`, `stock_min`, `stock_max`, `precio_venta`, `IVA`) VALUES(10, 2, 1, 'asda', 'haaaaa', 'opensource.jpg', 1, 7, 0, 0);
INSERT INTO `productos` (`id`, `id_categoria`, `id_unidad`, `nombre`, `descripcion`, `imagen`, `stock_min`, `stock_max`, `precio_venta`, `IVA`) VALUES(15, 100, 3, 'Awesome face', 'Epico', 'índice1.png', 0, 1, 0, 0);
INSERT INTO `productos` (`id`, `id_categoria`, `id_unidad`, `nombre`, `descripcion`, `imagen`, `stock_min`, `stock_max`, `precio_venta`, `IVA`) VALUES(16, 1, 3, 'logo', 'empresas random', 'WhatsApp Image 2023-06-21 at 18.32.58.jpeg', 1, 6, 0, 0);
INSERT INTO `productos` (`id`, `id_categoria`, `id_unidad`, `nombre`, `descripcion`, `imagen`, `stock_min`, `stock_max`, `precio_venta`, `IVA`) VALUES(23, 1, 1, 'wrwer', 'w', 'producto_wrwer_Codigo ASCII.png', 1, 1, 0, 0);
INSERT INTO `productos` (`id`, `id_categoria`, `id_unidad`, `nombre`, `descripcion`, `imagen`, `stock_min`, `stock_max`, `precio_venta`, `IVA`) VALUES(25, 1, 3, 'ff', 'asas', 'producto_ff_Codigo ASCII.png', 1, 1, 0, 0);
INSERT INTO `productos` (`id`, `id_categoria`, `id_unidad`, `nombre`, `descripcion`, `imagen`, `stock_min`, `stock_max`, `precio_venta`, `IVA`) VALUES(30, 1, 1, '111qweerwer', '', '../../Media/imagenes/banner_productos.png', 1, 5, 0, 0);
INSERT INTO `productos` (`id`, `id_categoria`, `id_unidad`, `nombre`, `descripcion`, `imagen`, `stock_min`, `stock_max`, `precio_venta`, `IVA`) VALUES(33, 1, 1, 'yanise', 'asdasdasd', 'banner_productos.png', 223, 2424, 5, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `razon_social` varchar(50) NOT NULL DEFAULT 'natural',
  `rif` varchar(15) NOT NULL,
  `telefono` int(11) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `direccion` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`id`, `nombre`, `razon_social`, `rif`, `telefono`, `correo`, `direccion`) VALUES(4, 'PolarC.A', 'nn', 'j-00000000', 1231231231, 'nose@gmail.com', 'Ahora si tiene');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro_ventas`
--

CREATE TABLE `registro_ventas` (
  `id` int(11) NOT NULL,
  `monto_final` float NOT NULL,
  `metodo de pago` varchar(50) NOT NULL,
  `fecha` date NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

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

INSERT INTO `unidades` (`id`, `nombre`) VALUES(1, 'kilogramos');
INSERT INTO `unidades` (`id`, `nombre`) VALUES(2, 'Litros');
INSERT INTO `unidades` (`id`, `nombre`) VALUES(3, 'unidades');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `correo` varchar(45) NOT NULL,
  `contraseña` varchar(45) NOT NULL,
  `rol` int(2) NOT NULL DEFAULT 3
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `correo`, `contraseña`, `rol`) VALUES(1, 'Edouard', 'nose@gmail.com', '123', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD UNIQUE KEY `registro_ventas_id_UNIQUE` (`id_registro_ventas`),
  ADD KEY `fk_productos_has_registro_ventas_registro_ventas1_idx` (`id_registro_ventas`),
  ADD KEY `fk_productos_has_registro_ventas_productos1_idx` (`id_productos`);

--
-- Indices de la tabla `lotes`
--
ALTER TABLE `lotes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_producto` (`id_producto`),
  ADD KEY `id_proveedor` (`id_proveedor`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `lotes`
--
ALTER TABLE `lotes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `registro_ventas`
--
ALTER TABLE `registro_ventas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `unidades`
--
ALTER TABLE `unidades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `factura`
--
ALTER TABLE `factura`
  ADD CONSTRAINT `fk_productos_has_registro_ventas_productos1` FOREIGN KEY (`id_productos`) REFERENCES `productos` (`id`),
  ADD CONSTRAINT `fk_productos_has_registro_ventas_registro_ventas1` FOREIGN KEY (`id_registro_ventas`) REFERENCES `registro_ventas` (`id`);

--
-- Filtros para la tabla `lotes`
--
ALTER TABLE `lotes`
  ADD CONSTRAINT `lotes_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id`),
  ADD CONSTRAINT `lotes_ibfk_2` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedores` (`id`);

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
-- Metadatos para la tabla factura
--

--
-- Metadatos para la tabla lotes
--

--
-- Volcado de datos para la tabla `pma__table_uiprefs`
--

INSERT INTO `pma__table_uiprefs` (`username`, `db_name`, `table_name`, `prefs`, `last_update`) VALUES('root', 'proyecto', 'lotes', '{\"sorted_col\":\"`fecha_vencimiento` DESC\"}', '2023-10-16 22:07:59');

--
-- Metadatos para la tabla productos
--

--
-- Volcado de datos para la tabla `pma__table_uiprefs`
--

INSERT INTO `pma__table_uiprefs` (`username`, `db_name`, `table_name`, `prefs`, `last_update`) VALUES('root', 'proyecto', 'productos', '[]', '2023-10-06 18:13:37');

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

INSERT INTO `pma__pdf_pages` (`db_name`, `page_descr`) VALUES('proyecto', 'que se vea');

SET @LAST_PAGE = LAST_INSERT_ID();

--
-- Volcado de datos para la tabla `pma__table_coords`
--

INSERT INTO `pma__table_coords` (`db_name`, `table_name`, `pdf_page_number`, `x`, `y`) VALUES('proyecto', 'categoria', @LAST_PAGE, 61, 345);
INSERT INTO `pma__table_coords` (`db_name`, `table_name`, `pdf_page_number`, `x`, `y`) VALUES('proyecto', 'clientes', @LAST_PAGE, 545, 277);
INSERT INTO `pma__table_coords` (`db_name`, `table_name`, `pdf_page_number`, `x`, `y`) VALUES('proyecto', 'factura', @LAST_PAGE, 305, 405);
INSERT INTO `pma__table_coords` (`db_name`, `table_name`, `pdf_page_number`, `x`, `y`) VALUES('proyecto', 'lotes', @LAST_PAGE, 300, 9);
INSERT INTO `pma__table_coords` (`db_name`, `table_name`, `pdf_page_number`, `x`, `y`) VALUES('proyecto', 'productos', @LAST_PAGE, 64, 13);
INSERT INTO `pma__table_coords` (`db_name`, `table_name`, `pdf_page_number`, `x`, `y`) VALUES('proyecto', 'proveedores', @LAST_PAGE, 556, 55);
INSERT INTO `pma__table_coords` (`db_name`, `table_name`, `pdf_page_number`, `x`, `y`) VALUES('proyecto', 'registro_ventas', @LAST_PAGE, 292, 235);
INSERT INTO `pma__table_coords` (`db_name`, `table_name`, `pdf_page_number`, `x`, `y`) VALUES('proyecto', 'unidades', @LAST_PAGE, 65, 264);
INSERT INTO `pma__table_coords` (`db_name`, `table_name`, `pdf_page_number`, `x`, `y`) VALUES('proyecto', 'usuarios', @LAST_PAGE, 543, 395);

--
-- Volcado de datos para la tabla `pma__central_columns`
--

INSERT INTO `pma__central_columns` (`db_name`, `col_name`, `col_type`, `col_length`, `col_collation`, `col_isNull`, `col_extra`, `col_default`) VALUES('proyecto', 'nombre', 'varchar', '50', 'utf8_general_ci', 0, ',', '');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
