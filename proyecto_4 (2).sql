-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-07-2024 a las 02:33:26
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
	UPDATE caja c SET c.monto_final=(asignar_total_ventas+c.monto_inicial), c.fecha_cierre = CURRENT_TIMESTAMP, c.estado = 1, c.total_ventas = (SELECT COUNT(rv2.id) FROM registro_ventas rv2 WHERE rv2.id_caja = c.id) WHERE c.id = id_caja AND c.estado = 0;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `check_and_notify` ()   BEGIN
    DECLARE done INT DEFAULT FALSE;
    DECLARE entrada_id INT;
    DECLARE entrada_fecha_venc DATE;
    DECLARE producto_nombre VARCHAR(255);
    DECLARE diff INT;
    DECLARE cur CURSOR FOR 
        SELECT e.id, e.fecha_vencimiento, p.nombre 
        FROM entradas e 
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
(227, 6, 'Login', 'logueado', '2024-06-24 14:29:24', 'El usuario Edouard inicio sesion'),
(228, 6, 'Login', 'logueado', '2024-06-27 16:54:07', 'El usuario Edouard inicio sesion'),
(229, 6, 'Pagos', 'Registrar', '2024-06-27 16:54:40', 'Pago Registrado'),
(230, 6, 'registrar_ventas', 'agregar', '2024-06-27 16:54:40', 'se agrego una venta'),
(231, 6, 'Caja', 'Abriendo', '2024-06-27 16:56:16', 'Caja abierta'),
(232, 6, 'Pagos', 'Registrar', '2024-06-27 16:56:39', 'Pago Registrado'),
(233, 6, 'registrar_ventas', 'agregar', '2024-06-27 16:56:39', 'se agrego una venta'),
(234, 6, 'Pagos', 'Registrar', '2024-06-27 16:57:15', 'Pago Registrado'),
(235, 6, 'registrar_ventas', 'agregar', '2024-06-27 16:57:15', 'se agrego una venta'),
(236, 6, 'Pagos', 'Registrar', '2024-06-27 17:09:21', 'Pago Registrado'),
(237, 6, 'registrar_ventas', 'agregar', '2024-06-27 17:09:21', 'se agrego una venta'),
(238, 6, 'Login', 'logueado', '2024-06-28 10:41:14', 'El usuario Edouard inicio sesion'),
(239, 6, 'Login', 'logueado', '2024-06-28 10:41:52', 'El usuario Edouard inicio sesion'),
(240, 6, 'deslogin', 'des-logueado', '2024-06-28 10:42:24', 'el usuario Edouard se des-logueo'),
(241, 6, 'Login', 'logueado', '2024-06-28 10:42:41', 'El usuario Edouard inicio sesion'),
(242, 13, 'Login', 'logueado', '2024-06-28 10:42:55', 'El usuario Vanessa inicio sesion'),
(243, 6, 'Caja', 'Abriendo', '2024-06-28 10:43:50', 'Caja abierta'),
(244, 13, 'Caja', 'Abriendo', '2024-06-28 10:43:53', 'Caja abierta'),
(245, 13, 'Pagos', 'Registrar', '2024-06-28 10:59:41', 'Pago Registrado'),
(246, 13, 'registrar_ventas', 'agregar', '2024-06-28 10:59:41', 'se agrego una venta'),
(247, 13, 'Pagos', 'Registrar', '2024-06-28 11:16:40', 'Pago Registrado'),
(248, 13, 'registrar_ventas', 'agregar', '2024-06-28 11:16:40', 'se agrego una venta'),
(249, 6, 'Pagos', 'Registrar', '2024-06-28 11:20:22', 'Pago Registrado'),
(250, 6, 'Pagos', 'Registrar', '2024-06-28 11:20:23', 'Pago Registrado'),
(251, 6, 'registrar_ventas', 'agregar', '2024-06-28 11:20:23', 'se agrego una venta'),
(252, 6, 'Login', 'logueado', '2024-06-28 11:28:30', 'El usuario Edouard inicio sesion'),
(253, 6, 'Caja', 'Abriendo', '2024-06-28 11:41:52', 'Caja abierta'),
(254, 6, 'Caja', 'Abriendo', '2024-06-28 11:57:58', 'Caja abierta'),
(255, 6, 'Login', 'logueado', '2024-06-28 15:08:19', 'El usuario Edouard inicio sesion'),
(256, 6, 'Permisos', 'Registrar', '2024-06-28 16:06:48', 'Permiso Registrado'),
(257, 6, 'Permisos', 'Registrar', '2024-06-28 16:06:49', 'Permiso Registrado'),
(258, 6, 'Permisos', 'Registrar', '2024-06-28 16:06:50', 'Permiso Registrado'),
(259, 6, 'deslogin', 'des-logueado', '2024-06-28 22:33:08', 'el usuario Edouard se des-logueo'),
(260, 6, 'Login', 'logueado', '2024-06-28 22:45:00', 'El usuario Edouard inicio sesion'),
(261, 6, 'Login', 'logueado', '2024-06-28 22:47:30', 'El usuario Edouard inicio sesion'),
(262, 6, 'Login', 'logueado', '2024-06-28 23:07:41', 'El usuario Edouard inicio sesion'),
(263, 6, 'Proveedores', 'Registrar', '2024-06-28 23:17:18', 'Proveedor Registrado'),
(264, 6, 'Cliente', 'Registrar', '2024-06-28 23:18:13', 'Cliente Registrado'),
(265, 6, 'deslogin', 'des-logueado', '2024-06-28 23:19:44', 'el usuario Edouard se des-logueo'),
(266, 6, 'Login', 'logueado', '2024-06-29 08:05:04', 'El usuario Edouard inicio sesion'),
(267, 6, 'Login', 'logueado', '2024-06-29 08:05:16', 'El usuario Edouard inicio sesion'),
(268, 6, 'Login', 'logueado', '2024-06-29 08:05:19', 'El usuario Edouard inicio sesion'),
(269, 6, 'Caja', 'Abriendo', '2024-06-29 08:06:55', 'Caja abierta'),
(270, 6, 'Caja', 'Abriendo', '2024-06-29 08:06:58', 'Caja abierta'),
(271, 6, 'Caja', 'Abriendo', '2024-06-29 08:08:36', 'Caja abierta'),
(272, 6, 'Caja', 'Abriendo', '2024-06-29 08:08:53', 'Caja abierta'),
(273, 6, 'Usuarios', 'Registrar', '2024-06-29 08:12:02', 'Usuario Registrado'),
(274, 6, 'Usuarios', 'Registrar', '2024-06-29 08:12:03', 'Usuario Registrado'),
(275, 6, 'Usuarios', 'Registrar', '2024-06-29 08:12:06', 'Usuario Registrado'),
(276, 6, 'deslogin', 'des-logueado', '2024-06-29 08:12:18', 'el usuario Edouard se des-logueo'),
(277, 6, 'deslogin', 'des-logueado', '2024-06-29 08:12:22', 'el usuario Edouard se des-logueo'),
(278, 6, 'Caja', 'Abriendo', '2024-06-29 08:13:52', 'Caja abierta'),
(279, 6, 'Caja', 'Abriendo', '2024-06-29 08:13:56', 'Caja abierta'),
(280, 6, 'Login', 'logueado', '2024-06-29 08:14:45', 'El usuario Edouard inicio sesion'),
(281, 6, 'Caja', 'Abriendo', '2024-06-29 08:21:47', 'Caja abierta'),
(282, 6, 'Pagos', 'Registrar', '2024-06-29 08:21:55', 'Pago Registrado'),
(283, 6, 'registrar_ventas', 'agregar', '2024-06-29 08:21:55', 'se agrego una venta'),
(284, 6, 'Login', 'logueado', '2024-06-29 08:23:19', 'El usuario Edouard inicio sesion'),
(285, 6, 'Login', 'logueado', '2024-06-29 08:23:47', 'El usuario Edouard inicio sesion'),
(286, 6, 'Caja', 'Abriendo', '2024-06-29 08:24:08', 'Caja abierta'),
(287, 6, 'Pagos', 'Registrar', '2024-06-29 08:24:08', 'Pago Registrado'),
(288, 6, 'registrar_ventas', 'agregar', '2024-06-29 08:24:09', 'se agrego una venta'),
(289, 6, 'Pagos', 'Registrar', '2024-06-29 08:24:09', 'Pago Registrado'),
(290, 6, 'registrar_ventas', 'agregar', '2024-06-29 08:24:09', 'se agrego una venta'),
(291, 6, 'Pagos', 'Registrar', '2024-06-29 08:24:09', 'Pago Registrado'),
(292, 6, 'registrar_ventas', 'agregar', '2024-06-29 08:24:09', 'se agrego una venta'),
(293, 6, 'Pagos', 'Registrar', '2024-06-29 08:24:10', 'Pago Registrado'),
(294, 6, 'registrar_ventas', 'agregar', '2024-06-29 08:24:10', 'se agrego una venta'),
(295, 6, 'registrar_ventas', 'agregar', '2024-06-29 08:26:44', 'se agrego una venta'),
(296, 6, 'deslogin', 'des-logueado', '2024-06-29 08:27:42', 'el usuario Edouard se des-logueo'),
(297, 13, 'Login', 'logueado', '2024-06-29 08:28:14', 'El usuario Vanessa inicio sesion'),
(298, 13, 'Caja', 'Abriendo', '2024-06-29 08:28:42', 'Caja abierta'),
(299, 6, 'registrar_ventas', 'agregar', '2024-06-29 08:29:48', 'se agrego una venta'),
(300, 13, 'registrar_ventas', 'agregar', '2024-06-29 08:29:48', 'se agrego una venta'),
(301, 13, 'deslogin', 'des-logueado', '2024-06-29 08:31:35', 'el usuario Vanessa se des-logueo'),
(302, 6, 'Login', 'logueado', '2024-06-29 08:32:32', 'El usuario Edouard inicio sesion'),
(303, 13, 'Login', 'logueado', '2024-06-29 09:38:50', 'El usuario Vanessa inicio sesion'),
(304, 6, 'Login', 'logueado', '2024-06-29 09:40:27', 'El usuario Edouard inicio sesion'),
(305, 6, 'Permisos', 'Registrar', '2024-06-29 09:53:12', 'Permiso Registrado'),
(306, 6, 'Permisos', 'Registrar', '2024-06-29 09:53:13', 'Permiso Registrado'),
(307, 6, 'Permisos', 'Registrar', '2024-06-29 09:53:13', 'Permiso Registrado'),
(308, 6, 'Permisos', 'Registrar', '2024-06-29 09:53:14', 'Permiso Registrado'),
(309, 6, 'Permisos', 'Registrar', '2024-06-29 09:53:16', 'Permiso Registrado'),
(310, 6, 'Permisos', 'Registrar', '2024-06-29 09:53:16', 'Permiso Registrado'),
(311, 6, 'Permisos', 'Registrar', '2024-06-29 09:53:17', 'Permiso Registrado'),
(312, 6, 'Permisos', 'Registrar', '2024-06-29 09:53:18', 'Permiso Registrado'),
(313, 6, 'Caja', 'Abriendo', '2024-06-29 10:06:38', 'Caja abierta'),
(314, 6, 'registrar_ventas', 'agregar', '2024-06-29 10:06:45', 'se agrego una venta'),
(315, 6, 'registrar_ventas', 'agregar', '2024-06-29 13:22:09', 'se agrego una venta'),
(316, 6, 'Login', 'logueado', '2024-06-30 09:38:14', 'El usuario Edouard inicio sesion'),
(317, 6, 'Caja', 'Abriendo', '2024-06-30 17:13:01', 'Caja abierta'),
(318, 6, 'registrar_ventas', 'agregar', '2024-06-30 17:13:43', 'se agrego una venta'),
(319, 6, 'Credito', 'Registrar', '2024-06-30 18:19:42', 'Credito Registrado'),
(320, 6, 'registrar_ventas', 'agregar', '2024-06-30 18:19:42', 'se agrego una venta'),
(321, 6, 'deslogin', 'des-logueado', '2024-06-30 19:30:45', 'el usuario Edouard se des-logueo'),
(322, 6, 'Login', 'logueado', '2024-06-30 19:51:24', 'El usuario Edouard inicio sesion'),
(323, 6, 'deslogin', 'des-logueado', '2024-06-30 19:51:49', 'el usuario Edouard se des-logueo'),
(324, 6, 'Login', 'logueado', '2024-07-04 09:56:53', 'El usuario Edouard inicio sesion'),
(325, 6, 'Login', 'logueado', '2024-07-06 10:19:25', 'El usuario Edouard inicio sesion'),
(326, 6, 'deslogin', 'des-logueado', '2024-07-06 11:18:05', 'el usuario Edouard se des-logueo'),
(327, 6, 'Login', 'logueado', '2024-07-06 11:19:00', 'El usuario Edouard inicio sesion'),
(328, 6, 'Login', 'logueado', '2024-07-06 11:31:51', 'El usuario Edouard inicio sesion'),
(329, 6, 'Login', 'logueado', '2024-07-07 12:08:04', 'El usuario Edouard inicio sesion'),
(330, 6, 'deslogin', 'des-logueado', '2024-07-07 12:10:01', 'el usuario Edouard se des-logueo'),
(342, 40, 'deslogin', 'des-logueado', '2024-07-07 13:02:49', 'el usuario Luis se des-logueo'),
(343, 6, 'Login', 'logueado', '2024-07-07 13:03:06', 'El usuario Edouard inicio sesion'),
(344, 6, 'Login', 'logueado', '2024-07-07 22:29:01', 'El usuario Edouard inicio sesion'),
(345, 6, 'Login', 'logueado', '2024-07-08 15:35:12', 'El usuario Edouard inicio sesion'),
(346, 6, 'Login', 'logueado', '2024-07-08 18:16:14', 'El usuario Edouard inicio sesion'),
(347, 6, 'movimientos_capital', 'Registrar', '2024-07-08 19:23:55', 'Capital Cambiado'),
(348, 6, 'movimientos_capital', 'Registrar', '2024-07-08 19:27:42', 'Capital Cambiado'),
(349, 6, 'movimientos_capital', 'Registrar', '2024-07-08 19:30:48', 'Capital Cambiado'),
(350, 6, 'movimientos_capital', 'Registrar', '2024-07-08 19:32:41', 'Capital Cambiado'),
(351, 6, 'movimientos_capital', 'Registrar', '2024-07-08 19:33:12', 'Capital Cambiado'),
(352, 6, 'movimientos_capital', 'Registrar', '2024-07-08 19:39:50', 'Capital Cambiado'),
(353, 6, 'movimientos_capital', 'Registrar', '2024-07-08 19:44:47', 'Capital Cambiado'),
(354, 6, 'movimientos_capital', 'Registrar', '2024-07-08 19:46:42', 'Capital Cambiado'),
(355, 6, 'movimientos_capital', 'Registrar', '2024-07-08 19:46:54', 'Capital Cambiado'),
(356, 6, 'deslogin', 'des-logueado', '2024-07-08 19:55:56', 'el usuario Edouard se des-logueo'),
(357, 6, 'Login', 'logueado', '2024-07-08 20:00:29', 'El usuario Edouard inicio sesion'),
(358, 6, 'deslogin', 'des-logueado', '2024-07-09 15:36:26', 'el usuario Edouard se des-logueo'),
(361, 6, 'Login', 'logueado', '2024-07-10 17:27:47', 'El usuario Edouard inicio sesion'),
(362, 6, 'Login', 'logueado', '2024-07-10 17:29:13', 'El usuario Edouard inicio sesion'),
(363, 6, 'Login', 'logueado', '2024-07-10 17:43:43', 'El usuario Edouard inicio sesion'),
(364, 6, 'deslogin', 'des-logueado', '2024-07-10 17:53:45', 'el usuario Edouard se des-logueo'),
(365, 6, 'Login', 'logueado', '2024-07-10 18:52:15', 'El usuario Edouard inicio sesion'),
(366, 6, 'deslogin', 'des-logueado', '2024-07-10 19:55:33', 'el usuario Edouard se des-logueo'),
(367, 6, 'deslogin', 'des-logueado', '2024-07-10 21:09:44', 'el usuario Edouard se des-logueo'),
(372, 48, 'Permisos', 'Registrar', '2024-07-11 00:55:24', 'Permiso Registrado'),
(373, 48, 'Permisos', 'Registrar', '2024-07-11 00:55:25', 'Permiso Registrado'),
(374, 48, 'Permisos', 'Registrar', '2024-07-11 00:55:27', 'Permiso Registrado'),
(375, 48, 'Proveedor', 'Modificar', '2024-07-11 00:56:08', 'Proveedor 16 Modificado'),
(376, 6, 'Login', 'logueado', '2024-07-11 01:17:31', 'El usuario Edouard inicio sesion'),
(377, 6, 'deslogin', 'des-logueado', '2024-07-11 01:22:20', 'el usuario Edouard se des-logueo'),
(378, 6, 'Login', 'logueado', '2024-07-11 01:24:56', 'El usuario Edouard inicio sesion'),
(379, 6, 'deslogin', 'des-logueado', '2024-07-11 01:31:18', 'el usuario Edouard se des-logueo'),
(380, 6, 'Login', 'logueado', '2024-07-11 01:42:10', 'El usuario Edouard inicio sesion'),
(381, 6, 'deslogin', 'des-logueado', '2024-07-11 01:57:31', 'el usuario Edouard se des-logueo'),
(382, 6, 'Login', 'logueado', '2024-07-11 02:05:34', 'El usuario Edouard inicio sesion'),
(383, 6, 'deslogin', 'des-logueado', '2024-07-11 02:08:51', 'el usuario Edouard se des-logueo'),
(384, 6, 'Login', 'logueado', '2024-07-12 14:42:04', 'El usuario Edouard inicio sesion'),
(385, 6, 'deslogin', 'des-logueado', '2024-07-12 14:42:29', 'el usuario Edouard se des-logueo'),
(386, 6, 'Login', 'logueado', '2024-07-12 14:42:53', 'El usuario Edouard inicio sesion'),
(387, 6, 'deslogin', 'des-logueado', '2024-07-12 18:20:36', 'el usuario Edouard se des-logueo'),
(388, 6, 'Login', 'logueado', '2024-07-12 19:06:11', 'El usuario Edouard inicio sesion');

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
(30, 6, 45, NULL, '2024-06-23 16:22:33', 1, '2024-06-23 16:23:05', 0, 0),
(31, 6, 5, '9.25', '2024-06-27 16:56:16', 1, '2024-06-27 16:56:53', 0, 1),
(32, 6, 1000, '45', '2024-06-28 10:43:50', 1, '2024-06-28 11:38:02', 0, 1),
(33, 13, 10, '61.75', '2024-06-28 10:43:53', 1, '2024-06-28 11:35:54', 0, 2),
(34, 6, 100, NULL, '2024-06-28 11:41:52', 1, '2024-06-28 11:41:58', 0, 0),
(35, 6, 45, NULL, '2024-06-28 11:57:58', 1, '2024-06-28 11:58:06', 0, 0),
(36, 6, 10, NULL, '2024-06-29 08:06:54', 1, '2024-06-29 08:07:10', 0, 0),
(37, 6, 1000000, NULL, '2024-06-29 08:06:58', 1, '2024-06-29 08:07:27', 0, 0),
(38, 6, 10, NULL, '2024-06-29 08:08:36', 1, '2024-06-29 08:10:22', 0, 0),
(39, 6, 0, NULL, '2024-06-29 08:08:53', 1, '2024-06-29 08:13:26', 0, 0),
(40, 6, 9, NULL, '2024-06-29 08:13:52', 1, '2024-06-29 08:14:03', 0, 0),
(41, 6, 9, NULL, '2024-06-29 08:13:56', 1, '2024-06-29 08:20:20', 0, 0),
(42, 6, 23456, '23464.699999809265', '2024-06-29 08:21:47', 1, '2024-06-29 08:22:06', 0, 1),
(43, 6, 0, '2651.760009765625', '2024-06-29 08:24:08', 1, '2024-06-29 10:05:50', 0, 6),
(44, 13, 35, '2471', '2024-06-29 08:28:42', 1, '2024-06-29 10:05:47', 0, 1),
(45, 6, 1000, '1075.8400039672852', '2024-06-29 10:06:37', 1, '2024-06-29 19:16:12', 0, 2),
(46, 6, 1000, '0', '2024-06-30 17:13:00', 0, NULL, 0, 0);

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
(12, 'Alejandro', '30087582', 'Vargas', 'V', 'Avenida 15, local numero5', '+584126742231', 1),
(13, 'Jose', '2912734', 'Lopez', 'V', 'Dirección x', '+584149680074', 1);

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
(3, 133, '2024-07-11 00:00:00', 0, 1);

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
(1, 2700, '2024-06-22 09:11:17');

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
(106, 39, 8, 5, '2024-06-24', '2024-07-04', 6.8, 0, 1),
(107, 31, 8, 5, '2024-06-24', '2024-07-02', 4.9, 0, 1),
(108, 32, 8, 4, '2024-06-24', '2024-08-30', 6, 0, 1),
(109, 36, 8, 1, '2024-06-24', '2024-07-04', 21, 0, 1),
(110, 36, 8, 8, '2024-06-28', '2024-07-06', 5, 0, 1),
(111, 31, 8, 10, '2024-06-29', '2024-07-18', 5, 0, 1),
(112, 36, 16, 15, '2024-06-29', '2024-06-29', 26, 15, 1),
(113, 31, 16, 16, '2024-06-29', '2024-06-29', 12, 0, 1),
(114, 31, 8, 50, '2024-06-29', '2024-07-27', 28, 10, 1),
(115, 33, 16, 10, '2024-06-29', '2024-07-01', 5, 10, 1),
(116, 33, 16, 10, '2024-06-29', '2024-07-01', 5, 10, 1),
(117, 1, 8, 1, '2024-06-29', '2024-07-30', 12, 0, 1),
(118, 35, 8, 0, '2024-06-29', '2025-02-05', 10, 0, 1),
(119, 36, 16, 20, '2024-07-10', '2024-08-31', 15, 20, 1);

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

--
-- Volcado de datos para la tabla `factura`
--

INSERT INTO `factura` (`id`, `id_registro_ventas`, `id_productos`, `cantidad`, `coste_producto_total`) VALUES
(50, 115, 31, 1, 7.35),
(51, 116, 32, 1, 9.25),
(52, 117, 31, 1, 7.35),
(53, 118, 31, 1, 7.35),
(54, 119, 32, 3, 27.75),
(55, 120, 39, 5, 34),
(56, 121, 36, 9, 45),
(57, 122, 31, 1, 7.5),
(58, 123, 31, 2, 15),
(59, 124, 31, 2, 15),
(60, 125, 31, 2, 15),
(61, 126, 31, 2, 15),
(62, 127, 31, 3, 126),
(63, 129, 31, 50, 2100),
(64, 129, 31, 50, 2100),
(65, 130, 31, 1, 42),
(66, 131, 1, 1, 27.118),
(67, 132, 31, 1, 42),
(68, 133, 31, 1, 42);

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
(20, -21, 'Egreso por nuevas entradas', '2024-06-24 00:27:12'),
(21, 9, 'Ingreso por facturacion', '2024-06-27 16:54:40'),
(22, 9, 'Ingreso por facturacion', '2024-06-27 16:56:39'),
(23, 9, 'Ingreso por facturacion', '2024-06-27 16:57:15'),
(24, 9, 'Ingreso por facturacion', '2024-06-27 17:09:21'),
(25, 28, 'Ingreso por facturacion', '2024-06-28 10:59:41'),
(26, 34, 'Ingreso por facturacion', '2024-06-28 11:16:40'),
(27, -40, 'Egreso por nuevas entradas', '2024-06-28 11:17:41'),
(28, 30, 'Ingreso por facturacion', '2024-06-28 11:20:22'),
(29, 15, 'Ingreso por facturacion', '2024-06-28 11:20:23'),
(30, -50, 'Egreso por nuevas entradas', '2024-06-28 23:11:35'),
(31, 9, 'Ingreso por facturacion', '2024-06-29 08:21:55'),
(32, 17, 'Ingreso por facturacion', '2024-06-29 08:24:08'),
(33, 17, 'Ingreso por facturacion', '2024-06-29 08:24:09'),
(34, 17, 'Ingreso por facturacion', '2024-06-29 08:24:09'),
(35, 17, 'Ingreso por facturacion', '2024-06-29 08:24:10'),
(36, -390, 'Egreso por nuevas entradas', '2024-06-29 08:25:35'),
(37, -192, 'Egreso por nuevas entradas', '2024-06-29 08:26:03'),
(38, -1400, 'Egreso por nuevas entradas', '2024-06-29 08:26:14'),
(39, 146, 'Ingreso por facturacion', '2024-06-29 08:26:44'),
(40, 2436, 'Ingreso por facturacion', '2024-06-29 08:29:48'),
(41, 2436, 'Ingreso por facturacion', '2024-06-29 08:29:48'),
(42, -50, 'Egreso por nuevas entradas', '2024-06-29 10:01:47'),
(43, -50, 'Egreso por nuevas entradas', '2024-06-29 10:01:47'),
(44, 49, 'Ingreso por facturacion', '2024-06-29 10:06:45'),
(45, -12, 'Egreso por nuevas entradas', '2024-06-29 12:46:32'),
(46, 0, 'Egreso por nuevas entradas', '2024-06-29 12:51:43'),
(47, 27, 'Ingreso por facturacion', '2024-06-29 13:22:09'),
(48, 49, 'Ingreso por facturacion', '2024-06-30 17:13:43'),
(49, 0, 'Egreso por credito', '2024-06-30 18:19:42'),
(50, 50, 'ififiyfgiyg', '2024-07-08 19:23:55'),
(51, 50, 'monto de prueba', '2024-07-08 19:27:42'),
(55, -31, 'ascasc', '2024-07-08 19:39:50'),
(56, -31, 'resto', '2024-07-08 19:44:47'),
(57, 31, 'asccs', '2024-07-08 19:46:42'),
(58, -31, 'acsac', '2024-07-08 19:46:54'),
(59, -300, 'Egreso por nuevas entradas', '2024-07-10 17:50:31');

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
(32, 1, 1, 'La entrada con ID 106 vence en 10 días.', '2024-06-24 17:05:00'),
(33, 1, 1, 'La entrada con ID 109 vence en 10 días.', '2024-06-24 17:05:00'),
(34, 1, 1, 'La entrada con ID 106 vence en 5 días.', '2024-06-29 10:04:00'),
(35, 1, 1, 'La entrada con ID 109 vence en 5 días.', '2024-06-29 10:04:00'),
(36, 1, 0, 'La entrada con ID 112 vence hoy.', '2024-06-29 10:04:00'),
(37, 1, 0, 'La entrada con ID 113 vence hoy.', '2024-06-29 10:04:00'),
(38, 1, 0, 'La entrada con ID 115 vence en 2 días.', '2024-06-29 10:04:00'),
(39, 1, 0, 'La entrada con ID 116 vence en 2 días.', '2024-06-29 10:04:00'),
(40, 1, 0, 'La entrada con ID 107 vence en 2 días.', '2024-06-30 21:38:28'),
(41, 1, 0, 'La entrada con ID 106 vence hoy.', '2024-07-04 19:40:37'),
(42, 1, 1, 'La entrada con ID 109 vence hoy.', '2024-07-04 19:40:37'),
(43, 1, 1, 'La entrada con ID 110 vence en 2 días.', '2024-07-04 19:40:37'),
(44, 1, 1, 'La entrada con ID 110 vence hoy.', '2024-07-06 10:30:53'),
(50, 1, 0, 'El lote con numero 107 del producto Azucar vence en 30 días.', '2024-07-07 16:16:36'),
(51, 1, 0, 'El lote con numero 115 del producto Arroz vence en 7 días.', '2024-07-08 17:02:09'),
(52, 1, 1, 'El lote con numero 116 del producto Arroz vence en 7 días.', '2024-07-08 17:02:09');

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
(35, 115, 7, 8.53, '2024-07-08 18:12:35'),
(36, 116, 7, 9.25, '2024-07-08 18:12:35'),
(37, 117, 7, 8.53, '2024-07-08 18:12:35'),
(38, 118, 7, 8.53, '2024-07-08 18:12:35'),
(39, 119, 7, 27.75, '2024-07-08 18:12:35'),
(40, 120, 7, 34, '2024-07-08 18:12:35'),
(41, 121, 7, 30, '2024-07-08 18:12:35'),
(42, 121, 8, 15, '2024-07-08 18:12:35'),
(43, 122, 7, 8.7, '2024-07-08 18:12:35'),
(44, 123, 7, 17.4, '2024-07-08 18:12:35'),
(45, 124, 7, 17.4, '2024-07-08 18:12:35'),
(46, 125, 7, 17.4, '2024-07-08 18:12:35'),
(47, 126, 7, 17.4, '2024-07-08 18:12:35'),
(48, 127, 7, 146.16, '2024-07-08 18:12:35'),
(49, 129, 7, 2436, '2024-07-08 18:12:35'),
(50, 129, 7, 2436, '2024-07-08 18:12:35'),
(51, 130, 7, 48.72, '2024-07-08 18:12:35'),
(52, 131, 7, 27.12, '2024-07-08 18:12:35'),
(53, 132, 7, 48.72, '2024-07-08 18:12:35');

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
(5, 6, 'unidades', 'buscar'),
(20, 6, 'proveedores', 'agregar'),
(21, 6, 'proveedores', 'modificar'),
(22, 6, 'proveedores', 'eliminar'),
(23, 13, 'productos', 'agregar'),
(24, 13, 'productos', 'modificar'),
(25, 13, 'productos', 'eliminar'),
(26, 13, 'productos', 'imprimir'),
(27, 13, 'proveedores', 'agregar'),
(28, 13, 'proveedores', 'modificar'),
(29, 13, 'proveedores', 'eliminar'),
(30, 13, 'proveedores', 'imprimir'),
(31, 48, 'proveedores', 'agregar'),
(32, 48, 'proveedores', 'modificar'),
(33, 48, 'proveedores', 'eliminar');

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
(1, 1, 1, 1, 150, 'pan', 'banner_productos.png', 5, 10, 27.118, 0, 1, 0.3, '123456789012', 2),
(31, 1, 2, 1, 1, 'Azucar', 'producto_Azucar_5e5294ee-d7d2-424d-ac2e-5802bbad41ab.jpeg', 5, 10, 42, 1, 1, 0.5, '', 1),
(32, 2, 2, 3, 1, 'Harina', 'producto_Harina_2551fe44-3bc1-476e-b084-e7ff84eb8600.jpeg', 10, 20, 9.25, 0, 1, 0, '', 2),
(33, 2, 2, 1, 1, 'Arroz', 'producto_Arroz_2c51307c-9d9f-41fb-9419-1e61a44891f0.jpeg', 5, 10, 15.01, 0, 1, 0, '', NULL),
(34, 2, 2, 12, 1, 'Pasta', 'producto_Pasta_arroz.jpeg', 5, 20, 15, 0, 1, 0, '', NULL),
(35, 1, 2, 1, 10, 'Hfgrtg', 'banner_productos.png', 1, 12, 10, 1, 1, 0, '111111111111', NULL),
(36, 1, 1, 1, 1, 'Glup', 'producto_Alcohol_ImgThumb.jpg', 5, 10, 15, 0, 1, 0, '754123698547', 1),
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
(15, 'Mendoza', 'Chocolate', 'V-15930218', '+584125915587', 'polar@gmail.com', 'Direccion tal', 0),
(16, 'Miguel Perezz', 'Tunal', 'V-14368987', '+584124573864', 'eltunal@gmail.com', 'carrera 10, cruce calle 15, casa S/N', 1);

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
(115, 8.53, '2024-06-27 16:54:39', 12, 30, 1.18, 1),
(116, 9.25, '2024-06-27 16:56:39', 12, 31, 0, 1),
(117, 8.53, '2024-06-27 16:57:14', 12, 31, 1.18, 1),
(118, 8.53, '2024-06-27 17:09:21', 12, 31, 1.18, 1),
(119, 27.75, '2024-06-28 10:59:41', 12, 33, 0, 1),
(120, 34, '2024-06-28 11:16:40', 12, 33, 0, 1),
(121, 45, '2024-06-28 11:20:22', 12, 32, 0, 1),
(122, 8.7, '2024-06-29 08:21:55', 13, 42, 1.2, 1),
(123, 17.4, '2024-06-29 08:24:08', 13, 43, 2.4, 1),
(124, 17.4, '2024-06-29 08:24:09', 13, 43, 2.4, 1),
(125, 17.4, '2024-06-29 08:24:09', 13, 43, 2.4, 1),
(126, 17.4, '2024-06-29 08:24:10', 13, 43, 2.4, 1),
(127, 146.16, '2024-06-29 08:26:44', 13, 43, 20.16, 1),
(128, 2436, '2024-06-29 08:29:48', 13, 44, 336, 1),
(129, 2436, '2024-06-29 08:29:48', 13, 43, 336, 1),
(130, 48.72, '2024-06-29 10:06:44', 12, 45, 6.72, 1),
(131, 27.12, '2024-06-29 13:22:09', 13, 45, 0, 1),
(132, 48.72, '2024-06-30 17:13:43', 12, 46, 6.72, 1),
(133, 48.72, '2024-06-30 18:19:42', 12, 46, 6.72, 0);

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
  `semilla` varchar(45) NOT NULL,
  `sesion_id` varchar(145) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `correo`, `hash`, `rol`, `active`, `semilla`, `sesion_id`) VALUES
(5, 'asd', 'jaja@gmail.com', '$2y$10$fdgc0QZ4YyBMB3ix3jV5AOesVSZFCRrTZ.UUHr61qjviWGq7zi7h2', 1, 1, '', ''),
(6, 'Edouard', 'nose@gmail.com', '$2y$10$ey1aHUkj5We8D34bQSoAZesKdwW6tv26V9K.DtkHBfVrQFE7Wzj/e', 1, 1, 'MSKR0rIA3x95JGubVUWk', 'j1VLz7oqgN'),
(7, 'John', 'johnconnor@gmail.com', '$2y$10$EgZWh1WmrpMGrsF9K2DjyeL5YTds6aS3.Rku/.h8P7wk7ltODzf9e', 2, 1, '', ''),
(10, 'Alfredo', 'alfredo@gmail.com', '$2y$10$8nUZSX2kXCVysLvCLirVyuhfeUSB0uICkZsl3kiDJY4kqlZCI8DKu', 2, 1, '', ''),
(12, 'Juan', 'depanajuaner@gmail.com', '$2y$10$W7XfRH4IOSoK.KP67LnOUuaN4DzXX7jRwF4QfQxphpqCd38xVSDbu', 1, 1, 'MSKR0rIA3x95JGubVUWq', ''),
(13, 'Vanessa', 'yfvy87@gmail.com', '$2y$10$HZR6p6T5mhr0l.W0UnFcCeO1wDGD6wrrpPCmAcVoIRUYQbHDLIJC2', 1, 1, 'z1juwnyJTFxdCAGB3ihY', ''),
(40, 'Luis', 'garnicaluis391@gmail.com', '$2y$10$xF7UceeLhEfDtQqzOpjCM.gmLUXqOciQIBx0UfUglvRn9dMToVEBe', 1, 1, 'W6sTV8t5Qpz7jrRULZ3O', ''),
(48, 'Miguel', 'miguel@gmail.com', '$2y$10$4pIwTcd0BFED9icBrund9usH/wg1UJKLsQIXrMAKUUFyhtXg74nwO', 1, 1, 'yVnBjaFJXbO0sWLtMkKv', '');

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

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `clientesfrecuentes`  AS SELECT (select `registro_ventas`.`id_cliente`) AS `idCliente`, (select `clientes`.`nombre` from `clientes` where (`clientes`.`id` = `registro_ventas`.`id_cliente`)) AS `Cliente`, (select count(0) from `registro_ventas` where (`registro_ventas`.`id_cliente` = `idCliente`)) AS `Compras` FROM `registro_ventas` GROUP BY `registro_ventas`.`id_cliente` ORDER BY (select count(0) from `registro_ventas` where (`registro_ventas`.`id_cliente` = `idCliente`)) DESC LIMIT 0, 5 ;

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

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `costo_entradas_mensuales`  AS SELECT coalesce(round(sum((case when (month(`e`.`fecha_compra`) = 1) then `e`.`precio_compra` else 0 end)),2),0) AS `Enero`, coalesce(round(sum((case when (month(`e`.`fecha_compra`) = 2) then `e`.`precio_compra` else 0 end)),2),0) AS `Febrero`, coalesce(round(sum((case when (month(`e`.`fecha_compra`) = 3) then `e`.`precio_compra` else 0 end)),2),0) AS `Marzo`, coalesce(round(sum((case when (month(`e`.`fecha_compra`) = 4) then `e`.`precio_compra` else 0 end)),2),0) AS `Abril`, coalesce(round(sum((case when (month(`e`.`fecha_compra`) = 5) then `e`.`precio_compra` else 0 end)),2),0) AS `Mayo`, coalesce(round(sum((case when (month(`e`.`fecha_compra`) = 6) then `e`.`precio_compra` else 0 end)),2),0) AS `Junio`, coalesce(round(sum((case when (month(`e`.`fecha_compra`) = 7) then `e`.`precio_compra` else 0 end)),2),0) AS `Julio`, coalesce(round(sum((case when (month(`e`.`fecha_compra`) = 8) then `e`.`precio_compra` else 0 end)),2),0) AS `Agosto`, coalesce(round(sum((case when (month(`e`.`fecha_compra`) = 9) then `e`.`precio_compra` else 0 end)),2),0) AS `Septiembre`, coalesce(round(sum((case when (month(`e`.`fecha_compra`) = 10) then `e`.`precio_compra` else 0 end)),2),0) AS `Octubre`, coalesce(round(sum((case when (month(`e`.`fecha_compra`) = 11) then `e`.`precio_compra` else 0 end)),2),0) AS `Noviembre`, coalesce(round(sum((case when (month(`e`.`fecha_compra`) = 12) then `e`.`precio_compra` else 0 end)),2),0) AS `Diciembre` FROM `entradas` AS `e` WHERE (year(`e`.`fecha_compra`) = year(now())) ;

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

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `ratio_ventas`  AS SELECT `p`.`id` AS `id`, `p`.`nombre` AS `nombre`, `p`.`valor_unidad` AS `unidad_valor`, (select `unidades`.`nombre` from `unidades` where (`unidades`.`id` = `p`.`id_unidad`)) AS `unidad`, (select `marcas`.`nombre` from `marcas` where (`marcas`.`id` = `p`.`id_marca`)) AS `marca`, (1 - ((select sum(`c`.`existencia`) from `entradas` `c` where (`c`.`id_producto` = `p`.`id`)) / (select sum(`a`.`cantidad`) from `entradas` `a` where (`a`.`id_producto` = `p`.`id`)))) AS `ratio_ventas` FROM `productos` AS `p` WHERE (`p`.`active` = 1) LIMIT 0, 5 ;

-- --------------------------------------------------------

--
-- Estructura para la vista `rotacion_inventario`
--
DROP TABLE IF EXISTS `rotacion_inventario`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `rotacion_inventario`  AS SELECT coalesce(round(((select sum(`p`.`monto`) from (`pagos` `p` join `registro_ventas` `rv` on((`p`.`id_venta` = `rv`.`id`))) where (month(`rv`.`fecha`) = 1)) / (select sum((`e`.`existencia` * `e`.`precio_compra`)) from `entradas` `e` where (month(`e`.`fecha_compra`) = 1))),2),0) AS `Enero`, coalesce(round(((select sum(`p`.`monto`) from (`pagos` `p` join `registro_ventas` `rv` on((`p`.`id_venta` = `rv`.`id`))) where (month(`rv`.`fecha`) = 2)) / (select sum((`e`.`existencia` * `e`.`precio_compra`)) from `entradas` `e` where (month(`e`.`fecha_compra`) = 2))),2),0) AS `Febrero`, coalesce(round(((select sum(`p`.`monto`) from (`pagos` `p` join `registro_ventas` `rv` on((`p`.`id_venta` = `rv`.`id`))) where (month(`rv`.`fecha`) = 3)) / (select sum((`e`.`existencia` * `e`.`precio_compra`)) from `entradas` `e` where (month(`e`.`fecha_compra`) = 3))),2),0) AS `Marzo`, coalesce(round(((select sum(`p`.`monto`) from (`pagos` `p` join `registro_ventas` `rv` on((`p`.`id_venta` = `rv`.`id`))) where (month(`rv`.`fecha`) = 4)) / (select sum((`e`.`existencia` * `e`.`precio_compra`)) from `entradas` `e` where (month(`e`.`fecha_compra`) = 4))),2),0) AS `Abril`, coalesce(round(((select sum(`p`.`monto`) from (`pagos` `p` join `registro_ventas` `rv` on((`p`.`id_venta` = `rv`.`id`))) where (month(`rv`.`fecha`) = 5)) / (select sum((`e`.`existencia` * `e`.`precio_compra`)) from `entradas` `e` where (month(`e`.`fecha_compra`) = 5))),2),0) AS `Mayo`, coalesce(round(((select sum(`p`.`monto`) from (`pagos` `p` join `registro_ventas` `rv` on((`p`.`id_venta` = `rv`.`id`))) where (month(`rv`.`fecha`) = 6)) / (select sum((`e`.`existencia` * `e`.`precio_compra`)) from `entradas` `e` where (month(`e`.`fecha_compra`) = 6))),2),0) AS `Junio`, coalesce(round(((select sum(`p`.`monto`) from (`pagos` `p` join `registro_ventas` `rv` on((`p`.`id_venta` = `rv`.`id`))) where (month(`rv`.`fecha`) = 7)) / (select sum((`e`.`existencia` * `e`.`precio_compra`)) from `entradas` `e` where (month(`e`.`fecha_compra`) = 7))),2),0) AS `Julio`, coalesce(round(((select sum(`p`.`monto`) from (`pagos` `p` join `registro_ventas` `rv` on((`p`.`id_venta` = `rv`.`id`))) where (month(`rv`.`fecha`) = 8)) / (select sum((`e`.`existencia` * `e`.`precio_compra`)) from `entradas` `e` where (month(`e`.`fecha_compra`) = 8))),2),0) AS `Agosto`, coalesce(round(((select sum(`p`.`monto`) from (`pagos` `p` join `registro_ventas` `rv` on((`p`.`id_venta` = `rv`.`id`))) where (month(`rv`.`fecha`) = 9)) / (select sum((`e`.`existencia` * `e`.`precio_compra`)) from `entradas` `e` where (month(`e`.`fecha_compra`) = 9))),2),0) AS `Septiembre`, coalesce(round(((select sum(`p`.`monto`) from (`pagos` `p` join `registro_ventas` `rv` on((`p`.`id_venta` = `rv`.`id`))) where (month(`rv`.`fecha`) = 10)) / (select sum((`e`.`existencia` * `e`.`precio_compra`)) from `entradas` `e` where (month(`e`.`fecha_compra`) = 10))),2),0) AS `Octubre`, coalesce(round(((select sum(`p`.`monto`) from (`pagos` `p` join `registro_ventas` `rv` on((`p`.`id_venta` = `rv`.`id`))) where (month(`rv`.`fecha`) = 11)) / (select sum((`e`.`existencia` * `e`.`precio_compra`)) from `entradas` `e` where (month(`e`.`fecha_compra`) = 11))),2),0) AS `Noviembre`, coalesce(round(((select sum(`p`.`monto`) from (`pagos` `p` join `registro_ventas` `rv` on((`p`.`id_venta` = `rv`.`id`))) where (month(`rv`.`fecha`) = 12)) / (select sum((`e`.`existencia` * `e`.`precio_compra`)) from `entradas` `e` where (month(`e`.`fecha_compra`) = 12))),2),0) AS `Diciembre` ;

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

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `valortotalinventario`  AS SELECT (select `categoria`.`nombre` from `categoria` where (`categoria`.`id` = `p`.`id_categoria`)) AS `nombre`, round(sum(((select sum(`e`.`existencia`) from `entradas` `e` where (`e`.`id_producto` = `p`.`id`)) * `p`.`precio_venta`)),2) AS `valor` FROM `productos` AS `p` GROUP BY `p`.`id_categoria` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `valor_promedio_inventario_mensual`
--
DROP TABLE IF EXISTS `valor_promedio_inventario_mensual`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `valor_promedio_inventario_mensual`  AS SELECT coalesce(round((select sum((`e`.`existencia` * `e`.`precio_compra`)) from `entradas` `e` where (month(`e`.`fecha_compra`) = 1)),0),0) AS `Enero`, coalesce(round((select sum((`e`.`existencia` * `e`.`precio_compra`)) from `entradas` `e` where (month(`e`.`fecha_compra`) = 2)),0),0) AS `Febrero`, coalesce(round((select sum((`e`.`existencia` * `e`.`precio_compra`)) from `entradas` `e` where (month(`e`.`fecha_compra`) = 3)),0),0) AS `Marzo`, coalesce(round((select sum((`e`.`existencia` * `e`.`precio_compra`)) from `entradas` `e` where (month(`e`.`fecha_compra`) = 4)),0),0) AS `Abril`, coalesce(round((select sum((`e`.`existencia` * `e`.`precio_compra`)) from `entradas` `e` where (month(`e`.`fecha_compra`) = 5)),0),0) AS `Mayo`, coalesce(round((select sum((`e`.`existencia` * `e`.`precio_compra`)) from `entradas` `e` where (month(`e`.`fecha_compra`) = 6)),0),0) AS `Junio`, coalesce(round((select sum((`e`.`existencia` * `e`.`precio_compra`)) from `entradas` `e` where (month(`e`.`fecha_compra`) = 7)),0),0) AS `Julio`, coalesce(round((select sum((`e`.`existencia` * `e`.`precio_compra`)) from `entradas` `e` where (month(`e`.`fecha_compra`) = 8)),0),0) AS `Agosto`, coalesce(round((select sum((`e`.`existencia` * `e`.`precio_compra`)) from `entradas` `e` where (month(`e`.`fecha_compra`) = 9)),0),0) AS `Septiembre`, coalesce(round((select sum((`e`.`existencia` * `e`.`precio_compra`)) from `entradas` `e` where (month(`e`.`fecha_compra`) = 10)),0),0) AS `Octubre`, coalesce(round((select sum((`e`.`existencia` * `e`.`precio_compra`)) from `entradas` `e` where (month(`e`.`fecha_compra`) = 11)),0),0) AS `Noviembre`, coalesce(round((select sum((`e`.`existencia` * `e`.`precio_compra`)) from `entradas` `e` where (month(`e`.`fecha_compra`) = 12)),0),0) AS `Diciembre` ;

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=389;

--
-- AUTO_INCREMENT de la tabla `caja`
--
ALTER TABLE `caja`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `credito`
--
ALTER TABLE `credito`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `dinero`
--
ALTER TABLE `dinero`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `entradas`
--
ALTER TABLE `entradas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT de la tabla `pagos`
--
ALTER TABLE `pagos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `registro_ventas`
--
ALTER TABLE `registro_ventas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=134;

--
-- AUTO_INCREMENT de la tabla `unidades`
--
ALTER TABLE `unidades`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

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
CREATE DEFINER=`root`@`localhost` EVENT `check_and_notify` ON SCHEDULE EVERY 1 DAY STARTS '2024-06-23 10:04:00' ON COMPLETION NOT PRESERVE ENABLE DO CALL check_and_notify()$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
