-- MySQL dump 10.13  Distrib 8.0.34, for Win64 (x86_64)
--
-- Host: localhost    Database: proyecto_4
-- ------------------------------------------------------
-- Server version	8.0.34

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `bitacora`
--

DROP TABLE IF EXISTS `bitacora`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bitacora` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_usuario` int NOT NULL,
  `tabla` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `accion` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `detalles` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_usuario_idx` (`id_usuario`),
  CONSTRAINT `id_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=514 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bitacora`
--

LOCK TABLES `bitacora` WRITE;
/*!40000 ALTER TABLE `bitacora` DISABLE KEYS */;
INSERT INTO `bitacora` VALUES (207,6,'Caja','Abriendo','2024-06-22 17:50:31','Caja abierta'),(208,6,'Caja','Abriendo','2024-06-22 21:18:57','Caja abierta'),(209,6,'Pagos','Registrar','2024-06-23 12:01:08','Pago Registrado'),(210,6,'registrar_ventas','agregar','2024-06-23 12:01:08','se agrego una venta'),(211,6,'Caja','Abriendo','2024-06-23 12:31:43','Caja abierta'),(212,6,'Pagos','Registrar','2024-06-23 12:32:20','Pago Registrado'),(213,6,'registrar_ventas','agregar','2024-06-23 12:32:20','se agrego una venta'),(214,6,'Permisos','Eliminar','2024-06-23 12:52:20','Permiso Eliminado'),(215,6,'Permisos','Eliminar','2024-06-23 12:52:22','Permiso Eliminado'),(216,6,'Permisos','Eliminar','2024-06-23 12:52:23','Permiso Eliminado'),(217,6,'Caja','Abriendo','2024-06-23 13:06:12','Caja abierta'),(218,6,'Caja','Abriendo','2024-06-23 15:55:18','Caja abierta'),(219,6,'Caja','Abriendo','2024-06-23 16:06:40','Caja abierta'),(220,6,'Pagos','Registrar','2024-06-23 16:07:32','Pago Registrado'),(221,6,'registrar_ventas','agregar','2024-06-23 16:07:32','se agrego una venta'),(222,6,'Caja','Abriendo','2024-06-23 16:11:44','Caja abierta'),(223,6,'Caja','Abriendo','2024-06-23 16:14:09','Caja abierta'),(224,6,'Caja','Abriendo','2024-06-23 16:21:15','Caja abierta'),(225,6,'Caja','Abriendo','2024-06-23 16:22:33','Caja abierta'),(226,6,'Login','logueado','2024-06-24 00:10:47','El usuario Edouard inicio sesion'),(227,6,'Login','logueado','2024-06-24 14:29:24','El usuario Edouard inicio sesion'),(228,6,'Login','logueado','2024-06-27 16:54:07','El usuario Edouard inicio sesion'),(229,6,'Pagos','Registrar','2024-06-27 16:54:40','Pago Registrado'),(230,6,'registrar_ventas','agregar','2024-06-27 16:54:40','se agrego una venta'),(231,6,'Caja','Abriendo','2024-06-27 16:56:16','Caja abierta'),(232,6,'Pagos','Registrar','2024-06-27 16:56:39','Pago Registrado'),(233,6,'registrar_ventas','agregar','2024-06-27 16:56:39','se agrego una venta'),(234,6,'Pagos','Registrar','2024-06-27 16:57:15','Pago Registrado'),(235,6,'registrar_ventas','agregar','2024-06-27 16:57:15','se agrego una venta'),(236,6,'Pagos','Registrar','2024-06-27 17:09:21','Pago Registrado'),(237,6,'registrar_ventas','agregar','2024-06-27 17:09:21','se agrego una venta'),(238,6,'Login','logueado','2024-06-28 10:41:14','El usuario Edouard inicio sesion'),(239,6,'Login','logueado','2024-06-28 10:41:52','El usuario Edouard inicio sesion'),(240,6,'deslogin','des-logueado','2024-06-28 10:42:24','el usuario Edouard se des-logueo'),(241,6,'Login','logueado','2024-06-28 10:42:41','El usuario Edouard inicio sesion'),(242,13,'Login','logueado','2024-06-28 10:42:55','El usuario Vanessa inicio sesion'),(243,6,'Caja','Abriendo','2024-06-28 10:43:50','Caja abierta'),(244,13,'Caja','Abriendo','2024-06-28 10:43:53','Caja abierta'),(245,13,'Pagos','Registrar','2024-06-28 10:59:41','Pago Registrado'),(246,13,'registrar_ventas','agregar','2024-06-28 10:59:41','se agrego una venta'),(247,13,'Pagos','Registrar','2024-06-28 11:16:40','Pago Registrado'),(248,13,'registrar_ventas','agregar','2024-06-28 11:16:40','se agrego una venta'),(249,6,'Pagos','Registrar','2024-06-28 11:20:22','Pago Registrado'),(250,6,'Pagos','Registrar','2024-06-28 11:20:23','Pago Registrado'),(251,6,'registrar_ventas','agregar','2024-06-28 11:20:23','se agrego una venta'),(252,6,'Login','logueado','2024-06-28 11:28:30','El usuario Edouard inicio sesion'),(253,6,'Caja','Abriendo','2024-06-28 11:41:52','Caja abierta'),(254,6,'Caja','Abriendo','2024-06-28 11:57:58','Caja abierta'),(255,6,'Login','logueado','2024-06-28 15:08:19','El usuario Edouard inicio sesion'),(256,6,'Permisos','Registrar','2024-06-28 16:06:48','Permiso Registrado'),(257,6,'Permisos','Registrar','2024-06-28 16:06:49','Permiso Registrado'),(258,6,'Permisos','Registrar','2024-06-28 16:06:50','Permiso Registrado'),(259,6,'deslogin','des-logueado','2024-06-28 22:33:08','el usuario Edouard se des-logueo'),(260,6,'Login','logueado','2024-06-28 22:45:00','El usuario Edouard inicio sesion'),(261,6,'Login','logueado','2024-06-28 22:47:30','El usuario Edouard inicio sesion'),(262,6,'Login','logueado','2024-06-28 23:07:41','El usuario Edouard inicio sesion'),(263,6,'Proveedores','Registrar','2024-06-28 23:17:18','Proveedor Registrado'),(264,6,'Cliente','Registrar','2024-06-28 23:18:13','Cliente Registrado'),(265,6,'deslogin','des-logueado','2024-06-28 23:19:44','el usuario Edouard se des-logueo'),(266,6,'Login','logueado','2024-06-29 08:05:04','El usuario Edouard inicio sesion'),(267,6,'Login','logueado','2024-06-29 08:05:16','El usuario Edouard inicio sesion'),(268,6,'Login','logueado','2024-06-29 08:05:19','El usuario Edouard inicio sesion'),(269,6,'Caja','Abriendo','2024-06-29 08:06:55','Caja abierta'),(270,6,'Caja','Abriendo','2024-06-29 08:06:58','Caja abierta'),(271,6,'Caja','Abriendo','2024-06-29 08:08:36','Caja abierta'),(272,6,'Caja','Abriendo','2024-06-29 08:08:53','Caja abierta'),(273,6,'Usuarios','Registrar','2024-06-29 08:12:02','Usuario Registrado'),(274,6,'Usuarios','Registrar','2024-06-29 08:12:03','Usuario Registrado'),(275,6,'Usuarios','Registrar','2024-06-29 08:12:06','Usuario Registrado'),(276,6,'deslogin','des-logueado','2024-06-29 08:12:18','el usuario Edouard se des-logueo'),(277,6,'deslogin','des-logueado','2024-06-29 08:12:22','el usuario Edouard se des-logueo'),(278,6,'Caja','Abriendo','2024-06-29 08:13:52','Caja abierta'),(279,6,'Caja','Abriendo','2024-06-29 08:13:56','Caja abierta'),(280,6,'Login','logueado','2024-06-29 08:14:45','El usuario Edouard inicio sesion'),(281,6,'Caja','Abriendo','2024-06-29 08:21:47','Caja abierta'),(282,6,'Pagos','Registrar','2024-06-29 08:21:55','Pago Registrado'),(283,6,'registrar_ventas','agregar','2024-06-29 08:21:55','se agrego una venta'),(284,6,'Login','logueado','2024-06-29 08:23:19','El usuario Edouard inicio sesion'),(285,6,'Login','logueado','2024-06-29 08:23:47','El usuario Edouard inicio sesion'),(286,6,'Caja','Abriendo','2024-06-29 08:24:08','Caja abierta'),(287,6,'Pagos','Registrar','2024-06-29 08:24:08','Pago Registrado'),(288,6,'registrar_ventas','agregar','2024-06-29 08:24:09','se agrego una venta'),(289,6,'Pagos','Registrar','2024-06-29 08:24:09','Pago Registrado'),(290,6,'registrar_ventas','agregar','2024-06-29 08:24:09','se agrego una venta'),(291,6,'Pagos','Registrar','2024-06-29 08:24:09','Pago Registrado'),(292,6,'registrar_ventas','agregar','2024-06-29 08:24:09','se agrego una venta'),(293,6,'Pagos','Registrar','2024-06-29 08:24:10','Pago Registrado'),(294,6,'registrar_ventas','agregar','2024-06-29 08:24:10','se agrego una venta'),(295,6,'registrar_ventas','agregar','2024-06-29 08:26:44','se agrego una venta'),(296,6,'deslogin','des-logueado','2024-06-29 08:27:42','el usuario Edouard se des-logueo'),(297,13,'Login','logueado','2024-06-29 08:28:14','El usuario Vanessa inicio sesion'),(298,13,'Caja','Abriendo','2024-06-29 08:28:42','Caja abierta'),(299,6,'registrar_ventas','agregar','2024-06-29 08:29:48','se agrego una venta'),(300,13,'registrar_ventas','agregar','2024-06-29 08:29:48','se agrego una venta'),(301,13,'deslogin','des-logueado','2024-06-29 08:31:35','el usuario Vanessa se des-logueo'),(302,6,'Login','logueado','2024-06-29 08:32:32','El usuario Edouard inicio sesion'),(303,13,'Login','logueado','2024-06-29 09:38:50','El usuario Vanessa inicio sesion'),(304,6,'Login','logueado','2024-06-29 09:40:27','El usuario Edouard inicio sesion'),(305,6,'Permisos','Registrar','2024-06-29 09:53:12','Permiso Registrado'),(306,6,'Permisos','Registrar','2024-06-29 09:53:13','Permiso Registrado'),(307,6,'Permisos','Registrar','2024-06-29 09:53:13','Permiso Registrado'),(308,6,'Permisos','Registrar','2024-06-29 09:53:14','Permiso Registrado'),(309,6,'Permisos','Registrar','2024-06-29 09:53:16','Permiso Registrado'),(310,6,'Permisos','Registrar','2024-06-29 09:53:16','Permiso Registrado'),(311,6,'Permisos','Registrar','2024-06-29 09:53:17','Permiso Registrado'),(312,6,'Permisos','Registrar','2024-06-29 09:53:18','Permiso Registrado'),(313,6,'Caja','Abriendo','2024-06-29 10:06:38','Caja abierta'),(314,6,'registrar_ventas','agregar','2024-06-29 10:06:45','se agrego una venta'),(315,6,'registrar_ventas','agregar','2024-06-29 13:22:09','se agrego una venta'),(316,6,'Login','logueado','2024-06-30 09:38:14','El usuario Edouard inicio sesion'),(317,6,'Caja','Abriendo','2024-06-30 17:13:01','Caja abierta'),(318,6,'registrar_ventas','agregar','2024-06-30 17:13:43','se agrego una venta'),(319,6,'Credito','Registrar','2024-06-30 18:19:42','Credito Registrado'),(320,6,'registrar_ventas','agregar','2024-06-30 18:19:42','se agrego una venta'),(321,6,'deslogin','des-logueado','2024-06-30 19:30:45','el usuario Edouard se des-logueo'),(322,6,'Login','logueado','2024-06-30 19:51:24','El usuario Edouard inicio sesion'),(323,6,'deslogin','des-logueado','2024-06-30 19:51:49','el usuario Edouard se des-logueo'),(324,6,'Login','logueado','2024-07-04 09:56:53','El usuario Edouard inicio sesion'),(325,6,'Login','logueado','2024-07-06 10:19:25','El usuario Edouard inicio sesion'),(326,6,'deslogin','des-logueado','2024-07-06 11:18:05','el usuario Edouard se des-logueo'),(327,6,'Login','logueado','2024-07-06 11:19:00','El usuario Edouard inicio sesion'),(328,6,'Login','logueado','2024-07-06 11:31:51','El usuario Edouard inicio sesion'),(329,6,'Login','logueado','2024-07-07 12:08:04','El usuario Edouard inicio sesion'),(330,6,'deslogin','des-logueado','2024-07-07 12:10:01','el usuario Edouard se des-logueo'),(342,40,'deslogin','des-logueado','2024-07-07 13:02:49','el usuario Luis se des-logueo'),(343,6,'Login','logueado','2024-07-07 13:03:06','El usuario Edouard inicio sesion'),(344,6,'Login','logueado','2024-07-07 22:29:01','El usuario Edouard inicio sesion'),(345,6,'Login','logueado','2024-07-08 15:35:12','El usuario Edouard inicio sesion'),(346,6,'Login','logueado','2024-07-08 18:16:14','El usuario Edouard inicio sesion'),(347,6,'movimientos_capital','Registrar','2024-07-08 19:23:55','Capital Cambiado'),(348,6,'movimientos_capital','Registrar','2024-07-08 19:27:42','Capital Cambiado'),(349,6,'movimientos_capital','Registrar','2024-07-08 19:30:48','Capital Cambiado'),(350,6,'movimientos_capital','Registrar','2024-07-08 19:32:41','Capital Cambiado'),(351,6,'movimientos_capital','Registrar','2024-07-08 19:33:12','Capital Cambiado'),(352,6,'movimientos_capital','Registrar','2024-07-08 19:39:50','Capital Cambiado'),(353,6,'movimientos_capital','Registrar','2024-07-08 19:44:47','Capital Cambiado'),(354,6,'movimientos_capital','Registrar','2024-07-08 19:46:42','Capital Cambiado'),(355,6,'movimientos_capital','Registrar','2024-07-08 19:46:54','Capital Cambiado'),(356,6,'deslogin','des-logueado','2024-07-08 19:55:56','el usuario Edouard se des-logueo'),(357,6,'Login','logueado','2024-07-08 20:00:29','El usuario Edouard inicio sesion'),(358,6,'deslogin','des-logueado','2024-07-09 15:36:26','el usuario Edouard se des-logueo'),(361,6,'Login','logueado','2024-07-10 17:27:47','El usuario Edouard inicio sesion'),(362,6,'Login','logueado','2024-07-10 17:29:13','El usuario Edouard inicio sesion'),(363,6,'Login','logueado','2024-07-10 17:43:43','El usuario Edouard inicio sesion'),(364,6,'deslogin','des-logueado','2024-07-10 17:53:45','el usuario Edouard se des-logueo'),(365,6,'Login','logueado','2024-07-10 18:52:15','El usuario Edouard inicio sesion'),(366,6,'deslogin','des-logueado','2024-07-10 19:55:33','el usuario Edouard se des-logueo'),(367,6,'deslogin','des-logueado','2024-07-10 21:09:44','el usuario Edouard se des-logueo'),(372,48,'Permisos','Registrar','2024-07-11 00:55:24','Permiso Registrado'),(373,48,'Permisos','Registrar','2024-07-11 00:55:25','Permiso Registrado'),(374,48,'Permisos','Registrar','2024-07-11 00:55:27','Permiso Registrado'),(375,48,'Proveedor','Modificar','2024-07-11 00:56:08','Proveedor 16 Modificado'),(376,6,'Login','logueado','2024-07-11 01:17:31','El usuario Edouard inicio sesion'),(377,6,'deslogin','des-logueado','2024-07-11 01:22:20','el usuario Edouard se des-logueo'),(378,6,'Login','logueado','2024-07-11 01:24:56','El usuario Edouard inicio sesion'),(379,6,'deslogin','des-logueado','2024-07-11 01:31:18','el usuario Edouard se des-logueo'),(380,6,'Login','logueado','2024-07-11 01:42:10','El usuario Edouard inicio sesion'),(381,6,'deslogin','des-logueado','2024-07-11 01:57:31','el usuario Edouard se des-logueo'),(382,6,'Login','logueado','2024-07-11 02:05:34','El usuario Edouard inicio sesion'),(383,6,'deslogin','des-logueado','2024-07-11 02:08:51','el usuario Edouard se des-logueo'),(384,6,'Login','logueado','2024-07-12 14:42:04','El usuario Edouard inicio sesion'),(385,6,'deslogin','des-logueado','2024-07-12 14:42:29','el usuario Edouard se des-logueo'),(386,6,'Login','logueado','2024-07-12 14:42:53','El usuario Edouard inicio sesion'),(387,6,'deslogin','des-logueado','2024-07-12 18:20:36','el usuario Edouard se des-logueo'),(388,6,'Login','logueado','2024-07-12 19:06:11','El usuario Edouard inicio sesion'),(389,6,'Login','logueado','2024-07-12 23:27:51','El usuario Edouard inicio sesion'),(390,6,'Configuraciones','Modificar','2024-07-13 10:21:09','Configuracion dolar Modificada'),(391,6,'Configuraciones','Modificar','2024-07-13 10:21:44','Configuracion dolar Modificada'),(392,6,'Configuraciones','Modificar','2024-07-13 10:21:58','Configuracion dolar Modificada'),(393,6,'Configuraciones','Modificar','2024-07-13 10:21:58','Configuracion dolar Modificada'),(394,6,'Configuraciones','Modificar','2024-07-13 10:21:59','Configuracion dolar Modificada'),(395,6,'Configuraciones','Modificar','2024-07-13 10:21:59','Configuracion dolar Modificada'),(396,6,'Configuraciones','Modificar','2024-07-13 10:21:59','Configuracion dolar Modificada'),(397,6,'Configuraciones','Modificar','2024-07-13 10:21:59','Configuracion dolar Modificada'),(398,6,'Configuraciones','Modificar','2024-07-13 10:21:59','Configuracion dolar Modificada'),(399,6,'Configuraciones','Modificar','2024-07-13 10:21:59','Configuracion dolar Modificada'),(400,6,'Configuraciones','Modificar','2024-07-13 10:21:59','Configuracion dolar Modificada'),(401,6,'Configuraciones','Modificar','2024-07-13 10:21:59','Configuracion dolar Modificada'),(402,6,'Configuraciones','Modificar','2024-07-13 10:21:59','Configuracion dolar Modificada'),(403,6,'Configuraciones','Modificar','2024-07-13 10:22:00','Configuracion dolar Modificada'),(404,6,'Configuraciones','Modificar','2024-07-13 10:22:00','Configuracion dolar Modificada'),(405,6,'Configuraciones','Modificar','2024-07-13 10:22:00','Configuracion dolar Modificada'),(406,6,'Configuraciones','Modificar','2024-07-13 10:22:00','Configuracion dolar Modificada'),(407,6,'Configuraciones','Modificar','2024-07-13 10:22:11','Configuracion dolar Modificada'),(408,6,'Configuraciones','Modificar','2024-07-13 10:23:10','Configuracion dolar Modificada'),(409,6,'Configuraciones','Modificar','2024-07-13 10:24:16','Configuracion dolar Modificada'),(410,6,'Configuraciones','Modificar','2024-07-13 10:26:12','Configuracion dolar Modificada'),(411,6,'Configuraciones','Modificar','2024-07-13 10:27:24','Configuracion dolar Modificada'),(412,6,'Configuraciones','Modificar','2024-07-13 10:39:38','Configuracion dolar Modificada'),(413,6,'Configuraciones','Modificar','2024-07-13 10:41:40','Configuracion dolar Modificada'),(414,6,'Configuraciones','Modificar','2024-07-13 10:43:30','Configuracion dolar Modificada'),(415,6,'Configuraciones','Modificar','2024-07-13 10:43:37','Configuracion dolar Modificada'),(416,6,'Configuraciones','Modificar','2024-07-13 10:56:13','Configuracion dolar Modificada'),(417,6,'Login','logueado','2024-07-13 13:27:08','El usuario Edouard inicio sesion'),(418,6,'Login','logueado','2024-07-13 13:46:36','El usuario Edouard inicio sesion'),(419,6,'Configuraciones','Modificar','2024-07-13 13:47:10','Configuracion dolar Modificada'),(420,6,'Configuraciones','Modificar','2024-07-13 13:47:12','Configuracion dolar Modificada'),(421,6,'Configuraciones','Modificar','2024-07-13 14:00:56','Configuracion dolar Modificada'),(422,6,'Configuraciones','Modificar','2024-07-13 14:09:16','Configuracion dolar Modificada'),(423,6,'Configuraciones','Modificar','2024-07-13 14:09:22','Configuracion dolar Modificada'),(424,6,'Configuraciones','Modificar','2024-07-13 14:09:31','Configuracion dolar Modificada'),(425,6,'Credito','Registrar','2024-07-13 14:19:01','Credito Registrado'),(426,6,'registrar_ventas','agregar','2024-07-13 14:19:01','se agrego una venta'),(427,6,'Usuarios','Login','2024-07-15 00:45:33','Usuario  logueado'),(428,6,'Usuarios','Logout','2024-07-15 00:46:23','Usuario  des-logueado'),(429,6,'Usuarios','Login','2024-07-15 09:27:05','Usuario  logueado'),(430,6,'Usuarios','Logout','2024-07-15 15:47:25','Usuario  des-logueado'),(431,6,'Usuarios','Login','2024-07-15 15:51:49','Usuario  logueado'),(432,6,'Credito','Pagar','2024-07-15 17:20:41','Credito Pagado'),(433,6,'Usuarios','Logout','2024-07-15 17:30:31','Usuario  des-logueado'),(434,6,'Usuarios','Login','2024-07-15 17:30:53','Usuario  logueado'),(435,6,'Usuarios','Logout','2024-07-15 17:52:21','Usuario  des-logueado'),(436,6,'Usuarios','Login','2024-07-15 18:34:19','Usuario  logueado'),(437,6,'Usuarios','Login','2024-07-15 20:27:03','Usuario  logueado'),(438,6,'Configuraciones','Modificar','2024-07-15 20:27:47','Configuracion dolar Modificada'),(439,6,'Configuraciones','Modificar','2024-07-15 20:28:19','Configuracion dolar Modificada'),(440,6,'Credito','Pagar','2024-07-15 20:35:05','Credito Pagado'),(441,6,'Usuarios','Login','2024-07-16 17:09:59','Usuario  logueado'),(442,6,'Permisos','Eliminar','2024-07-16 17:28:25','Permiso Eliminado'),(443,6,'Permisos','Registrar','2024-07-16 17:29:17','Permiso Registrado'),(444,6,'Permisos','Registrar','2024-07-16 17:34:59','Permiso Registrado'),(445,6,'Permisos','Eliminar','2024-07-16 17:37:00','Permiso Eliminado'),(446,6,'Permisos','Eliminar','2024-07-16 17:38:37','Permiso Eliminado'),(447,6,'Permisos','Registrar','2024-07-16 17:38:38','Permiso Registrado'),(448,6,'Permisos','Registrar','2024-07-16 17:38:58','Permiso Registrado'),(449,6,'Permisos','Eliminar','2024-07-16 17:38:59','Permiso Eliminado'),(450,6,'Permisos','Registrar','2024-07-16 17:40:29','Permiso Registrado'),(451,6,'Permisos','Eliminar','2024-07-16 17:40:40','Permiso Eliminado'),(452,6,'Permisos','Registrar','2024-07-16 17:41:44','Permiso Registrado'),(453,6,'Permisos','Eliminar','2024-07-16 17:42:10','Permiso Eliminado'),(454,6,'Permisos','Registrar','2024-07-16 17:46:39','Permiso Registrado'),(455,6,'Permisos','Registrar','2024-07-16 17:51:24','Permiso Registrado'),(456,6,'Permisos','Registrar','2024-07-16 17:51:25','Permiso Registrado'),(457,6,'Permisos','Eliminar','2024-07-16 18:11:02','Permiso Eliminado'),(458,6,'Permisos','Registrar','2024-07-16 18:11:11','Permiso Registrado'),(459,6,'Permisos','Registrar','2024-07-16 18:37:01','Permiso Registrado'),(460,6,'Permisos','Registrar','2024-07-16 18:37:37','Permiso Registrado'),(461,6,'Permisos','Registrar','2024-07-16 18:59:29','Permiso Registrado'),(462,6,'Permisos','Registrar','2024-07-16 19:09:47','Permiso Registrado'),(463,6,'Permisos','Eliminar','2024-07-16 19:11:17','Permiso Eliminado'),(464,6,'Caja','Abriendo','2024-07-16 22:07:30','Caja abierta'),(465,6,'Usuarios','Login','2024-07-16 23:52:05','Usuario  logueado'),(466,6,'Usuarios','Logout','2024-07-16 23:52:13','Usuario  des-logueado'),(467,13,'Usuarios','Login','2024-07-16 23:53:20','Usuario  logueado'),(468,6,'Usuarios','Login','2024-07-16 23:54:40','Usuario  logueado'),(469,13,'Usuarios','Logout','2024-07-16 23:57:40','Usuario  des-logueado'),(470,13,'Usuarios','Login','2024-07-16 23:57:56','Usuario  logueado'),(471,6,'Permisos','Registrar','2024-07-16 23:59:00','Permiso Registrado'),(472,6,'Permisos','Eliminar','2024-07-17 00:07:07','Permiso Eliminado'),(473,6,'Permisos','Registrar','2024-07-17 00:07:09','Permiso Registrado'),(474,6,'Permisos','Eliminar','2024-07-17 00:17:49','Permiso Eliminado'),(475,6,'Permisos','Registrar','2024-07-17 00:33:07','Permiso Registrado'),(476,13,'Usuarios','Logout','2024-07-17 00:33:22','Usuario  des-logueado'),(477,13,'Usuarios','Login','2024-07-17 00:33:44','Usuario  logueado'),(478,6,'Permisos','Registrar','2024-07-17 00:34:30','Permiso Registrado'),(479,6,'Permisos','Registrar','2024-07-17 00:36:59','Permiso Registrado'),(480,6,'Permisos','Registrar','2024-07-17 00:37:02','Permiso Registrado'),(481,6,'Permisos','Registrar','2024-07-17 00:46:08','Permiso Registrado'),(482,13,'Usuarios','Logout','2024-07-17 00:47:06','Usuario  des-logueado'),(483,13,'Usuarios','Login','2024-07-17 00:47:24','Usuario  logueado'),(484,13,'Usuarios','Logout','2024-07-17 00:47:49','Usuario  des-logueado'),(485,13,'Usuarios','Login','2024-07-17 00:48:54','Usuario  logueado'),(486,6,'Permisos','Registrar','2024-07-17 01:17:08','Permiso Registrado'),(487,6,'Permisos','Registrar','2024-07-17 01:17:33','Permiso Registrado'),(488,6,'Permisos','Eliminar','2024-07-17 01:17:45','Permiso Eliminado'),(489,6,'Permisos','Eliminar','2024-07-17 01:19:47','Permiso Eliminado'),(490,6,'Caja','Abriendo','2024-07-17 06:49:10','Caja abierta'),(491,6,'Credito','Registrar','2024-07-17 06:49:44','Credito Registrado'),(492,6,'registrar_ventas','agregar','2024-07-17 06:49:44','se agrego una venta'),(493,6,'Permisos','Registrar','2024-07-17 08:10:15','Permiso Registrado'),(494,6,'Permisos','Registrar','2024-07-17 08:10:16','Permiso Registrado'),(495,6,'Usuarios','Login','2024-07-17 09:35:58','Usuario  logueado'),(496,6,'Usuarios','Login','2024-07-17 09:38:25','Usuario  logueado'),(497,13,'Usuarios','Login','2024-07-17 09:42:09','Usuario  logueado'),(498,6,'Usuarios','Logout','2024-07-17 09:47:06','Usuario  des-logueado'),(499,6,'Usuarios','Login','2024-07-17 09:50:08','Usuario  logueado'),(500,6,'Usuarios','Login','2024-07-17 09:50:44','Usuario  logueado'),(501,13,'Usuarios','Logout','2024-07-17 09:53:43','Usuario  des-logueado'),(502,13,'Usuarios','Login','2024-07-17 09:56:39','Usuario  logueado'),(503,5,'Caja','Abriendo','2024-07-17 09:57:13','Caja abierta'),(504,6,'Usuarios','Login','2024-07-17 10:07:24','Usuario  logueado'),(505,13,'Caja','Abriendo','2024-07-17 10:08:19','Caja abierta'),(506,6,'Usuarios','Login','2024-09-14 11:11:42','Usuario  logueado'),(507,6,'Usuarios','Logout','2024-09-14 15:36:30','Usuario  des-logueado'),(508,6,'Usuarios','Login','2024-09-21 09:41:11','Usuario  logueado'),(509,6,'Usuarios','Login','2024-09-23 16:45:39','Usuario  logueado'),(510,6,'Usuarios','Login','2024-09-26 09:05:52','Usuario  logueado'),(511,6,'Usuarios','Logout','2024-09-26 14:46:41','Usuario  des-logueado'),(512,6,'Usuarios','Login','2024-09-26 14:50:30','Usuario  logueado'),(513,6,'Usuarios','Login','2024-10-14 17:56:49','Usuario  logueado');
/*!40000 ALTER TABLE `bitacora` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `caja`
--

DROP TABLE IF EXISTS `caja`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `caja` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_usuario` int NOT NULL,
  `monto_inicial` float NOT NULL,
  `monto_final` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '0',
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `estado` tinyint(1) NOT NULL DEFAULT '0',
  `fecha_cierre` datetime DEFAULT NULL,
  `monto_credito` float NOT NULL DEFAULT '0',
  `total_ventas` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id_user_idx` (`id_usuario`),
  CONSTRAINT `id_user` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `caja`
--

LOCK TABLES `caja` WRITE;
/*!40000 ALTER TABLE `caja` DISABLE KEYS */;
INSERT INTO `caja` VALUES (29,6,4000,NULL,'2024-06-23 16:21:15',1,'2024-06-23 16:22:25',0,0),(30,6,45,NULL,'2024-06-23 16:22:33',1,'2024-06-23 16:23:05',0,0),(31,6,5,'9.25','2024-06-27 16:56:16',1,'2024-06-27 16:56:53',0,1),(32,6,1000,'45','2024-06-28 10:43:50',1,'2024-06-28 11:38:02',0,1),(33,13,10,'61.75','2024-06-28 10:43:53',1,'2024-06-28 11:35:54',0,2),(34,6,100,NULL,'2024-06-28 11:41:52',1,'2024-06-28 11:41:58',0,0),(35,6,45,NULL,'2024-06-28 11:57:58',1,'2024-06-28 11:58:06',0,0),(36,6,10,NULL,'2024-06-29 08:06:54',1,'2024-06-29 08:07:10',0,0),(37,6,1000000,NULL,'2024-06-29 08:06:58',1,'2024-06-29 08:07:27',0,0),(38,6,10,NULL,'2024-06-29 08:08:36',1,'2024-06-29 08:10:22',0,0),(39,6,0,NULL,'2024-06-29 08:08:53',1,'2024-06-29 08:13:26',0,0),(40,6,9,NULL,'2024-06-29 08:13:52',1,'2024-06-29 08:14:03',0,0),(41,6,9,NULL,'2024-06-29 08:13:56',1,'2024-06-29 08:20:20',0,0),(42,6,23456,'23464.699999809265','2024-06-29 08:21:47',1,'2024-06-29 08:22:06',0,1),(43,6,0,'2651.760009765625','2024-06-29 08:24:08',1,'2024-06-29 10:05:50',0,6),(44,13,35,'2471','2024-06-29 08:28:42',1,'2024-06-29 10:05:47',0,1),(45,6,1000,'1075.8400039672852','2024-06-29 10:06:37',1,'2024-06-29 19:16:12',0,2),(46,6,1000,'1146.1600036621094','2024-06-30 17:13:00',1,'2024-07-15 20:29:36',0,3),(47,6,500,NULL,'2024-07-16 22:07:29',1,'2024-07-17 01:04:58',0,0),(48,6,500,'597.4400024414062','2024-07-17 06:49:10',1,'2024-07-17 07:17:41',2.28,1),(49,5,1600,'0','2024-07-17 09:57:13',0,NULL,0,0),(50,13,1600,'0','2024-07-17 10:08:19',0,NULL,0,0);
/*!40000 ALTER TABLE `caja` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `capital`
--

DROP TABLE IF EXISTS `capital`;
/*!50001 DROP VIEW IF EXISTS `capital`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `capital` AS SELECT 
 1 AS `capital`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `categoria`
--

DROP TABLE IF EXISTS `categoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categoria` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre` (`nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categoria`
--

LOCK TABLES `categoria` WRITE;
/*!40000 ALTER TABLE `categoria` DISABLE KEYS */;
INSERT INTO `categoria` VALUES (14,'Aseo'),(35,'Aseo Personal'),(1,'bebida'),(36,'Bebidas'),(37,'Embutidos'),(2,'empaquetados'),(38,'Enlatados'),(39,'Lácteos'),(40,'Limpieza'),(15,'miselaneos'),(41,'Snacks'),(42,'Varios');
/*!40000 ALTER TABLE `categoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clientes`
--

DROP TABLE IF EXISTS `clientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `clientes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(500) NOT NULL,
  `cedula` varchar(45) NOT NULL,
  `apellido` varchar(45) NOT NULL,
  `documento` varchar(1) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `active` tinyint DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clientes`
--

LOCK TABLES `clientes` WRITE;
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT INTO `clientes` VALUES (12,'Alejandro','30087582','Vargas','V','Avenida 15, local numero5','+584126742231',1),(13,'Jose','2912734','Lopez','V','Dirección x','+584149680074',1);
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `clientesfrecuentes`
--

DROP TABLE IF EXISTS `clientesfrecuentes`;
/*!50001 DROP VIEW IF EXISTS `clientesfrecuentes`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `clientesfrecuentes` AS SELECT 
 1 AS `idCliente`,
 1 AS `Cliente`,
 1 AS `Compras`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `configuraciones`
--

DROP TABLE IF EXISTS `configuraciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `configuraciones` (
  `id` int NOT NULL AUTO_INCREMENT,
  `llave` varchar(250) NOT NULL,
  `valor` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `configuraciones`
--

LOCK TABLES `configuraciones` WRITE;
/*!40000 ALTER TABLE `configuraciones` DISABLE KEYS */;
INSERT INTO `configuraciones` VALUES (1,'dolar','37');
/*!40000 ALTER TABLE `configuraciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `coste_productos_vendidos`
--

DROP TABLE IF EXISTS `coste_productos_vendidos`;
/*!50001 DROP VIEW IF EXISTS `coste_productos_vendidos`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `coste_productos_vendidos` AS SELECT 
 1 AS `Enero`,
 1 AS `Febrero`,
 1 AS `Marzo`,
 1 AS `Abril`,
 1 AS `Mayo`,
 1 AS `Junio`,
 1 AS `Julio`,
 1 AS `Agosto`,
 1 AS `Septiembre`,
 1 AS `Octubre`,
 1 AS `Noviembre`,
 1 AS `Diciembre`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `costo_entradas_mensuales`
--

DROP TABLE IF EXISTS `costo_entradas_mensuales`;
/*!50001 DROP VIEW IF EXISTS `costo_entradas_mensuales`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `costo_entradas_mensuales` AS SELECT 
 1 AS `Enero`,
 1 AS `Febrero`,
 1 AS `Marzo`,
 1 AS `Abril`,
 1 AS `Mayo`,
 1 AS `Junio`,
 1 AS `Julio`,
 1 AS `Agosto`,
 1 AS `Septiembre`,
 1 AS `Octubre`,
 1 AS `Noviembre`,
 1 AS `Diciembre`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `credito`
--

DROP TABLE IF EXISTS `credito`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `credito` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_rv` int NOT NULL,
  `fecha_limite` datetime NOT NULL,
  `monto_final` float NOT NULL,
  `status` tinyint NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_registro_ventas_idx` (`id_rv`),
  CONSTRAINT `id_rv` FOREIGN KEY (`id_rv`) REFERENCES `registro_ventas` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `credito`
--

LOCK TABLES `credito` WRITE;
/*!40000 ALTER TABLE `credito` DISABLE KEYS */;
INSERT INTO `credito` VALUES (3,133,'2024-07-11 00:00:00',0,0),(4,134,'2024-08-03 00:00:00',1.14,0),(5,135,'2024-08-10 00:00:00',2.28,1);
/*!40000 ALTER TABLE `credito` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `detalles_capital`
--

DROP TABLE IF EXISTS `detalles_capital`;
/*!50001 DROP VIEW IF EXISTS `detalles_capital`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `detalles_capital` AS SELECT 
 1 AS `Gastos`,
 1 AS `Ingresos`,
 1 AS `Ventas`,
 1 AS `capital`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `dinero`
--

DROP TABLE IF EXISTS `dinero`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dinero` (
  `id` int NOT NULL AUTO_INCREMENT,
  `monto` float NOT NULL,
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dinero`
--

LOCK TABLES `dinero` WRITE;
/*!40000 ALTER TABLE `dinero` DISABLE KEYS */;
INSERT INTO `dinero` VALUES (1,2795,'2024-06-22 09:11:17');
/*!40000 ALTER TABLE `dinero` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `entradas`
--

DROP TABLE IF EXISTS `entradas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `entradas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_producto` int NOT NULL,
  `id_proveedor` int NOT NULL,
  `cantidad` int NOT NULL,
  `fecha_compra` date NOT NULL,
  `fecha_vencimiento` date NOT NULL,
  `precio_compra` float NOT NULL,
  `existencia` int NOT NULL DEFAULT '0',
  `active` tinyint DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `id_producto` (`id_producto`),
  KEY `id_proveedor` (`id_proveedor`),
  CONSTRAINT `entradas_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `entradas_ibfk_2` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=120 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `entradas`
--

LOCK TABLES `entradas` WRITE;
/*!40000 ALTER TABLE `entradas` DISABLE KEYS */;
INSERT INTO `entradas` VALUES (106,39,8,5,'2024-06-24','2024-07-04',6.8,0,1),(107,31,8,5,'2024-06-24','2024-07-02',4.9,0,1),(108,32,8,4,'2024-06-24','2024-08-30',6,0,1),(109,36,8,1,'2024-06-24','2024-07-04',21,0,1),(110,36,8,8,'2024-06-28','2024-07-06',5,0,1),(111,31,8,10,'2024-06-29','2024-07-18',5,0,1),(112,36,16,15,'2024-06-29','2024-06-29',26,15,1),(113,31,16,16,'2024-06-29','2024-06-29',12,0,1),(114,31,8,50,'2024-06-29','2024-07-27',28,7,1),(115,33,16,10,'2024-06-29','2024-07-01',5,10,1),(116,33,16,10,'2024-06-29','2024-07-01',5,10,1),(117,1,8,1,'2024-06-29','2024-07-30',12,0,1),(118,35,8,0,'2024-06-29','2025-02-05',10,0,1),(119,36,16,20,'2024-07-10','2024-08-31',15,20,1);
/*!40000 ALTER TABLE `entradas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `factura`
--

DROP TABLE IF EXISTS `factura`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `factura` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_registro_ventas` int NOT NULL,
  `id_productos` int NOT NULL,
  `cantidad` int NOT NULL,
  `coste_producto_total` float NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_productos_has_registro_ventas_registro_ventas1_idx` (`id_registro_ventas`),
  KEY `fk_productos_has_registro_ventas_productos1_idx` (`id_productos`),
  CONSTRAINT `fk_productos_has_registro_ventas_productos1` FOREIGN KEY (`id_productos`) REFERENCES `productos` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_productos_has_registro_ventas_registro_ventas1` FOREIGN KEY (`id_registro_ventas`) REFERENCES `registro_ventas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `factura`
--

LOCK TABLES `factura` WRITE;
/*!40000 ALTER TABLE `factura` DISABLE KEYS */;
INSERT INTO `factura` VALUES (50,115,31,1,7.35),(51,116,32,1,9.25),(52,117,31,1,7.35),(53,118,31,1,7.35),(54,119,32,3,27.75),(55,120,39,5,34),(56,121,36,9,45),(57,122,31,1,7.5),(58,123,31,2,15),(59,124,31,2,15),(60,125,31,2,15),(61,126,31,2,15),(62,127,31,3,126),(63,129,31,50,2100),(64,129,31,50,2100),(65,130,31,1,42),(66,131,1,1,27.118),(67,132,31,1,42),(68,133,31,1,42),(69,134,31,1,42),(70,135,31,2,84);
/*!40000 ALTER TABLE `factura` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `ganacias_mensuales`
--

DROP TABLE IF EXISTS `ganacias_mensuales`;
/*!50001 DROP VIEW IF EXISTS `ganacias_mensuales`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `ganacias_mensuales` AS SELECT 
 1 AS `Enero`,
 1 AS `Febrero`,
 1 AS `Marzo`,
 1 AS `Abril`,
 1 AS `Mayo`,
 1 AS `Junio`,
 1 AS `Julio`,
 1 AS `Agosto`,
 1 AS `Septiembre`,
 1 AS `Octubre`,
 1 AS `Noviembre`,
 1 AS `Diciembre`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `marcas`
--

DROP TABLE IF EXISTS `marcas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `marcas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `marcas`
--

LOCK TABLES `marcas` WRITE;
/*!40000 ALTER TABLE `marcas` DISABLE KEYS */;
INSERT INTO `marcas` VALUES (1,'polar'),(3,'Juana'),(12,'La cristal'),(13,'Empresas Polar'),(14,'Juana'),(15,'La Pastora'),(16,'PepsiCo'),(17,'Grupo Mavesa'),(18,'Alfonso Rivas & Cía'),(19,'The Coca-Cola Company'),(20,'Colgate'),(21,'Alident'),(22,'Maggi'),(23,'Kraft Foods'),(24,'Minalba'),(25,'Underwood'),(26,'Margarita'),(27,'Grán Marquez'),(28,'El Gustazo, C.A'),(29,'Plumrose'),(30,'La Especial');
/*!40000 ALTER TABLE `marcas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `max_ventas`
--

DROP TABLE IF EXISTS `max_ventas`;
/*!50001 DROP VIEW IF EXISTS `max_ventas`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `max_ventas` AS SELECT 
 1 AS `id`,
 1 AS `nombre`,
 1 AS `unidad_valor`,
 1 AS `unidad`,
 1 AS `marca`,
 1 AS `cantidad`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `metodo_pago`
--

DROP TABLE IF EXISTS `metodo_pago`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `metodo_pago` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `active` tinyint NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `metodo_pago`
--

LOCK TABLES `metodo_pago` WRITE;
/*!40000 ALTER TABLE `metodo_pago` DISABLE KEYS */;
INSERT INTO `metodo_pago` VALUES (7,'Transferencia',1),(8,'Efectivo',1),(9,'Divisa',1);
/*!40000 ALTER TABLE `metodo_pago` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `min_ventas`
--

DROP TABLE IF EXISTS `min_ventas`;
/*!50001 DROP VIEW IF EXISTS `min_ventas`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `min_ventas` AS SELECT 
 1 AS `id`,
 1 AS `nombre`,
 1 AS `unidad_valor`,
 1 AS `unidad`,
 1 AS `marca`,
 1 AS `cantidad`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `movimientos_capital`
--

DROP TABLE IF EXISTS `movimientos_capital`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `movimientos_capital` (
  `id` int NOT NULL AUTO_INCREMENT,
  `monto` int NOT NULL,
  `descripcion` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `movimientos_capital`
--

LOCK TABLES `movimientos_capital` WRITE;
/*!40000 ALTER TABLE `movimientos_capital` DISABLE KEYS */;
INSERT INTO `movimientos_capital` VALUES (1,-275,'Egreso por nuevas entradas','2024-06-22 17:14:04'),(4,-375,'Egreso por nuevas entradas','2024-06-22 17:37:16'),(9,-125,'Egreso por nuevas entradas','2024-06-22 17:49:47'),(10,191,'Ingreso por facturacion','2024-06-23 12:01:07'),(11,96,'Ingreso por facturacion','2024-06-23 12:32:20'),(12,96,'Ingreso por facturacion','2024-06-23 16:07:32'),(13,-75,'Egreso por nuevas entradas','2024-06-23 19:04:47'),(14,-150,'Egreso por nuevas entradas','2024-06-23 19:07:46'),(15,-300,'Egreso por nuevas entradas','2024-06-23 19:09:37'),(16,-8,'Egreso por nuevas entradas','2024-06-23 19:10:02'),(17,-34,'Egreso por nuevas entradas','2024-06-23 20:56:57'),(18,-24,'Egreso por nuevas entradas','2024-06-24 00:18:04'),(19,-24,'Egreso por nuevas entradas','2024-06-24 00:18:56'),(20,-21,'Egreso por nuevas entradas','2024-06-24 00:27:12'),(21,9,'Ingreso por facturacion','2024-06-27 16:54:40'),(22,9,'Ingreso por facturacion','2024-06-27 16:56:39'),(23,9,'Ingreso por facturacion','2024-06-27 16:57:15'),(24,9,'Ingreso por facturacion','2024-06-27 17:09:21'),(25,28,'Ingreso por facturacion','2024-06-28 10:59:41'),(26,34,'Ingreso por facturacion','2024-06-28 11:16:40'),(27,-40,'Egreso por nuevas entradas','2024-06-28 11:17:41'),(28,30,'Ingreso por facturacion','2024-06-28 11:20:22'),(29,15,'Ingreso por facturacion','2024-06-28 11:20:23'),(30,-50,'Egreso por nuevas entradas','2024-06-28 23:11:35'),(31,9,'Ingreso por facturacion','2024-06-29 08:21:55'),(32,17,'Ingreso por facturacion','2024-06-29 08:24:08'),(33,17,'Ingreso por facturacion','2024-06-29 08:24:09'),(34,17,'Ingreso por facturacion','2024-06-29 08:24:09'),(35,17,'Ingreso por facturacion','2024-06-29 08:24:10'),(36,-390,'Egreso por nuevas entradas','2024-06-29 08:25:35'),(37,-192,'Egreso por nuevas entradas','2024-06-29 08:26:03'),(38,-1400,'Egreso por nuevas entradas','2024-06-29 08:26:14'),(39,146,'Ingreso por facturacion','2024-06-29 08:26:44'),(40,2436,'Ingreso por facturacion','2024-06-29 08:29:48'),(41,2436,'Ingreso por facturacion','2024-06-29 08:29:48'),(42,-50,'Egreso por nuevas entradas','2024-06-29 10:01:47'),(43,-50,'Egreso por nuevas entradas','2024-06-29 10:01:47'),(44,49,'Ingreso por facturacion','2024-06-29 10:06:45'),(45,-12,'Egreso por nuevas entradas','2024-06-29 12:46:32'),(46,0,'Egreso por nuevas entradas','2024-06-29 12:51:43'),(47,27,'Ingreso por facturacion','2024-06-29 13:22:09'),(48,49,'Ingreso por facturacion','2024-06-30 17:13:43'),(49,0,'Egreso por credito','2024-06-30 18:19:42'),(50,50,'ififiyfgiyg','2024-07-08 19:23:55'),(51,50,'monto de prueba','2024-07-08 19:27:42'),(55,-31,'ascasc','2024-07-08 19:39:50'),(56,-31,'resto','2024-07-08 19:44:47'),(57,31,'asccs','2024-07-08 19:46:42'),(58,-31,'acsac','2024-07-08 19:46:54'),(59,-300,'Egreso por nuevas entradas','2024-07-10 17:50:31'),(60,-1,'Egreso por credito','2024-07-13 14:19:00'),(61,1,'Ingreso por facturacion','2024-07-15 17:20:41'),(62,0,'Ingreso por facturacion','2024-07-15 20:35:05'),(63,-2,'Egreso por credito','2024-07-17 06:49:44'),(64,97,'ingreso por caja48','2024-07-17 07:17:41');
/*!40000 ALTER TABLE `movimientos_capital` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notificaciones`
--

DROP TABLE IF EXISTS `notificaciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `notificaciones` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_usuario` int NOT NULL,
  `status` tinyint(1) NOT NULL,
  `mensaje` varchar(250) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notificaciones`
--

LOCK TABLES `notificaciones` WRITE;
/*!40000 ALTER TABLE `notificaciones` DISABLE KEYS */;
INSERT INTO `notificaciones` VALUES (32,1,1,'La entrada con ID 106 vence en 10 días.','2024-06-24 17:05:00'),(33,1,1,'La entrada con ID 109 vence en 10 días.','2024-06-24 17:05:00'),(34,1,1,'La entrada con ID 106 vence en 5 días.','2024-06-29 10:04:00'),(35,1,1,'La entrada con ID 109 vence en 5 días.','2024-06-29 10:04:00'),(36,1,0,'La entrada con ID 112 vence hoy.','2024-06-29 10:04:00'),(37,1,0,'La entrada con ID 113 vence hoy.','2024-06-29 10:04:00'),(38,1,0,'La entrada con ID 115 vence en 2 días.','2024-06-29 10:04:00'),(39,1,0,'La entrada con ID 116 vence en 2 días.','2024-06-29 10:04:00'),(40,1,0,'La entrada con ID 107 vence en 2 días.','2024-06-30 21:38:28'),(41,1,0,'La entrada con ID 106 vence hoy.','2024-07-04 19:40:37'),(42,1,1,'La entrada con ID 109 vence hoy.','2024-07-04 19:40:37'),(43,1,1,'La entrada con ID 110 vence en 2 días.','2024-07-04 19:40:37'),(44,1,1,'La entrada con ID 110 vence hoy.','2024-07-06 10:30:53'),(50,1,0,'El lote con numero 107 del producto Azucar vence en 30 días.','2024-07-07 16:16:36'),(51,1,0,'El lote con numero 115 del producto Arroz vence en 7 días.','2024-07-08 17:02:09'),(52,1,1,'El lote con numero 116 del producto Arroz vence en 7 días.','2024-07-08 17:02:09'),(53,1,0,'El lote con numero 112 del producto Glup vence en 15 días.','2024-07-14 21:02:29'),(54,1,0,'El lote con numero 114 del producto Azucar vence hoy.','2024-07-27 00:04:27'),(55,1,0,'El lote con numero 114 del producto Azucar vence en 30 días.','2024-08-01 19:22:47'),(56,1,0,'El lote con numero 114 del producto Azucar vence en 7 días.','2024-08-03 21:38:15'),(57,1,0,'El lote con numero 114 del producto Azucar vence en 15 días.','2024-08-11 10:03:55'),(58,1,0,'El lote con numero 114 del producto Azucar vence en 15 días.','2024-08-11 10:04:00'),(59,1,0,'El lote con numero 119 del producto Glup vence hoy.','2024-08-31 18:31:36'),(60,1,0,'El lote con numero 119 del producto Glup vence en 30 días.','2024-09-05 14:50:10'),(61,1,0,'El lote con numero 119 del producto Glup vence en 7 días.','2024-09-07 16:12:27'),(62,1,0,'El lote con numero 119 del producto Glup vence en 15 días.','2024-09-15 10:51:05');
/*!40000 ALTER TABLE `notificaciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pagos`
--

DROP TABLE IF EXISTS `pagos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pagos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_venta` int NOT NULL,
  `id_metodo_pago` int NOT NULL,
  `monto` float NOT NULL,
  `fecha` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id_venta_idx` (`id_venta`),
  KEY `id_metodo_pago_idx` (`id_metodo_pago`),
  CONSTRAINT `id_metodo_pago` FOREIGN KEY (`id_metodo_pago`) REFERENCES `metodo_pago` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `id_venta` FOREIGN KEY (`id_venta`) REFERENCES `registro_ventas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pagos`
--

LOCK TABLES `pagos` WRITE;
/*!40000 ALTER TABLE `pagos` DISABLE KEYS */;
INSERT INTO `pagos` VALUES (35,115,7,8.53,'2024-07-08 18:12:35'),(36,116,7,9.25,'2024-07-08 18:12:35'),(37,117,7,8.53,'2024-07-08 18:12:35'),(38,118,7,8.53,'2024-07-08 18:12:35'),(39,119,7,27.75,'2024-07-08 18:12:35'),(40,120,7,34,'2024-07-08 18:12:35'),(41,121,7,30,'2024-07-08 18:12:35'),(42,121,8,15,'2024-07-08 18:12:35'),(43,122,7,8.7,'2024-07-08 18:12:35'),(44,123,7,17.4,'2024-07-08 18:12:35'),(45,124,7,17.4,'2024-07-08 18:12:35'),(46,125,7,17.4,'2024-07-08 18:12:35'),(47,126,7,17.4,'2024-07-08 18:12:35'),(48,127,7,146.16,'2024-07-08 18:12:35'),(49,129,7,2436,'2024-07-08 18:12:35'),(50,129,7,2436,'2024-07-08 18:12:35'),(51,130,7,48.72,'2024-07-08 18:12:35'),(52,131,7,27.12,'2024-07-08 18:12:35'),(53,132,7,48.72,'2024-07-08 18:12:35'),(54,134,9,1.14,'2024-07-15 17:20:41'),(55,133,7,0,'2024-07-15 20:35:05');
/*!40000 ALTER TABLE `pagos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permisos`
--

DROP TABLE IF EXISTS `permisos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permisos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_usuario` int NOT NULL,
  `tabla` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `permiso` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_usuarios_idx` (`id_usuario`),
  CONSTRAINT `id_usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permisos`
--

LOCK TABLES `permisos` WRITE;
/*!40000 ALTER TABLE `permisos` DISABLE KEYS */;
INSERT INTO `permisos` VALUES (57,13,'caja','agregar'),(58,13,'caja','modificar');
/*!40000 ALTER TABLE `permisos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `productos`
--

DROP TABLE IF EXISTS `productos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `productos` (
  `id` int NOT NULL AUTO_INCREMENT,
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
  `algoritmo` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre` (`nombre`),
  KEY `id_categoria_idx` (`id_categoria`),
  KEY `id_stock_max_min_idx` (`id_unidad`),
  KEY `id_marca_idx` (`id_marca`),
  CONSTRAINT `id_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `id_marca` FOREIGN KEY (`id_marca`) REFERENCES `marcas` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `id_unidad` FOREIGN KEY (`id_unidad`) REFERENCES `unidades` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productos`
--

LOCK TABLES `productos` WRITE;
/*!40000 ALTER TABLE `productos` DISABLE KEYS */;
INSERT INTO `productos` VALUES (1,1,1,1,150,'pan','banner_productos.png',5,10,27.118,0,0,0.3,'123456789012',2),(31,1,2,1,1,'Azucar','producto_Azucar_5e5294ee-d7d2-424d-ac2e-5802bbad41ab.jpeg',5,10,42,1,1,0.5,'',1),(32,2,2,1,1,'Harina','producto_Harina_harina-pan.jpg',10,20,NULL,0,1,0,'111111111111',2),(33,14,2,1,1,'Arroz','producto_Arroz_B325-Arroz-Mary-Tradicional-1Kg-1.jpg',5,10,15,0,1,0,'111111111111',NULL),(34,2,2,12,1,'Pasta','producto_Pasta_arroz.jpeg',5,20,15,0,1,0,'',NULL),(35,1,2,1,10,'Hfgrtg','banner_productos.png',1,12,10,1,0,0,'111111111111',NULL),(36,1,1,1,1,'Glup','producto_Alcohol_ImgThumb.jpg',5,10,15,0,1,0,'754123698547',1),(37,14,1,1,1,'mmaamama','producto_mmaamama_leche-en-polvo-la-campiña-250g_pic299027ni0t0.jpg',8,78,25,1,0,0,'785412369524',1),(38,2,2,3,1,'pollo','producto_pollo_DIABLITOS-UNDERWOOD.jpg',8,78,85,0,1,0,'785412369524',1),(39,2,1,1,30,'Atun','producto_Atun_unnamed (1).jpg',2,6,6.8,0,1,0,'123456788888',1),(40,14,33,1,10,'Coca Cola','producto_Coca Cola_7594005430045.jpg',1,12,10,1,1,0,'111111111111',1),(41,42,34,15,1,'Mayonesa','producto_Mayonesa_A450-Mayonesa-Mavesa-910g-768x768.jpg',1,12,NULL,1,1,0,'111111111111',1);
/*!40000 ALTER TABLE `productos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proveedores`
--

DROP TABLE IF EXISTS `proveedores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `proveedores` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `razon_social` varchar(50) NOT NULL DEFAULT 'natural',
  `rif` varchar(15) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `direccion` varchar(45) NOT NULL,
  `active` tinyint DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proveedores`
--

LOCK TABLES `proveedores` WRITE;
/*!40000 ALTER TABLE `proveedores` DISABLE KEYS */;
INSERT INTO `proveedores` VALUES (1,'tyrty','nn','J-00000000','1231231231','nose@gmail.com','54764576',0),(7,'montecarmelo','Montecarmelo','J-00000000','0000000','garnicaluis391@gmail.com','scacac',0),(8,'Jose','Pan','J-00000000','1231231231','ald@gmail.com','mmmda',1),(9,'Alejandro','Tunal','V-30087582','+584126742231','garnicaluis391@gmail.com','Avenida 15, local numero5',0),(14,'Lorenzo','Hearshi','E-15930218','+584125915587','polar@gmail.com','Direccion tal',0),(15,'Mendoza','Chocolate','V-15930218','+584125915587','polar@gmail.com','Direccion tal',0),(16,'Miguel Perezz','Tunal','V-14368987','+584124573864','eltunal@gmail.com','carrera 10, cruce calle 15, casa S/N',1);
/*!40000 ALTER TABLE `proveedores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `ratio_ventas`
--

DROP TABLE IF EXISTS `ratio_ventas`;
/*!50001 DROP VIEW IF EXISTS `ratio_ventas`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `ratio_ventas` AS SELECT 
 1 AS `id`,
 1 AS `nombre`,
 1 AS `unidad_valor`,
 1 AS `unidad`,
 1 AS `marca`,
 1 AS `ratio_ventas`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `registro_ventas`
--

DROP TABLE IF EXISTS `registro_ventas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `registro_ventas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `monto_final` float NOT NULL,
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_cliente` int NOT NULL,
  `id_caja` int NOT NULL,
  `IVA` float NOT NULL DEFAULT '0',
  `active` tinyint NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `id_cliente_idx` (`id_cliente`),
  KEY `id_caja_idx` (`id_caja`),
  CONSTRAINT `id_caja` FOREIGN KEY (`id_caja`) REFERENCES `caja` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `id_cliente` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=136 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `registro_ventas`
--

LOCK TABLES `registro_ventas` WRITE;
/*!40000 ALTER TABLE `registro_ventas` DISABLE KEYS */;
INSERT INTO `registro_ventas` VALUES (115,8.53,'2024-06-27 16:54:39',12,30,1.18,1),(116,9.25,'2024-06-27 16:56:39',12,31,0,1),(117,8.53,'2024-06-27 16:57:14',12,31,1.18,1),(118,8.53,'2024-06-27 17:09:21',12,31,1.18,1),(119,27.75,'2024-06-28 10:59:41',12,33,0,1),(120,34,'2024-06-28 11:16:40',12,33,0,1),(121,45,'2024-06-28 11:20:22',12,32,0,1),(122,8.7,'2024-06-29 08:21:55',13,42,1.2,1),(123,17.4,'2024-06-29 08:24:08',13,43,2.4,1),(124,17.4,'2024-06-29 08:24:09',13,43,2.4,1),(125,17.4,'2024-06-29 08:24:09',13,43,2.4,1),(126,17.4,'2024-06-29 08:24:10',13,43,2.4,1),(127,146.16,'2024-06-29 08:26:44',13,43,20.16,1),(128,2436,'2024-06-29 08:29:48',13,44,336,1),(129,2436,'2024-06-29 08:29:48',13,43,336,1),(130,48.72,'2024-06-29 10:06:44',12,45,6.72,1),(131,27.12,'2024-06-29 13:22:09',13,45,0,1),(132,48.72,'2024-06-30 17:13:43',12,46,6.72,1),(133,48.72,'2024-06-30 18:19:42',12,46,6.72,0),(134,48.72,'2024-07-13 14:19:00',12,46,6.72,0),(135,97.44,'2024-07-17 06:49:43',12,48,13.44,0);
/*!40000 ALTER TABLE `registro_ventas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `rotacion_inventario`
--

DROP TABLE IF EXISTS `rotacion_inventario`;
/*!50001 DROP VIEW IF EXISTS `rotacion_inventario`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `rotacion_inventario` AS SELECT 
 1 AS `Enero`,
 1 AS `Febrero`,
 1 AS `Marzo`,
 1 AS `Abril`,
 1 AS `Mayo`,
 1 AS `Junio`,
 1 AS `Julio`,
 1 AS `Agosto`,
 1 AS `Septiembre`,
 1 AS `Octubre`,
 1 AS `Noviembre`,
 1 AS `Diciembre`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `total_productos_categoria`
--

DROP TABLE IF EXISTS `total_productos_categoria`;
/*!50001 DROP VIEW IF EXISTS `total_productos_categoria`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `total_productos_categoria` AS SELECT 
 1 AS `categoria`,
 1 AS `total_productos`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `total_stock_categoria`
--

DROP TABLE IF EXISTS `total_stock_categoria`;
/*!50001 DROP VIEW IF EXISTS `total_stock_categoria`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `total_stock_categoria` AS SELECT 
 1 AS `id`,
 1 AS `nombre`,
 1 AS `total`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `unidades`
--

DROP TABLE IF EXISTS `unidades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `unidades` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `unidades`
--

LOCK TABLES `unidades` WRITE;
/*!40000 ALTER TABLE `unidades` DISABLE KEYS */;
INSERT INTO `unidades` VALUES (1,'g'),(2,'Kg'),(30,'Pan'),(32,'ml'),(33,'L'),(34,'Unit'),(35,'caja');
/*!40000 ALTER TABLE `unidades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `correo` varchar(45) NOT NULL,
  `hash` text NOT NULL,
  `rol` int NOT NULL DEFAULT '3',
  `active` tinyint NOT NULL DEFAULT '1',
  `semilla` varchar(45) NOT NULL,
  `sesion_id` varchar(145) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (5,'asd','jaja@gmail.com','$2y$10$fdgc0QZ4YyBMB3ix3jV5AOesVSZFCRrTZ.UUHr61qjviWGq7zi7h2',1,1,'',''),(6,'Edouard','nose@gmail.com','$2y$10$ey1aHUkj5We8D34bQSoAZesKdwW6tv26V9K.DtkHBfVrQFE7Wzj/e',1,1,'MSKR0rIA3x95JGubVUWk','GjZPrEfatO'),(7,'John','johnconnor@gmail.com','$2y$10$EgZWh1WmrpMGrsF9K2DjyeL5YTds6aS3.Rku/.h8P7wk7ltODzf9e',2,1,'',''),(10,'Alfredo','alfredo@gmail.com','$2y$10$8nUZSX2kXCVysLvCLirVyuhfeUSB0uICkZsl3kiDJY4kqlZCI8DKu',2,1,'',''),(12,'Juan','depanajuaner@gmail.com','$2y$10$W7XfRH4IOSoK.KP67LnOUuaN4DzXX7jRwF4QfQxphpqCd38xVSDbu',1,1,'MSKR0rIA3x95JGubVUWq',''),(13,'Vanessa','yfvy87@gmail.com','$2y$10$HZR6p6T5mhr0l.W0UnFcCeO1wDGD6wrrpPCmAcVoIRUYQbHDLIJC2',2,1,'z1juwnyJTFxdCAGB3ihY','zxBrTVucCA'),(40,'Luis','garnicaluis391@gmail.com','$2y$10$xF7UceeLhEfDtQqzOpjCM.gmLUXqOciQIBx0UfUglvRn9dMToVEBe',1,1,'W6sTV8t5Qpz7jrRULZ3O',''),(48,'Miguel','miguel@gmail.com','$2y$10$4pIwTcd0BFED9icBrund9usH/wg1UJKLsQIXrMAKUUFyhtXg74nwO',1,1,'yVnBjaFJXbO0sWLtMkKv','');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `valor_promedio_inventario_mensual`
--

DROP TABLE IF EXISTS `valor_promedio_inventario_mensual`;
/*!50001 DROP VIEW IF EXISTS `valor_promedio_inventario_mensual`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `valor_promedio_inventario_mensual` AS SELECT 
 1 AS `Enero`,
 1 AS `Febrero`,
 1 AS `Marzo`,
 1 AS `Abril`,
 1 AS `Mayo`,
 1 AS `Junio`,
 1 AS `Julio`,
 1 AS `Agosto`,
 1 AS `Septiembre`,
 1 AS `Octubre`,
 1 AS `Noviembre`,
 1 AS `Diciembre`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `valortotalinventario`
--

DROP TABLE IF EXISTS `valortotalinventario`;
/*!50001 DROP VIEW IF EXISTS `valortotalinventario`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `valortotalinventario` AS SELECT 
 1 AS `nombre`,
 1 AS `valor`*/;
SET character_set_client = @saved_cs_client;

--
-- Final view structure for view `capital`
--

/*!50001 DROP VIEW IF EXISTS `capital`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `capital` AS select round(sum(`movimientos_capital`.`monto`),2) AS `capital` from `movimientos_capital` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `clientesfrecuentes`
--

/*!50001 DROP VIEW IF EXISTS `clientesfrecuentes`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `clientesfrecuentes` AS select (select `registro_ventas`.`id_cliente`) AS `idCliente`,(select `clientes`.`nombre` from `clientes` where (`clientes`.`id` = `registro_ventas`.`id_cliente`)) AS `Cliente`,(select count(0) from `registro_ventas` where (`registro_ventas`.`id_cliente` = `idCliente`)) AS `Compras` from `registro_ventas` group by `registro_ventas`.`id_cliente` order by (select count(0) from `registro_ventas` where (`registro_ventas`.`id_cliente` = `idCliente`)) desc limit 5 */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `coste_productos_vendidos`
--

/*!50001 DROP VIEW IF EXISTS `coste_productos_vendidos`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `coste_productos_vendidos` AS select coalesce(round(sum((case when (month(`rv`.`fecha`) = 1) then `p`.`monto` else 0 end)),2),0) AS `Enero`,coalesce(round(sum((case when (month(`rv`.`fecha`) = 2) then `p`.`monto` else 0 end)),2),0) AS `Febrero`,coalesce(round(sum((case when (month(`rv`.`fecha`) = 3) then `p`.`monto` else 0 end)),2),0) AS `Marzo`,coalesce(round(sum((case when (month(`rv`.`fecha`) = 4) then `p`.`monto` else 0 end)),2),0) AS `Abril`,coalesce(round(sum((case when (month(`rv`.`fecha`) = 5) then `p`.`monto` else 0 end)),2),0) AS `Mayo`,coalesce(round(sum((case when (month(`rv`.`fecha`) = 6) then `p`.`monto` else 0 end)),2),0) AS `Junio`,coalesce(round(sum((case when (month(`rv`.`fecha`) = 7) then `p`.`monto` else 0 end)),2),0) AS `Julio`,coalesce(round(sum((case when (month(`rv`.`fecha`) = 8) then `p`.`monto` else 0 end)),2),0) AS `Agosto`,coalesce(round(sum((case when (month(`rv`.`fecha`) = 9) then `p`.`monto` else 0 end)),2),0) AS `Septiembre`,coalesce(round(sum((case when (month(`rv`.`fecha`) = 10) then `p`.`monto` else 0 end)),2),0) AS `Octubre`,coalesce(round(sum((case when (month(`rv`.`fecha`) = 11) then `p`.`monto` else 0 end)),2),0) AS `Noviembre`,coalesce(round(sum((case when (month(`rv`.`fecha`) = 12) then `p`.`monto` else 0 end)),2),0) AS `Diciembre` from (`pagos` `p` join `registro_ventas` `rv` on((`p`.`id_venta` = `rv`.`id`))) where (year(`rv`.`fecha`) = year(now())) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `costo_entradas_mensuales`
--

/*!50001 DROP VIEW IF EXISTS `costo_entradas_mensuales`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `costo_entradas_mensuales` AS select coalesce(round(sum((case when (month(`e`.`fecha_compra`) = 1) then `e`.`precio_compra` else 0 end)),2),0) AS `Enero`,coalesce(round(sum((case when (month(`e`.`fecha_compra`) = 2) then `e`.`precio_compra` else 0 end)),2),0) AS `Febrero`,coalesce(round(sum((case when (month(`e`.`fecha_compra`) = 3) then `e`.`precio_compra` else 0 end)),2),0) AS `Marzo`,coalesce(round(sum((case when (month(`e`.`fecha_compra`) = 4) then `e`.`precio_compra` else 0 end)),2),0) AS `Abril`,coalesce(round(sum((case when (month(`e`.`fecha_compra`) = 5) then `e`.`precio_compra` else 0 end)),2),0) AS `Mayo`,coalesce(round(sum((case when (month(`e`.`fecha_compra`) = 6) then `e`.`precio_compra` else 0 end)),2),0) AS `Junio`,coalesce(round(sum((case when (month(`e`.`fecha_compra`) = 7) then `e`.`precio_compra` else 0 end)),2),0) AS `Julio`,coalesce(round(sum((case when (month(`e`.`fecha_compra`) = 8) then `e`.`precio_compra` else 0 end)),2),0) AS `Agosto`,coalesce(round(sum((case when (month(`e`.`fecha_compra`) = 9) then `e`.`precio_compra` else 0 end)),2),0) AS `Septiembre`,coalesce(round(sum((case when (month(`e`.`fecha_compra`) = 10) then `e`.`precio_compra` else 0 end)),2),0) AS `Octubre`,coalesce(round(sum((case when (month(`e`.`fecha_compra`) = 11) then `e`.`precio_compra` else 0 end)),2),0) AS `Noviembre`,coalesce(round(sum((case when (month(`e`.`fecha_compra`) = 12) then `e`.`precio_compra` else 0 end)),2),0) AS `Diciembre` from `entradas` `e` where (year(`e`.`fecha_compra`) = year(now())) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `detalles_capital`
--

/*!50001 DROP VIEW IF EXISTS `detalles_capital`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `detalles_capital` AS select (select round(sum((case when (`m`.`monto` like '-%') then `m`.`monto` else 0 end)),2) from `movimientos_capital` `m`) AS `Gastos`,(select round(sum((case when (not((`m`.`monto` like '-%'))) then `m`.`monto` else 0 end)),2) AS `Ingresos` from `movimientos_capital` `m`) AS `Ingresos`,(select coalesce(round(sum(`p`.`monto`),2),0) from `pagos` `p`) AS `Ventas`,(select `dinero`.`monto` from `dinero`) AS `capital` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `ganacias_mensuales`
--

/*!50001 DROP VIEW IF EXISTS `ganacias_mensuales`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `ganacias_mensuales` AS select (select coalesce(round((sum(`m`.`monto`) + (select sum(`m`.`monto`) from `movimientos_capital` `m` where ((`m`.`monto` like '-%') and (month(`m`.`fecha`) = 1)))),2),0) from `movimientos_capital` `m` where ((not((`m`.`monto` like '-%'))) and (month(`m`.`fecha`) = 1))) AS `Enero`,(select coalesce(round((sum(`m`.`monto`) + (select sum(`m`.`monto`) from `movimientos_capital` `m` where ((`m`.`monto` like '-%') and (month(`m`.`fecha`) = 2)))),2),0) from `movimientos_capital` `m` where ((not((`m`.`monto` like '-%'))) and (month(`m`.`fecha`) = 2))) AS `Febrero`,(select coalesce(round((sum(`m`.`monto`) + (select sum(`m`.`monto`) from `movimientos_capital` `m` where ((`m`.`monto` like '-%') and (month(`m`.`fecha`) = 3)))),2),0) from `movimientos_capital` `m` where ((not((`m`.`monto` like '-%'))) and (month(`m`.`fecha`) = 3))) AS `Marzo`,(select coalesce(round((sum(`m`.`monto`) + (select sum(`m`.`monto`) from `movimientos_capital` `m` where ((`m`.`monto` like '-%') and (month(`m`.`fecha`) = 4)))),2),0) from `movimientos_capital` `m` where ((not((`m`.`monto` like '-%'))) and (month(`m`.`fecha`) = 4))) AS `Abril`,(select coalesce(round((sum(`m`.`monto`) + (select sum(`m`.`monto`) from `movimientos_capital` `m` where ((`m`.`monto` like '-%') and (month(`m`.`fecha`) = 5)))),2),0) from `movimientos_capital` `m` where ((not((`m`.`monto` like '-%'))) and (month(`m`.`fecha`) = 5))) AS `Mayo`,(select coalesce(round((sum(`m`.`monto`) + (select sum(`m`.`monto`) from `movimientos_capital` `m` where ((`m`.`monto` like '-%') and (month(`m`.`fecha`) = 6)))),2),0) from `movimientos_capital` `m` where ((not((`m`.`monto` like '-%'))) and (month(`m`.`fecha`) = 6))) AS `Junio`,(select coalesce(round((sum(`m`.`monto`) + (select sum(`m`.`monto`) from `movimientos_capital` `m` where ((`m`.`monto` like '-%') and (month(`m`.`fecha`) = 7)))),2),0) from `movimientos_capital` `m` where ((not((`m`.`monto` like '-%'))) and (month(`m`.`fecha`) = 7))) AS `Julio`,(select coalesce(round((sum(`m`.`monto`) + (select sum(`m`.`monto`) from `movimientos_capital` `m` where ((`m`.`monto` like '-%') and (month(`m`.`fecha`) = 8)))),2),0) from `movimientos_capital` `m` where ((not((`m`.`monto` like '-%'))) and (month(`m`.`fecha`) = 8))) AS `Agosto`,(select coalesce(round((sum(`m`.`monto`) + (select sum(`m`.`monto`) from `movimientos_capital` `m` where ((`m`.`monto` like '-%') and (month(`m`.`fecha`) = 9)))),2),0) from `movimientos_capital` `m` where ((not((`m`.`monto` like '-%'))) and (month(`m`.`fecha`) = 9))) AS `Septiembre`,(select coalesce(round((sum(`m`.`monto`) + (select sum(`m`.`monto`) from `movimientos_capital` `m` where ((`m`.`monto` like '-%') and (month(`m`.`fecha`) = 10)))),2),0) from `movimientos_capital` `m` where ((not((`m`.`monto` like '-%'))) and (month(`m`.`fecha`) = 10))) AS `Octubre`,(select coalesce(round((sum(`m`.`monto`) + (select sum(`m`.`monto`) from `movimientos_capital` `m` where ((`m`.`monto` like '-%') and (month(`m`.`fecha`) = 11)))),2),0) from `movimientos_capital` `m` where ((not((`m`.`monto` like '-%'))) and (month(`m`.`fecha`) = 11))) AS `Noviembre`,(select coalesce(round((sum(`m`.`monto`) + (select sum(`m`.`monto`) from `movimientos_capital` `m` where ((`m`.`monto` like '-%') and (month(`m`.`fecha`) = 12)))),2),0) from `movimientos_capital` `m` where ((not((`m`.`monto` like '-%'))) and (month(`m`.`fecha`) = 12))) AS `Diciembre` from `movimientos_capital` `m` where (year(`m`.`fecha`) = year(now())) limit 1 */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `max_ventas`
--

/*!50001 DROP VIEW IF EXISTS `max_ventas`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `max_ventas` AS select `p`.`id` AS `id`,`p`.`nombre` AS `nombre`,`p`.`valor_unidad` AS `unidad_valor`,(select `unidades`.`nombre` from `unidades` where (`unidades`.`id` = `p`.`id_unidad`)) AS `unidad`,(select `marcas`.`nombre` from `marcas` where (`marcas`.`id` = `p`.`id_marca`)) AS `marca`,(select sum(`f`.`cantidad`) from `factura` `f` where (`f`.`id_productos` = `p`.`id`)) AS `cantidad` from `productos` `p` where (`p`.`active` = 1) order by (select sum(`f`.`cantidad`) from `factura` `f` where (`f`.`id_productos` = `p`.`id`)) desc limit 5 */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `min_ventas`
--

/*!50001 DROP VIEW IF EXISTS `min_ventas`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `min_ventas` AS select `p`.`id` AS `id`,`p`.`nombre` AS `nombre`,`p`.`valor_unidad` AS `unidad_valor`,(select `unidades`.`nombre` from `unidades` where (`unidades`.`id` = `p`.`id_unidad`)) AS `unidad`,(select `marcas`.`nombre` from `marcas` where (`marcas`.`id` = `p`.`id_marca`)) AS `marca`,(select sum(`f`.`cantidad`) from `factura` `f` where (`f`.`id_productos` = `p`.`id`)) AS `cantidad` from `productos` `p` where ((`p`.`active` = 1) and ((select sum(`f`.`cantidad`) from `factura` `f` where (`f`.`id_productos` = `p`.`id`)) is not null)) order by (select sum(`f`.`cantidad`) from `factura` `f` where (`f`.`id_productos` = `p`.`id`)) limit 5 */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `ratio_ventas`
--

/*!50001 DROP VIEW IF EXISTS `ratio_ventas`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `ratio_ventas` AS select `p`.`id` AS `id`,`p`.`nombre` AS `nombre`,`p`.`valor_unidad` AS `unidad_valor`,(select `unidades`.`nombre` from `unidades` where (`unidades`.`id` = `p`.`id_unidad`)) AS `unidad`,(select `marcas`.`nombre` from `marcas` where (`marcas`.`id` = `p`.`id_marca`)) AS `marca`,(1 - ((select sum(`c`.`existencia`) from `entradas` `c` where (`c`.`id_producto` = `p`.`id`)) / (select sum(`a`.`cantidad`) from `entradas` `a` where (`a`.`id_producto` = `p`.`id`)))) AS `ratio_ventas` from `productos` `p` where (`p`.`active` = 1) limit 5 */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `rotacion_inventario`
--

/*!50001 DROP VIEW IF EXISTS `rotacion_inventario`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `rotacion_inventario` AS select coalesce(round(((select sum(`p`.`monto`) from (`pagos` `p` join `registro_ventas` `rv` on((`p`.`id_venta` = `rv`.`id`))) where (month(`rv`.`fecha`) = 1)) / (select sum((`e`.`existencia` * `e`.`precio_compra`)) from `entradas` `e` where (month(`e`.`fecha_compra`) = 1))),2),0) AS `Enero`,coalesce(round(((select sum(`p`.`monto`) from (`pagos` `p` join `registro_ventas` `rv` on((`p`.`id_venta` = `rv`.`id`))) where (month(`rv`.`fecha`) = 2)) / (select sum((`e`.`existencia` * `e`.`precio_compra`)) from `entradas` `e` where (month(`e`.`fecha_compra`) = 2))),2),0) AS `Febrero`,coalesce(round(((select sum(`p`.`monto`) from (`pagos` `p` join `registro_ventas` `rv` on((`p`.`id_venta` = `rv`.`id`))) where (month(`rv`.`fecha`) = 3)) / (select sum((`e`.`existencia` * `e`.`precio_compra`)) from `entradas` `e` where (month(`e`.`fecha_compra`) = 3))),2),0) AS `Marzo`,coalesce(round(((select sum(`p`.`monto`) from (`pagos` `p` join `registro_ventas` `rv` on((`p`.`id_venta` = `rv`.`id`))) where (month(`rv`.`fecha`) = 4)) / (select sum((`e`.`existencia` * `e`.`precio_compra`)) from `entradas` `e` where (month(`e`.`fecha_compra`) = 4))),2),0) AS `Abril`,coalesce(round(((select sum(`p`.`monto`) from (`pagos` `p` join `registro_ventas` `rv` on((`p`.`id_venta` = `rv`.`id`))) where (month(`rv`.`fecha`) = 5)) / (select sum((`e`.`existencia` * `e`.`precio_compra`)) from `entradas` `e` where (month(`e`.`fecha_compra`) = 5))),2),0) AS `Mayo`,coalesce(round(((select sum(`p`.`monto`) from (`pagos` `p` join `registro_ventas` `rv` on((`p`.`id_venta` = `rv`.`id`))) where (month(`rv`.`fecha`) = 6)) / (select sum((`e`.`existencia` * `e`.`precio_compra`)) from `entradas` `e` where (month(`e`.`fecha_compra`) = 6))),2),0) AS `Junio`,coalesce(round(((select sum(`p`.`monto`) from (`pagos` `p` join `registro_ventas` `rv` on((`p`.`id_venta` = `rv`.`id`))) where (month(`rv`.`fecha`) = 7)) / (select sum((`e`.`existencia` * `e`.`precio_compra`)) from `entradas` `e` where (month(`e`.`fecha_compra`) = 7))),2),0) AS `Julio`,coalesce(round(((select sum(`p`.`monto`) from (`pagos` `p` join `registro_ventas` `rv` on((`p`.`id_venta` = `rv`.`id`))) where (month(`rv`.`fecha`) = 8)) / (select sum((`e`.`existencia` * `e`.`precio_compra`)) from `entradas` `e` where (month(`e`.`fecha_compra`) = 8))),2),0) AS `Agosto`,coalesce(round(((select sum(`p`.`monto`) from (`pagos` `p` join `registro_ventas` `rv` on((`p`.`id_venta` = `rv`.`id`))) where (month(`rv`.`fecha`) = 9)) / (select sum((`e`.`existencia` * `e`.`precio_compra`)) from `entradas` `e` where (month(`e`.`fecha_compra`) = 9))),2),0) AS `Septiembre`,coalesce(round(((select sum(`p`.`monto`) from (`pagos` `p` join `registro_ventas` `rv` on((`p`.`id_venta` = `rv`.`id`))) where (month(`rv`.`fecha`) = 10)) / (select sum((`e`.`existencia` * `e`.`precio_compra`)) from `entradas` `e` where (month(`e`.`fecha_compra`) = 10))),2),0) AS `Octubre`,coalesce(round(((select sum(`p`.`monto`) from (`pagos` `p` join `registro_ventas` `rv` on((`p`.`id_venta` = `rv`.`id`))) where (month(`rv`.`fecha`) = 11)) / (select sum((`e`.`existencia` * `e`.`precio_compra`)) from `entradas` `e` where (month(`e`.`fecha_compra`) = 11))),2),0) AS `Noviembre`,coalesce(round(((select sum(`p`.`monto`) from (`pagos` `p` join `registro_ventas` `rv` on((`p`.`id_venta` = `rv`.`id`))) where (month(`rv`.`fecha`) = 12)) / (select sum((`e`.`existencia` * `e`.`precio_compra`)) from `entradas` `e` where (month(`e`.`fecha_compra`) = 12))),2),0) AS `Diciembre` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `total_productos_categoria`
--

/*!50001 DROP VIEW IF EXISTS `total_productos_categoria`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `total_productos_categoria` AS select `c`.`nombre` AS `categoria`,count(`p`.`id`) AS `total_productos` from (`categoria` `c` left join `productos` `p` on((`c`.`id` = `p`.`id_categoria`))) where (`p`.`active` = 1) group by `c`.`id`,`c`.`nombre` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `total_stock_categoria`
--

/*!50001 DROP VIEW IF EXISTS `total_stock_categoria`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `total_stock_categoria` AS select `c`.`id` AS `id`,`c`.`nombre` AS `nombre`,(select sum((select sum(`e`.`existencia`) from `entradas` `e` where (`e`.`id_producto` = `p`.`id`))) from `productos` `p` where (`p`.`id_categoria` = `c`.`id`)) AS `total` from `categoria` `c` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `valor_promedio_inventario_mensual`
--

/*!50001 DROP VIEW IF EXISTS `valor_promedio_inventario_mensual`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `valor_promedio_inventario_mensual` AS select coalesce(round((select sum((`e`.`existencia` * `e`.`precio_compra`)) from `entradas` `e` where (month(`e`.`fecha_compra`) = 1)),0),0) AS `Enero`,coalesce(round((select sum((`e`.`existencia` * `e`.`precio_compra`)) from `entradas` `e` where (month(`e`.`fecha_compra`) = 2)),0),0) AS `Febrero`,coalesce(round((select sum((`e`.`existencia` * `e`.`precio_compra`)) from `entradas` `e` where (month(`e`.`fecha_compra`) = 3)),0),0) AS `Marzo`,coalesce(round((select sum((`e`.`existencia` * `e`.`precio_compra`)) from `entradas` `e` where (month(`e`.`fecha_compra`) = 4)),0),0) AS `Abril`,coalesce(round((select sum((`e`.`existencia` * `e`.`precio_compra`)) from `entradas` `e` where (month(`e`.`fecha_compra`) = 5)),0),0) AS `Mayo`,coalesce(round((select sum((`e`.`existencia` * `e`.`precio_compra`)) from `entradas` `e` where (month(`e`.`fecha_compra`) = 6)),0),0) AS `Junio`,coalesce(round((select sum((`e`.`existencia` * `e`.`precio_compra`)) from `entradas` `e` where (month(`e`.`fecha_compra`) = 7)),0),0) AS `Julio`,coalesce(round((select sum((`e`.`existencia` * `e`.`precio_compra`)) from `entradas` `e` where (month(`e`.`fecha_compra`) = 8)),0),0) AS `Agosto`,coalesce(round((select sum((`e`.`existencia` * `e`.`precio_compra`)) from `entradas` `e` where (month(`e`.`fecha_compra`) = 9)),0),0) AS `Septiembre`,coalesce(round((select sum((`e`.`existencia` * `e`.`precio_compra`)) from `entradas` `e` where (month(`e`.`fecha_compra`) = 10)),0),0) AS `Octubre`,coalesce(round((select sum((`e`.`existencia` * `e`.`precio_compra`)) from `entradas` `e` where (month(`e`.`fecha_compra`) = 11)),0),0) AS `Noviembre`,coalesce(round((select sum((`e`.`existencia` * `e`.`precio_compra`)) from `entradas` `e` where (month(`e`.`fecha_compra`) = 12)),0),0) AS `Diciembre` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `valortotalinventario`
--

/*!50001 DROP VIEW IF EXISTS `valortotalinventario`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `valortotalinventario` AS select (select `categoria`.`nombre` from `categoria` where (`categoria`.`id` = `p`.`id_categoria`)) AS `nombre`,round(sum(((select sum(`e`.`existencia`) from `entradas` `e` where (`e`.`id_producto` = `p`.`id`)) * `p`.`precio_venta`)),2) AS `valor` from `productos` `p` group by `p`.`id_categoria` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-10-15 23:24:24
