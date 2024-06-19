-- MySQL dump 10.13  Distrib 8.0.34, for Win64 (x86_64)
--
-- Host: localhost    Database: proyecto_3
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
  `tabla` varchar(45) NOT NULL,
  `accion` varchar(45) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `detalles` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_usuario_idx` (`id_usuario`),
  CONSTRAINT `id_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=utf8mb4
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bitacora`
--

LOCK TABLES `bitacora` WRITE;
/*!40000 ALTER TABLE `bitacora` DISABLE KEYS */;
INSERT INTO `bitacora` VALUES (30,6,'Metodos de Pago','Registrar','2024-06-15 21:48:14','Metodo de Pago Registrado'),(31,6,'Login','logueado','2024-06-16 09:34:45','El usuario Edouard inicio sesion'),(32,6,'Proveedor','Desactivado','2024-06-16 09:34:56','Proveedor14 Eliminado'),(33,6,'Metodo de Pago','Eliminar','2024-06-16 09:39:04','Metodo de Pago 9 Eliminado'),(34,6,'Metodo de Pago','Modificar','2024-06-16 09:39:11','Metodo de Pago 8 Modificado'),(35,6,'deslogin','des-logueado','2024-06-16 13:40:53','el usuario Edouard se des-logueo'),(36,6,'Login','logueado','2024-06-16 13:41:08','El usuario Edouard inicio sesion'),(37,6,'Cliente','Registrar','2024-06-16 14:03:12','Cliente Registrado'),(38,6,'Login','logueado','2024-06-16 19:38:56','El usuario Edouard inicio sesion'),(39,6,'Pagos','Registrar','2024-06-16 22:08:24','Pago Registrado'),(40,6,'registrar_ventas','agregar','2024-06-16 22:08:24','se agrego una venta'),(41,6,'deslogin','des-logueado','2024-06-16 23:05:10','el usuario Edouard se des-logueo'),(42,6,'Login','logueado','2024-06-16 23:06:17','El usuario Edouard inicio sesion'),(43,6,'Usuarios','Registrar','2024-06-16 23:07:42','Usuario Registrado'),(44,6,'deslogin','des-logueado','2024-06-16 23:07:52','el usuario Edouard se des-logueo'),(45,6,'Login','logueado','2024-06-16 23:08:32','El usuario Edouard inicio sesion'),(46,6,'Usuarios','Registrar','2024-06-16 23:09:10','Usuario Registrado'),(47,6,'deslogin','des-logueado','2024-06-16 23:09:16','el usuario Edouard se des-logueo'),(48,10,'Login','logueado','2024-06-16 23:09:24','El usuario Alfredo inicio sesion'),(49,10,'deslogin','des-logueado','2024-06-16 23:23:16','el usuario Alfredo se des-logueo'),(50,6,'Login','logueado','2024-06-16 23:23:23','El usuario Edouard inicio sesion'),(51,6,'Usuarios','Eliminados','2024-06-17 00:57:07','Usuario  Eliminado'),(52,6,'Usuarios','Eliminados','2024-06-17 00:57:14','Usuario  Eliminado'),(53,6,'deslogin','des-logueado','2024-06-17 08:49:32','el usuario Edouard se des-logueo'),(54,6,'Login','logueado','2024-06-17 08:55:31','El usuario Edouard inicio sesion'),(55,6,'Usuarios','Registrar','2024-06-17 08:59:16','Usuario Registrado'),(56,6,'Marcas','Registrar','2024-06-17 09:07:48','Marca Registrada'),(57,6,'deslogin','des-logueado','2024-06-17 10:16:39','el usuario Edouard se des-logueo'),(58,6,'Login','logueado','2024-06-17 10:19:24','El usuario Edouard inicio sesion'),(59,6,'Login','logueado','2024-06-18 10:41:53','El usuario Edouard inicio sesion'),(60,6,'Pagos','Registrar','2024-06-18 11:37:59','Pago Registrado'),(61,6,'Pagos','Registrar','2024-06-18 11:37:59','Pago Registrado'),(62,6,'registrar_ventas','agregar','2024-06-18 11:37:59','se agrego una venta'),(63,6,'Metodo de Pago','Modificar','2024-06-18 11:43:21','Metodo de Pago 7 Modificado'),(64,6,'Metodo de Pago','Modificar','2024-06-18 11:43:27','Metodo de Pago 8 Modificado'),(65,6,'deslogin','des-logueado','2024-06-18 11:49:36','el usuario Edouard se des-logueo'),(66,6,'Login','logueado','2024-06-18 11:50:04','El usuario Edouard inicio sesion'),(67,6,'Pagos','Registrar','2024-06-18 11:55:45','Pago Registrado'),(68,6,'registrar_ventas','agregar','2024-06-18 11:55:45','se agrego una venta'),(69,6,'deslogin','des-logueado','2024-06-18 11:56:18','el usuario Edouard se des-logueo'),(70,10,'Login','logueado','2024-06-18 11:56:37','El usuario Alfredo inicio sesion'),(71,10,'deslogin','des-logueado','2024-06-18 12:04:44','el usuario Alfredo se des-logueo'),(72,6,'Login','logueado','2024-06-18 18:42:34','El usuario Edouard inicio sesion'),(73,6,'deslogin','des-logueado','2024-06-19 00:03:02','el usuario Edouard se des-logueo'),(74,6,'Login','logueado','2024-06-19 00:03:25','El usuario Edouard inicio sesion'),(75,6,'Pagos','Registrar','2024-06-19 00:36:21','Pago Registrado'),(76,6,'registrar_ventas','agregar','2024-06-19 00:36:21','se agrego una venta');
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
  `monto_inicial` varchar(45) NOT NULL,
  `monto_final` varchar(45) NOT NULL,
  `fecha` datetime NOT NULL,
  `status` blob NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_user_idx` (`id_usuario`),
  CONSTRAINT `id_user` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `caja`
--

LOCK TABLES `caja` WRITE;
/*!40000 ALTER TABLE `caja` DISABLE KEYS */;
/*!40000 ALTER TABLE `caja` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categoria`
--

LOCK TABLES `categoria` WRITE;
/*!40000 ALTER TABLE `categoria` DISABLE KEYS */;
INSERT INTO `categoria` VALUES (1,'bebida'),(2,'empaquetados');
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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clientes`
--

LOCK TABLES `clientes` WRITE;
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT INTO `clientes` VALUES (12,'Alejandro','30087582','Vargas','V','Avenida 15, local numero5','+584126742231',1);
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `configuracion`
--

DROP TABLE IF EXISTS `configuracion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `configuracion` (
  `id` int NOT NULL AUTO_INCREMENT,
  `monto_capital` varchar(45) NOT NULL,
  `monto_dolar_paralelo` varchar(45) NOT NULL,
  `monto_dolar_bcv` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `configuracion`
--

LOCK TABLES `configuracion` WRITE;
/*!40000 ALTER TABLE `configuracion` DISABLE KEYS */;
/*!40000 ALTER TABLE `configuracion` ENABLE KEYS */;
UNLOCK TABLES;

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
  `status` blob NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_registro_ventas_idx` (`id_rv`),
  CONSTRAINT `id_rv` FOREIGN KEY (`id_rv`) REFERENCES `registro_ventas` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `credito`
--

LOCK TABLES `credito` WRITE;
/*!40000 ALTER TABLE `credito` DISABLE KEYS */;
/*!40000 ALTER TABLE `credito` ENABLE KEYS */;
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
  CONSTRAINT `entradas_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id`),
  CONSTRAINT `entradas_ibfk_2` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedores` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `entradas`
--

LOCK TABLES `entradas` WRITE;
/*!40000 ALTER TABLE `entradas` DISABLE KEYS */;
INSERT INTO `entradas` VALUES (67,31,8,5,'2024-05-27','2024-06-29',15,0,1),(68,32,8,2,'2024-05-27','2024-06-29',5,0,1),(69,33,8,5,'2024-05-27','2024-07-06',9,0,1),(70,31,8,5,'2024-05-26','2024-07-06',10,5,1),(71,34,8,5,'2024-05-26','2024-07-27',15,5,1),(72,31,8,215,'2024-06-06','2024-07-05',21,210,1);
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
  CONSTRAINT `fk_productos_has_registro_ventas_productos1` FOREIGN KEY (`id_productos`) REFERENCES `productos` (`id`),
  CONSTRAINT `fk_productos_has_registro_ventas_registro_ventas1` FOREIGN KEY (`id_registro_ventas`) REFERENCES `registro_ventas` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `factura`
--

LOCK TABLES `factura` WRITE;
/*!40000 ALTER TABLE `factura` DISABLE KEYS */;
INSERT INTO `factura` VALUES (1,59,31,2,20.02);
/*!40000 ALTER TABLE `factura` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `marcas`
--

DROP TABLE IF EXISTS `marcas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `marcas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `marcas`
--

LOCK TABLES `marcas` WRITE;
/*!40000 ALTER TABLE `marcas` DISABLE KEYS */;
INSERT INTO `marcas` VALUES (1,'polar'),(3,'Juana'),(12,'La cristal');
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
  `nombre` varchar(45) NOT NULL,
  `active` tinyint NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4
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
  `descripcion` varchar(200) NOT NULL,
  `fecha` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `movimientos_capital`
--

LOCK TABLES `movimientos_capital` WRITE;
/*!40000 ALTER TABLE `movimientos_capital` DISABLE KEYS */;
/*!40000 ALTER TABLE `movimientos_capital` ENABLE KEYS */;
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
  PRIMARY KEY (`id`),
  KEY `id_venta_idx` (`id_venta`),
  KEY `id_metodo_pago_idx` (`id_metodo_pago`),
  CONSTRAINT `id_metodo_pago` FOREIGN KEY (`id_metodo_pago`) REFERENCES `metodo_pago` (`id`),
  CONSTRAINT `id_venta` FOREIGN KEY (`id_venta`) REFERENCES `registro_ventas` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pagos`
--

LOCK TABLES `pagos` WRITE;
/*!40000 ALTER TABLE `pagos` DISABLE KEYS */;
INSERT INTO `pagos` VALUES (1,59,7,23.22);
/*!40000 ALTER TABLE `pagos` ENABLE KEYS */;
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
  `precio_venta` float NOT NULL DEFAULT '0',
  `IVA` tinyint NOT NULL,
  `active` tinyint DEFAULT '1',
  `ganancia` float NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre` (`nombre`),
  KEY `id_categoria_idx` (`id_categoria`),
  KEY `id_stock_max_min_idx` (`id_unidad`),
  KEY `id_marca_idx` (`id_marca`),
  CONSTRAINT `id_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id`),
  CONSTRAINT `id_marca` FOREIGN KEY (`id_marca`) REFERENCES `marcas` (`id`),
  CONSTRAINT `id_unidad` FOREIGN KEY (`id_unidad`) REFERENCES `unidades` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productos`
--

LOCK TABLES `productos` WRITE;
/*!40000 ALTER TABLE `productos` DISABLE KEYS */;
INSERT INTO `productos` VALUES (1,1,1,1,150,'pan','afafef',5,10,15,0,1,0),(31,1,2,1,1,'Azucar','producto_Azucar_5e5294ee-d7d2-424d-ac2e-5802bbad41ab.jpeg',5,10,10.01,1,1,0),(32,2,2,3,1,'Harina','producto_Harina_2551fe44-3bc1-476e-b084-e7ff84eb8600.jpeg',10,20,10.01,0,1,0),(33,2,2,1,1,'Arroz','producto_Arroz_2c51307c-9d9f-41fb-9419-1e61a44891f0.jpeg',5,10,15.01,0,1,0),(34,2,2,12,1,'Pasta','producto_Pasta_arroz.jpeg',5,20,15,0,1,0);
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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proveedores`
--

LOCK TABLES `proveedores` WRITE;
/*!40000 ALTER TABLE `proveedores` DISABLE KEYS */;
INSERT INTO `proveedores` VALUES (1,'tyrty','nn','J-00000000','1231231231','nose@gmail.com','54764576',0),(7,'montecarmelo','Montecarmelo','J-00000000','0000000','garnicaluis391@gmail.com','scacac',0),(8,'Jose','Pan','J-00000000','1231231231','ald@gmail.com','mmmda',1),(9,'Alejandro','Tunal','V-30087582','+584126742231','garnicaluis391@gmail.com','Avenida 15, local numero5',0),(14,'Lorenzo','Hearshi','E-15930218','+584125915587','polar@gmail.com','Direccion tal',0),(15,'Mendoza','Chocolate','V-15930218','+584125915587','polar@gmail.com','Direccion tal',0);
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
  `id_usuario` int NOT NULL,
  `id_caja` int DEFAULT NULL,
  `IVA` float NOT NULL DEFAULT '0',
  `active` tinyint NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `id_cliente_idx` (`id_cliente`),
  KEY `id_usuario_idx` (`id_usuario`),
  KEY `id_caja_idx` (`id_caja`),
  CONSTRAINT `id_caja` FOREIGN KEY (`id_caja`) REFERENCES `caja` (`id`),
  CONSTRAINT `id_cliente` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id`),
  CONSTRAINT `id_usuario2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `registro_ventas`
--

LOCK TABLES `registro_ventas` WRITE;
/*!40000 ALTER TABLE `registro_ventas` DISABLE KEYS */;
INSERT INTO `registro_ventas` VALUES (59,23.22,'2024-06-19 00:36:21',12,6,NULL,3.2,1);
/*!40000 ALTER TABLE `registro_ventas` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `unidades`
--

LOCK TABLES `unidades` WRITE;
/*!40000 ALTER TABLE `unidades` DISABLE KEYS */;
INSERT INTO `unidades` VALUES (1,'g'),(2,'Kg'),(30,'Pan');
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (5,'asd','jaja@gmail.com','$2y$10$fdgc0QZ4YyBMB3ix3jV5AOesVSZFCRrTZ.UUHr61qjviWGq7zi7h2',1,1,''),(6,'Edouard','nose@gmail.com','$2y$10$7L2.rmi.NOr9wz7vSo1SYu58aIcXZLOVZkfZ2sZPx1moc4vfMjQBW',1,1,''),(7,'John','johnconnor@gmail.com','$2y$10$EgZWh1WmrpMGrsF9K2DjyeL5YTds6aS3.Rku/.h8P7wk7ltODzf9e',2,1,''),(10,'Alfredo','alfredo@gmail.com','$2y$10$8nUZSX2kXCVysLvCLirVyuhfeUSB0uICkZsl3kiDJY4kqlZCI8DKu',2,1,''),(11,'Pedro','garnicaluis391@gmail.com','$2y$10$hK9fotzmkm/BvMtkUEiK0e8kdG/PtmF13R.Wpn.lIRWC29F1c1i3m',1,1,'');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Final view structure for view `max_ventas`
--

/*!50001 DROP VIEW IF EXISTS `max_ventas`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `max_ventas` AS select `p`.`id` AS `id`,`p`.`nombre` AS `nombre`,`p`.`valor_unidad` AS `unidad_valor`,(select `unidades`.`nombre` from `unidades` where (`unidades`.`id` = `p`.`id_unidad`)) AS `unidad`,(select `marcas`.`nombre` from `marcas` where (`marcas`.`id` = `p`.`id_marca`)) AS `marca`,(select sum(`f`.`cantidad`) from `factura` `f` where (`f`.`id_productos` = `p`.`id`)) AS `cantidad` from `productos` `p` where (`p`.`active` = 1) order by (select sum(`f`.`cantidad`) from `factura` `f` where (`f`.`id_productos` = `p`.`id`)) desc */;
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
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `min_ventas` AS select `p`.`id` AS `id`,`p`.`nombre` AS `nombre`,`p`.`valor_unidad` AS `unidad_valor`,(select `unidades`.`nombre` from `unidades` where (`unidades`.`id` = `p`.`id_unidad`)) AS `unidad`,(select `marcas`.`nombre` from `marcas` where (`marcas`.`id` = `p`.`id_marca`)) AS `marca`,(select sum(`f`.`cantidad`) from `factura` `f` where (`f`.`id_productos` = `p`.`id`)) AS `cantidad` from `productos` `p` where (`p`.`active` = 1) order by (select sum(`f`.`cantidad`) from `factura` `f` where (`f`.`id_productos` = `p`.`id`)) */;
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
/*!50001 VIEW `ratio_ventas` AS select `p`.`id` AS `id`,`p`.`nombre` AS `nombre`,(1 - ((select sum(`c`.`existencia`) from `entradas` `c` where (`c`.`id_producto` = `p`.`id`)) / (select sum(`a`.`cantidad`) from `entradas` `a` where (`a`.`id_producto` = `p`.`id`)))) AS `ratio_ventas` from `productos` `p` where (`p`.`active` = 1) */;
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
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-06-19  0:39:14
