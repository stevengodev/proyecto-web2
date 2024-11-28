-- MySQL dump 10.13  Distrib 8.0.29, for Win64 (x86_64)
--
-- Host: localhost    Database: proyectofinal
-- ------------------------------------------------------
-- Server version	8.0.29

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `categorias`
--

DROP TABLE IF EXISTS `categorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categorias` (
  `identificador` int NOT NULL,
  `nombre` varchar(45) NOT NULL,
  PRIMARY KEY (`identificador`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categorias`
--

LOCK TABLES `categorias` WRITE;
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
INSERT INTO `categorias` VALUES (1,'Kinesicos'),(2,'Fisioterapeuticos');
/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `citas`
--

DROP TABLE IF EXISTS `citas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `citas` (
  `identificador` int NOT NULL AUTO_INCREMENT,
  `fecha` datetime NOT NULL,
  `tipoidentificacionprofesional` enum('I','C','E') DEFAULT NULL,
  `identificacionprofesional` varchar(10) DEFAULT NULL,
  `tipoidentificacioncliente` enum('I','C','E') NOT NULL,
  `identificacioncliente` varchar(10) NOT NULL,
  PRIMARY KEY (`identificador`),
  KEY `fk_citas_profesional1` (`tipoidentificacionprofesional`,`identificacionprofesional`),
  KEY `fk_citas_cliente1` (`tipoidentificacioncliente`,`identificacioncliente`),
  CONSTRAINT `fk_citas_cliente1` FOREIGN KEY (`tipoidentificacioncliente`, `identificacioncliente`) REFERENCES `clientes` (`tipoidentificacion`, `identificacion`),
  CONSTRAINT `fk_citas_profesional1` FOREIGN KEY (`tipoidentificacionprofesional`, `identificacionprofesional`) REFERENCES `profesionales` (`tipoidentificacion`, `identificacion`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `citas`
--

LOCK TABLES `citas` WRITE;
/*!40000 ALTER TABLE `citas` DISABLE KEYS */;
INSERT INTO `citas` VALUES (2,'2010-10-19 00:00:00',NULL,NULL,'C','1'),(15,'2000-10-10 00:00:00',NULL,NULL,'C','1'),(16,'2009-10-10 00:00:00',NULL,NULL,'C','1'),(17,'2020-10-10 00:00:00',NULL,NULL,'C','1');
/*!40000 ALTER TABLE `citas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clientes`
--

DROP TABLE IF EXISTS `clientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `clientes` (
  `tipoidentificacion` enum('I','C','E') NOT NULL,
  `identificacion` varchar(10) NOT NULL,
  `nombres` varchar(60) NOT NULL,
  `apellidos` varchar(60) NOT NULL,
  `correo` varchar(45) NOT NULL,
  `celular` varchar(12) NOT NULL,
  `fechaNacimiento` date NOT NULL,
  `nombresAcompañante` varchar(60) DEFAULT NULL,
  `apellidosAcompañante` varchar(60) DEFAULT NULL,
  `fechaNacimientoAcompañante` date DEFAULT NULL,
  PRIMARY KEY (`tipoidentificacion`,`identificacion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clientes`
--

LOCK TABLES `clientes` WRITE;
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT INTO `clientes` VALUES ('C','1','X','X','X','X','2020-10-10','y','y',NULL);
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `diagnosticos`
--

DROP TABLE IF EXISTS `diagnosticos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `diagnosticos` (
  `identificador` int NOT NULL,
  `peso` float NOT NULL,
  `presionarterial` float NOT NULL,
  `diagnostico` text NOT NULL,
  `numerosesiones` int NOT NULL,
  `citaId` int NOT NULL,
  PRIMARY KEY (`identificador`),
  KEY `fk_diagnosticos_citas1` (`citaId`),
  CONSTRAINT `fk_diagnosticos_citas1` FOREIGN KEY (`citaId`) REFERENCES `citas` (`identificador`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `diagnosticos`
--

LOCK TABLES `diagnosticos` WRITE;
/*!40000 ALTER TABLE `diagnosticos` DISABLE KEYS */;
INSERT INTO `diagnosticos` VALUES (1,27,100,'aaaaaaaaaa',10,2),(2,20,100,'bbbbbbbb',10,2);
/*!40000 ALTER TABLE `diagnosticos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `diagnosticosservicios`
--

DROP TABLE IF EXISTS `diagnosticosservicios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `diagnosticosservicios` (
  `diagnosticoId` int NOT NULL,
  `servicioId` int NOT NULL,
  PRIMARY KEY (`diagnosticoId`,`servicioId`),
  KEY `fk_diagnostico_has_servicios_servicios1` (`servicioId`),
  CONSTRAINT `fk_diagnostico_has_servicios_diagnostico1` FOREIGN KEY (`diagnosticoId`) REFERENCES `diagnosticos` (`identificador`),
  CONSTRAINT `fk_diagnostico_has_servicios_servicios1` FOREIGN KEY (`servicioId`) REFERENCES `servicios` (`identificador`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `diagnosticosservicios`
--

LOCK TABLES `diagnosticosservicios` WRITE;
/*!40000 ALTER TABLE `diagnosticosservicios` DISABLE KEYS */;
/*!40000 ALTER TABLE `diagnosticosservicios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `elementos`
--

DROP TABLE IF EXISTS `elementos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `elementos` (
  `identificador` int NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `costo` int NOT NULL,
  `tipo` enum('reactivo','maquina','materia prima') NOT NULL,
  PRIMARY KEY (`identificador`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `elementos`
--

LOCK TABLES `elementos` WRITE;
/*!40000 ALTER TABLE `elementos` DISABLE KEYS */;
INSERT INTO `elementos` VALUES (1,'aceite',200,'reactivo');
/*!40000 ALTER TABLE `elementos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `elementosservicios`
--

DROP TABLE IF EXISTS `elementosservicios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `elementosservicios` (
  `elementoId` int NOT NULL,
  `servicioId` int NOT NULL,
  PRIMARY KEY (`elementoId`,`servicioId`),
  KEY `fk_elementos_has_servicios_servicios1` (`servicioId`),
  CONSTRAINT `fk_elementos_has_servicios_elementos1` FOREIGN KEY (`elementoId`) REFERENCES `elementos` (`identificador`),
  CONSTRAINT `fk_elementos_has_servicios_servicios1` FOREIGN KEY (`servicioId`) REFERENCES `servicios` (`identificador`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `elementosservicios`
--

LOCK TABLES `elementosservicios` WRITE;
/*!40000 ALTER TABLE `elementosservicios` DISABLE KEYS */;
/*!40000 ALTER TABLE `elementosservicios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `empleados`
--

DROP TABLE IF EXISTS `empleados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `empleados` (
  `tipoidentificacion` enum('I','C','E') NOT NULL,
  `identificacion` varchar(10) NOT NULL,
  `nombres` varchar(45) NOT NULL,
  `apellidos` varchar(45) NOT NULL,
  `tipo` enum('secretaria','gerente','admin') NOT NULL,
  PRIMARY KEY (`tipoidentificacion`,`identificacion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empleados`
--

LOCK TABLES `empleados` WRITE;
/*!40000 ALTER TABLE `empleados` DISABLE KEYS */;
/*!40000 ALTER TABLE `empleados` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estudios`
--

DROP TABLE IF EXISTS `estudios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `estudios` (
  `identificador` int NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `tipoidentificacionprofesional` enum('I','C','E') NOT NULL,
  `identificacionprofesional` varchar(10) NOT NULL,
  PRIMARY KEY (`identificador`),
  KEY `fk_estudios_profesional1` (`tipoidentificacionprofesional`,`identificacionprofesional`),
  CONSTRAINT `fk_estudios_profesional1` FOREIGN KEY (`tipoidentificacionprofesional`, `identificacionprofesional`) REFERENCES `profesionales` (`tipoidentificacion`, `identificacion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estudios`
--

LOCK TABLES `estudios` WRITE;
/*!40000 ALTER TABLE `estudios` DISABLE KEYS */;
/*!40000 ALTER TABLE `estudios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `experticias`
--

DROP TABLE IF EXISTS `experticias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `experticias` (
  `identificador` int NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `tipoidentificacionprofesional` enum('I','C','E') NOT NULL,
  `identificacionprofesional` varchar(10) NOT NULL,
  PRIMARY KEY (`identificador`),
  KEY `fk_experticias_profesional1` (`tipoidentificacionprofesional`,`identificacionprofesional`),
  CONSTRAINT `fk_experticias_profesional1` FOREIGN KEY (`tipoidentificacionprofesional`, `identificacionprofesional`) REFERENCES `profesionales` (`tipoidentificacion`, `identificacion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `experticias`
--

LOCK TABLES `experticias` WRITE;
/*!40000 ALTER TABLE `experticias` DISABLE KEYS */;
/*!40000 ALTER TABLE `experticias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profesionales`
--

DROP TABLE IF EXISTS `profesionales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `profesionales` (
  `tipoidentificacion` enum('I','C','E') NOT NULL,
  `identificacion` varchar(10) NOT NULL,
  `nombres` varchar(45) NOT NULL,
  `apellidos` varchar(45) NOT NULL,
  `celular` varchar(12) DEFAULT NULL,
  PRIMARY KEY (`tipoidentificacion`,`identificacion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profesionales`
--

LOCK TABLES `profesionales` WRITE;
/*!40000 ALTER TABLE `profesionales` DISABLE KEYS */;
/*!40000 ALTER TABLE `profesionales` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `servicios`
--

DROP TABLE IF EXISTS `servicios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `servicios` (
  `identificador` int NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `descripcion` varchar(45) NOT NULL,
  `porcentaje` int NOT NULL,
  `costoTotal` int NOT NULL,
  `precio` int NOT NULL,
  `ganancia` int NOT NULL,
  `estado` enum('activo','inactivo') DEFAULT NULL,
  `categoriaId` int NOT NULL,
  `peso` enum('baja','sube') DEFAULT NULL,
  `presionarterial` enum('baja','sube') DEFAULT NULL,
  `evolucion` enum('positiva','negativa') DEFAULT NULL,
  PRIMARY KEY (`identificador`),
  KEY `fk_servicios_categorias1` (`categoriaId`),
  CONSTRAINT `fk_servicios_categorias1` FOREIGN KEY (`categoriaId`) REFERENCES `categorias` (`identificador`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `servicios`
--

LOCK TABLES `servicios` WRITE;
/*!40000 ALTER TABLE `servicios` DISABLE KEYS */;
/*!40000 ALTER TABLE `servicios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tratamientos`
--

DROP TABLE IF EXISTS `tratamientos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tratamientos` (
  `identificador` int NOT NULL,
  `peso` float NOT NULL,
  `presionarterial` float NOT NULL,
  `sesionesrealizadas` int NOT NULL,
  `sesionesrestantes` int NOT NULL,
  `derivacion` text NOT NULL,
  `resultados` text NOT NULL,
  `diagnosticoId` int NOT NULL,
  `citaId` int NOT NULL,
  PRIMARY KEY (`identificador`),
  KEY `fk_tratamientos_diagnosticos1` (`diagnosticoId`),
  KEY `fk_tratamientos_citas1` (`citaId`),
  CONSTRAINT `fk_tratamientos_citas1` FOREIGN KEY (`citaId`) REFERENCES `citas` (`identificador`),
  CONSTRAINT `fk_tratamientos_diagnosticos1` FOREIGN KEY (`diagnosticoId`) REFERENCES `diagnosticos` (`identificador`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tratamientos`
--

LOCK TABLES `tratamientos` WRITE;
/*!40000 ALTER TABLE `tratamientos` DISABLE KEYS */;
/*!40000 ALTER TABLE `tratamientos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `usuario` varchar(45) NOT NULL,
  `contrasena` varchar(16) NOT NULL,
  `tipoidentificacioncliente` enum('I','C','E') DEFAULT NULL,
  `identificacioncliente` varchar(10) DEFAULT NULL,
  `tipoidentificacionprofesional` enum('I','C','E') DEFAULT NULL,
  `identificacionprofesional` varchar(10) DEFAULT NULL,
  `tipoidentificacionempleado` enum('I','C','E') DEFAULT NULL,
  `identificacionempleado` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`usuario`),
  KEY `fk_usuarios_clientes1` (`tipoidentificacioncliente`,`identificacioncliente`),
  KEY `fk_usuarios_profesionales1` (`tipoidentificacionprofesional`,`identificacionprofesional`),
  KEY `fk_usuarios_empleados1` (`tipoidentificacionempleado`,`identificacionempleado`),
  CONSTRAINT `fk_usuarios_clientes1` FOREIGN KEY (`tipoidentificacioncliente`, `identificacioncliente`) REFERENCES `clientes` (`tipoidentificacion`, `identificacion`),
  CONSTRAINT `fk_usuarios_empleados1` FOREIGN KEY (`tipoidentificacionempleado`, `identificacionempleado`) REFERENCES `empleados` (`tipoidentificacion`, `identificacion`),
  CONSTRAINT `fk_usuarios_profesionales1` FOREIGN KEY (`tipoidentificacionprofesional`, `identificacionprofesional`) REFERENCES `profesionales` (`tipoidentificacion`, `identificacion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ventadetalles`
--

DROP TABLE IF EXISTS `ventadetalles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ventadetalles` (
  `servicioId` int NOT NULL,
  `numerofactura` int NOT NULL,
  `precio` int NOT NULL,
  `costo` int NOT NULL,
  `ganancia` int NOT NULL,
  PRIMARY KEY (`servicioId`,`numerofactura`),
  KEY `fk_ventaDetalle_ventaEncabezado1` (`numerofactura`),
  CONSTRAINT `fk_ventaDetalle_servicios1` FOREIGN KEY (`servicioId`) REFERENCES `servicios` (`identificador`),
  CONSTRAINT `fk_ventaDetalle_ventaEncabezado1` FOREIGN KEY (`numerofactura`) REFERENCES `ventasencabezado` (`numerofactura`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ventadetalles`
--

LOCK TABLES `ventadetalles` WRITE;
/*!40000 ALTER TABLE `ventadetalles` DISABLE KEYS */;
/*!40000 ALTER TABLE `ventadetalles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ventasencabezado`
--

DROP TABLE IF EXISTS `ventasencabezado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ventasencabezado` (
  `numerofactura` int NOT NULL,
  `tipoidentificacioncliente` enum('I','C','E') NOT NULL,
  `identificacioncliente` varchar(10) NOT NULL,
  `fecha` datetime NOT NULL,
  `total` double NOT NULL,
  PRIMARY KEY (`numerofactura`,`tipoidentificacioncliente`,`identificacioncliente`),
  KEY `fk_ventaencabezado_cliente1` (`tipoidentificacioncliente`,`identificacioncliente`),
  CONSTRAINT `fk_ventaencabezado_cliente1` FOREIGN KEY (`tipoidentificacioncliente`, `identificacioncliente`) REFERENCES `clientes` (`tipoidentificacion`, `identificacion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ventasencabezado`
--

LOCK TABLES `ventasencabezado` WRITE;
/*!40000 ALTER TABLE `ventasencabezado` DISABLE KEYS */;
/*!40000 ALTER TABLE `ventasencabezado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'proyectofinal'
--
/*!50003 DROP PROCEDURE IF EXISTS `gestionarcategorias` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `gestionarcategorias`(poperacion enum('G','E','C','L'),pidentificador int,
 pnombre varchar(45))
BEGIN
   Declare vnumeroregistros int;
   
	CASE poperacion
		WHEN 'G' THEN
			  Select count(1) into vnumeroregistros
			  from categorias
			  where identificador = pidentificador;
			  
			  if (vnumeroregistros = 0) then
				 Insert Into 
				  categorias
				  values(pidentificador,pnombre);
			  elseif (vnumeroregistros = 1) then   
				 update categorias set identificador = pidentificador, nombre = pnombre
				 where identificador = pidentificador;
			 end if;  
		WHEN 'E' THEN
				Delete from categorias 
				where identificador = pidentificador;  
		WHEN 'C' THEN
				select * from categorias
                where identificador = pidentificador;
		WHEN 'L' THEN
				select * from categorias;  
	END CASE;
   
   
  
     

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `gestionarcitas` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `gestionarcitas`(poperacion enum('G','E','C','L','R','U'),pidentificador int,
 pfecha datetime,ptipoidentificacionprofesional enum('I','C','E'), pidentificacionprofesional varchar(10),
 ptipoidentificacioncliente enum('I','C','E'), pidentificacioncliente varchar(10))
BEGIN
   Declare vnumeroregistros int;
   
	CASE poperacion
		WHEN 'G' THEN
			  Select count(1) into vnumeroregistros
			  from citas
			  where identificador = pidentificador;
			  if (vnumeroregistros = 0) then
				 Insert Into 
				  citas
				  values(pidentificador,
						 pfecha,
                         ptipoidentificacionprofesional,
                         pidentificacionprofesional,
                         ptipoidentificacioncliente,
                         pidentificacioncliente);
			  elseif (vnumeroregistros = 1) then   
				 update citas set  fecha = pfecha,
                                   tipoidentificacionprofesional = ptipoidentificacionprofesional,
                                   identificacionprofesional = pidentificacionprofesional,
                                   tipoidentificacioncliente = ptipoidentificacioncliente,
                                   identificacioncliente = pidentificacioncliente
				 where identificador = pidentificador;
			 end if;  
		WHEN 'E' THEN
				Delete from citas 
				where identificador = pidentificador;  
		WHEN 'C' THEN
				select * from citas
                where identificador = pidentificador;
		WHEN 'L' THEN
				select * from citas;
		WHEN 'R' THEN
				select * from citas
				where tipoidentificacioncliente = ptipoidentificacioncliente and identificacioncliente = pidentificacioncliente;
		WHEN 'U' THEN
				UPDATE citas SET tipoidentificacionprofesional = ptipoidentificacionprofesional, identificacionprofesional = pidentificacionprofesional WHERE identificador = pidentificador;
	END CASE;
   
   
  
     

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `gestionarclientes` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `gestionarclientes`(poperacion enum('G','E','C','L'),
																ptipoidentificacion enum('I','C','E'), 
																pidentificacion varchar(10), 
																pnombres varchar(60),
																papellidos varchar(60), 
																pcorreo varchar(45), 
																pcelular varchar(12), 
																pfechaNacimiento date, 
																pnombresAcompañante varchar(60), 
																papellidosAcompañante varchar(60), 
																pfechaNacimientoAcompañante date,
                                                                pcorreoacompañante varchar(45))
BEGIN
   Declare vnumeroregistros int;
   
	CASE poperacion
		WHEN 'G' THEN
			  Select count(1) into vnumeroregistros
			  from clientes
			  where tipoidentificacion = ptipoidentificacion and identificacion = pidentificacion;
			  if (vnumeroregistros = 0) then
				 Insert Into 
				  clientes
				  values(ptipoidentificacion, 
					 	 pidentificacion, 
						 pnombres,
			 			 papellidos, 
						 pcorreo, 
						 pcelular, 
						 pfechaNacimiento, 
						 pnombresAcompañante, 
						 papellidosAcompañante, 
						 pfechaNacimientoAcompañante,
                         pcorreoacompañante);
			  elseif (vnumeroregistros = 1) then   
				 update clientes set tipoidentificacion = ptipoidentificacion, 
								  identificacion = pidentificacion, 
								  nombres = pnombres, 
								  apellidos = papellidos, 
								  correo = pcorreo, 
								  celular = pcelular, 
								  fechaNacimiento = pfechaNacimiento, 
								  nombresAcompañante = pnombresAcompañante,
								  apellidosAcompañante = papellidosAcompañante, 
								  fechaNacimientoAcompañante = pfechaNacimientoAcompañante,
                                  correoAcompañante = pcorreoacompañante
				 where tipoidentificacion = ptipoidentificacion and identificacion = pidentificacion;
			 end if;  
		WHEN 'E' THEN
				Delete from clientes 
				where tipoidentificacion = ptipoidentificacion and identificacion = pidentificacion;  
		WHEN 'C' THEN
				select * from clientes
                where tipoidentificacion = ptipoidentificacion and identificacion = pidentificacion;
		WHEN 'L' THEN
				select * from clientes; 
	END CASE;
   
   
  
     

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `gestionardiagnosticos` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `gestionardiagnosticos`(poperacion enum('G','E','C','L'),
																	pidentificador int(11), 
																	ppeso float, 
																	ppresionarterial float, 
																	pdiagnostico text, 
																	pnumerosesiones int(11), 
																	pcitaId int(11))
BEGIN
   Declare vnumeroregistros int;
   
	CASE poperacion
		WHEN 'G' THEN
			  Select count(1) into vnumeroregistros
			  from diagnosticos
			  where identificador = pidentificador;
			  if (vnumeroregistros = 0) then
				 Insert Into 
				  diagnosticos
				  values(pidentificador, 
						 ppeso, 
						 ppresionarterial, 
						 pdiagnostico, 
						 pnumerosesiones, 
						 pcitaId);
			  elseif (vnumeroregistros = 1) then   
				 update diagnosticos set identificador = pidentificador, 
						 peso =ppeso, 
						 presionarterial = ppresionarterial, 
						 diagnostico = pdiagnostico, 
						 numerosesiones = pnumerosesiones, 
						 citaId = pcitaId
				 where identificador = pidentificador;
			 end if;  
		WHEN 'E' THEN
				Delete from diagnosticos 
				where identificador = pidentificador;  
		WHEN 'C' THEN
				select * from diagnosticos
                where identificador = pidentificador;
		WHEN 'L' THEN
				select * from diagnosticos;  
	END CASE;
   
   
  
     

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `gestionardiagnosticosservicios` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `gestionardiagnosticosservicios`(poperacion enum('G','E','C','L'),
																			 pdiagnosticoId int(11), 
																			 pservicioId int(11))
BEGIN
   Declare vnumeroregistros int;
   
	CASE poperacion
		WHEN 'G' THEN
			  Select count(1) into vnumeroregistros
			  from diagnosticosservicios
			  where diagnosticoId = pdiagnosticoId and servicioId = pservicioId;
			  if (vnumeroregistros = 0) then
				 Insert Into 
				  diagnosticosservicios
				  values(pdiagnosticoId, 
						 pservicioId);
			  elseif (vnumeroregistros = 1) then   
				 update diagnosticosservicios set diagnosticoId = pdiagnosticoId, 
												  servicioId = pservicioId
				where diagnosticoId = pdiagnosticoId and servicioId = pservicioId;
			 end if;  
		WHEN 'E' THEN
				Delete from diagnosticosservicios 
				where diagnosticoId = pdiagnosticoId and servicioId = pservicioId;
		WHEN 'C' THEN
				select * from diagnosticosservicios
				where diagnosticoId = pdiagnosticoId and servicioId = pservicioId;
		WHEN 'L' THEN
				select * from diagnosticosservicios;  
	END CASE;
   
   
  
     

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `gestionarelementos` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `gestionarelementos`(poperacion enum('G','E','C','L'),pidentificador int,
 pnombre varchar(45), pcosto int, ptipo enum('reactivo','maquina','materia prima'))
BEGIN
   Declare vnumeroregistros int;
   
	CASE poperacion
		WHEN 'G' THEN
			  Select count(1) into vnumeroregistros
			  from elementos
			  where identificador = pidentificador;
			  
			  if (vnumeroregistros = 0) then
				 Insert Into 
				  elementos
				  values(pidentificador,pnombre,pcosto,ptipo);
			  else   
				 update elementos set identificador = pidentificador, nombre = pnombre, costo = pcosto, tipo = ptipo
				 where identificador = pidentificador;
			 end if;  
		WHEN 'E' THEN
				Delete from elementos 
				where identificador = pidentificador;  
		WHEN 'C' THEN
				select * from elementos
                where identificador = pidentificador;
		WHEN 'L' THEN
				select * from elementos;  
	END CASE;
   
   
  
     

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `gestionarelementosservicios` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `gestionarelementosservicios`(poperacion enum('G','E','C','L'),pelementoId int,
 pservicioId int)
BEGIN
   Declare vnumeroregistros int;
   
	CASE poperacion
		WHEN 'G' THEN
			  Select count(1) into vnumeroregistros
			  from elementosservicios
			  where elementoId = pelementoId and servicioId = pservicioId;
			  
			  if (vnumeroregistros = 0) then
				 Insert Into 
				  elementosservicios
				  values(pelementoId,pservicioId);
			  else   
				 update elementosservicios set elementoId = pelementoId, servicioId = pservicioId
				 where elementoId = pelementoId and servicioId = pservicioId;
			 end if;  
		WHEN 'E' THEN
				Delete from elementosservicios 
				where elementoId = pelementoId and servicioId = pservicioId;  
		WHEN 'C' THEN
				select * from elementosservicios  where elementoId = pelementoId and servicioId = pservicioId; 
		WHEN 'L' THEN
				select * from elementosservicios;  
	END CASE;
   
   
  
     

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `gestionarempleados` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `gestionarempleados`(poperacion enum('G','E','C','L'),
																 ptipoidentificacion enum('I','C','E'), 
																 pidentificacion varchar(10),
																 pnombres varchar(45),
																 papellidos varchar(45), 
																 ptipo enum('secretaria','gerente','admin'))
BEGIN
   Declare vnumeroregistros int;
   
	CASE poperacion
		WHEN 'G' THEN
			  Select count(1) into vnumeroregistros
			  from empleados
			  where tipoidentificacion= ptipoidentificacion and identificacion = pidentificacion;
			  if (vnumeroregistros = 0) then
				 Insert Into 
				  empleados
				  values(ptipoidentificacion, 
						 pidentificacion,
						 pnombres,
						 papellidos, 
						 ptipo);
			  elseif (vnumeroregistros = 1) then   
				 update empleados set tipoidentificacion = ptipoidentificacion, 
						 identificacion = pidentificacion,
						 nombres = pnombres,
						 apellidos = papellidos, 
						 tipo = ptipo
				where tipoidentificacion= ptipoidentificacion and identificacion = pidentificacion;
			 end if;  
		WHEN 'E' THEN
				Delete from empleados 
				where tipoidentificacion= ptipoidentificacion and identificacion = pidentificacion;
		WHEN 'C' THEN
				select * from empleados
				where tipoidentificacion= ptipoidentificacion and identificacion = pidentificacion;
		WHEN 'L' THEN
				select * from empleados;  
	END CASE;
   
   
  
     

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `gestionarestudios` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `gestionarestudios`(poperacion enum('G','E','C','L'),
																pidentificador int(11), 
																pnombre varchar(45),
																ptipoidentificacionprofesional enum('I','C','E'),
																pidentificacionprofesional varchar(10))
BEGIN
   Declare vnumeroregistros int;
   
	CASE poperacion
		WHEN 'G' THEN
			  Select count(1) into vnumeroregistros
			  from estudios
			  where identificador = pidentificador;
			  if (vnumeroregistros = 0) then
				 Insert Into 
				  estudios
				  values(pidentificador,
						 pnombre,
						 ptipoidentificacionprofesional, 
						 pidentificacionprofesional);
			  elseif (vnumeroregistros = 1) then   
				 update estudios set nombre = pnombre,
						 tipoidentificacionprofesional = ptipoidentificacionprofesional, 
						 tipoidentificacionprofesional = pidentificacionprofesional
				where identificador = pidentificador;
			 end if;  
		WHEN 'E' THEN
				Delete from estudios 
				where identificador = pidentificador;
		WHEN 'C' THEN
				select * from estudios
				where identificador = pidentificador;
		WHEN 'L' THEN
				select * from estudios;  
	END CASE;
   
   
  
     

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `gestionarexperticias` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `gestionarexperticias`(poperacion enum('G','E','C','L'),
																pidentificador int(11), 
																pnombre varchar(45),
																ptipoidentificacionprofesional enum('I','C','E'),
																pidentificacionprofesional varchar(10))
BEGIN
   Declare vnumeroregistros int;
   
	CASE poperacion
		WHEN 'G' THEN
			  Select count(1) into vnumeroregistros
			  from experticias
			  where identificador = pidentificador;
			  if (vnumeroregistros = 0) then
				 Insert Into 
				  experticias
				  values(pidentificador,
						 pnombre,
						 ptipoidentificacionprofesional, 
						 pidentificacionprofesional);
			  elseif (vnumeroregistros = 1) then   
				 update experticias set identificador =pidentificador,
						 nombre = pnombre,
						 tipoidentificacionprofesional = ptipoidentificacionprofesional, 
						 tipoidentificacionprofesional = pidentificacionprofesional
				where identificador = pidentificador;
			 end if;  
		WHEN 'E' THEN
				Delete from experticias 
				where identificador = pidentificador;
		WHEN 'C' THEN
				select * from experticias
				where identificador = pidentificador;
		WHEN 'L' THEN
				select * from experticias;  
	END CASE;
   
   
  
     

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `gestionarhistoriasclinicas` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `gestionarhistoriasclinicas`(ptipoidentificacioncliente enum('I','C','E'), 
												pidentificacioncliente varchar(10))
BEGIN

SELECT t.peso, t.presionarterial, sesionesrealizadas, sesionesrestantes, derivacion, resultados, servicioId, s.nombre ,fecha, t.evolucion 
FROM tratamientos t, citas c, servicios s
WHERE t.citaId = c.identificador 
		and (identificacioncliente = pidentificacioncliente and tipoidentificacioncliente = ptipoidentificacioncliente)
        and t.servicioId = s.identificador;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `gestionarprofesionales` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `gestionarprofesionales`(poperacion enum('G','E','C','L'),
																	 ptipoidentificacion enum('I','C','E'), 
																	 pidentificacion varchar(10), 
																	 pnombres varchar(45), 
																	 papellidos varchar(45), 
																	 pcelular varchar(12),
                                                                     pestado enum('activo','inactivo')
                                                                     )
BEGIN
   Declare vnumeroregistros int;
   
	CASE poperacion
		WHEN 'G' THEN
			  Select count(1) into vnumeroregistros
			  from profesionales
				where tipoidentificacion = ptipoidentificacion and identificacion = pidentificacion;
			  if (vnumeroregistros = 0) then
				 Insert Into 
				  profesionales
				  values(ptipoidentificacion, 
						 pidentificacion, 
						 pnombres, 
						 papellidos, 
						 pcelular,
                         pestado
                         );
			  elseif (vnumeroregistros = 1) then   
				 update profesionales set tipoidentificacion = ptipoidentificacion, 
						 identificacion = pidentificacion, 
						 nombres = pnombres, 
						 apellidos = papellidos, 
						 celular = pcelular,
                         estado = pestado
				where tipoidentificacion = ptipoidentificacion and identificacion = pidentificacion;
			 end if;  
		WHEN 'E' THEN
				update profesionales set estado = pestado
				where tipoidentificacion = ptipoidentificacion and identificacion = pidentificacion;
		WHEN 'C' THEN
				select * from profesionales
				where tipoidentificacion = ptipoidentificacion and identificacion = pidentificacion;
		WHEN 'L' THEN
				select * from profesionales;  
	END CASE;
   
   
  
     

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `gestionarservicios` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `gestionarservicios`(poperacion enum('G','E','C','L'),
																 pidentificador int(11), 
																 pnombre varchar(45),
																 pdescripcion varchar(45),
																 pporcentaje float,
																 pestado enum('activo','inactivo'),
																 pcategoriaId int(11),
																 ppeso varchar(4),
																 ppresionarterial varchar(4),
																 pevolucion varchar(8))
BEGIN
   Declare vnumeroregistros INT;
   Declare vcostototal FLOAT;
   Declare vganancia FLOAT;
   Declare vprecio FLOAT;
   
	CASE poperacion
		WHEN 'G' THEN
			
				SELECT sum(e.costo) into vcostototal
				FROM elementosservicios es, servicios s, elementos e
				WHERE es.elementoId = e.identificador AND es.servicioId = s.identificador
				GROUP BY es.servicioId
				HAVING es.servicioId = pidentificador;

				set vprecio = vcostototal + (vcostototal * pporcentaje);
				set vganancia = vprecio - vcostototal;
        
			Select count(1) into vnumeroregistros
			from servicios
			where identificador = pidentificador;

			  if (vnumeroregistros = 0) then
                          
				 Insert Into 
				  servicios
				  values(pidentificador, 
						 pnombre,
						 pdescripcion,
						 pporcentaje,
						 vcostoTotal,
						 vprecio,
						 vganancia,
						 pestado,
						 pcategoriaId,
						 ppeso,
						 ppresionarterial,
						 pevolucion);
			  elseif (vnumeroregistros = 1) then   
              
				 update servicios set identificador = pidentificador, 
						 nombre = pnombre,
						 descripcion = pdescripcion,
						 porcentaje = pporcentaje,
						 costoTotal = vcostototal,
						 precio = vprecio,
						 ganancia = vganancia,
						 estado = pestado,
						 categoriaId = pcategoriaId,
						 peso = ppeso,
						 presionarterial = ppresionarterial,
						 evolucion = pevolucion
				where identificador = pidentificador;
			 end if;  
		WHEN 'E' THEN
                UPDATE servicios SET estado = 'inactivo'
                WHERE identificador = pidentificador;
		WHEN 'C' THEN
				select * from servicios
				where identificador = pidentificador;
		WHEN 'L' THEN
				select * from servicios;  
	END CASE;
   
   
  
     

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `gestionartratamientos` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `gestionartratamientos`(poperacion enum('G','E','C','L'),
																 pidentificador int(11), 
																 ppeso float,
																 ppresionarterial float,
																 psesionesrealizadas int(11),
																 psesionesrestantes int(11),
																 pderivacion text,
																 presultados text,
																 pdiagnosticoId int(11),
																 pcitaId int(11),
                                                                 pservicioId int(11),
                                                                 pevolucion varchar(45),
                                                                 ppesoanterior float,
                                                                 ppresionarterialanterior float
                                                                 )
BEGIN
   Declare vnumeroregistros int;
   
	CASE poperacion
		WHEN 'G' THEN
			  Select count(1) into vnumeroregistros
			  from tratamientos
				where identificador = pidentificador and servicioId = pservicioId;
			  if (vnumeroregistros = 0) then
				 Insert Into 
				  tratamientos
				  values(pidentificador, 
						 ppeso,
						 ppresionarterial,
						 psesionesrealizadas,
						 psesionesrestantes,
						 pderivacion,
						 presultados,
						 pdiagnosticoId,
						 pcitaId,
                         pservicioId,
                         pevolucion,
                         ppesoanterior,
                         ppresionarterialanterior
                         );
			  elseif (vnumeroregistros = 1) then   
				 update tratamientos set identificador = pidentificador, 
						 peso = ppeso,
						 presionarterial = ppresionarterial,
						 sesionesrealizadas = psesionesrealizadas,
						 sesionesrestantes = psesionesrestantes,
						 derivacion = pderivacion,
						 resultados = presultados,
						 diagnosticoId = pdiagnosticoId,
						 citaId = pcitaId,
                         servicioId = pservicioId,
                         evolucion = pevolucion,
                         pesoAnterior = ppesoanterior,
                         presionArterialAnterior = ppresionarterialanterior
				where identificador = pidentificador and servicioId = pservicioId;
			 end if;  
		WHEN 'E' THEN
				Delete from tratamientos 
				where identificador = pidentificador and servicioId = pservicioId;
		WHEN 'C' THEN
				select * from tratamientos
				where identificador = pidentificador and servicioId = pservicioId;
		WHEN 'L' THEN
				select * from tratamientos;  
	END CASE;
   
   
  
     

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `gestionarusuarios` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `gestionarusuarios`(poperacion enum('G','E','C','L'),
																pusuario varchar(45),
																pcontrasena varchar(16),
																ptipoidentificacioncliente enum('I','C','E'),
																pidentificacioncliente varchar(10),
																ptipoidentificacionprofesional enum('I','C','E'),
																pidentificacionprofesional varchar(10),
																ptipoidentificacionempleado enum('I','C','E'),
																pidentificacionempleado varchar(10),
                                                                ptipo ENUM('A', 'G', 'S', 'P', 'C') )
BEGIN
   Declare vnumeroregistros int;
   
	CASE poperacion
		WHEN 'G' THEN
			  Select count(1) into vnumeroregistros
			  from usuarios
				where usuario= pusuario;
			  if (vnumeroregistros = 0) then
				 Insert Into 
				  usuarios
				  values(pusuario,
						 pcontrasena,
						 ptipoidentificacioncliente,
						 pidentificacioncliente,
						 ptipoidentificacionprofesional,
						 pidentificacionprofesional,
						 ptipoidentificacionempleado,
						 pidentificacionempleado,
                         ptipo
                         );
			  elseif (vnumeroregistros = 1) then   
				 update usuarios set usuario = pusuario,
						 contrasena = pcontrasena,
						 tipoidentificacioncliente = ptipoidentificacioncliente,
						 identificacioncliente = pidentificacioncliente,
						 tipoidentificacionprofesional = ptipoidentificacionprofesional,
						 identificacionprofesional = pidentificacionprofesional,
						 tipoidentificacionempleado = ptipoidentificacionempleado,
						 identificacionempleado = pidentificacionempleado,
                         tipo = ptipo
				where usuario = pusuario;
			 end if;  
		WHEN 'E' THEN
				Delete from usuarios 
				where usuario= pusuario;
		WHEN 'C' THEN
				select * from usuarios
				where usuario = pusuario;
		WHEN 'L' THEN
				select * from usuarios;  
	END CASE;
   
   
  
     

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `gestionarventadetalles` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `gestionarventadetalles`(poperacion enum('G','E','C','L'),
																	 pservicioId int(11), 
																	 pnumerofactura int(11), 
																	 pprecio double,
																	 pcosto double, 
																	 pganancia double)
BEGIN
   Declare vnumeroregistros int;
   
	CASE poperacion
		WHEN 'G' THEN
			  Select count(1) into vnumeroregistros
			  from ventadetalles
				where servicioId = pservicioId and numerofactura = pnumerofactura;
			  if (vnumeroregistros = 0) then
				 Insert Into 
				  ventadetalles
				  values(pservicioId, 
						 pnumerofactura, 
						 pprecio,
						 pcosto, 
						 pganancia);
			  elseif (vnumeroregistros = 1) then   
				 update ventadetalles set servicioId = pservicioId, 
						 numerofactura = pnumerofactura, 
						 precio = pprecio,
						 costo = pcosto, 
						 ganancia = pganancia
				where servicioId = pservicioId and numerofactura = pnumerofactura;
			 end if;  
		WHEN 'E' THEN
				Delete from ventadetalles 
				where servicioId = pservicioId and numerofactura = pnumerofactura;
		WHEN 'C' THEN
				select * from ventadetalles
				where servicioId = pservicioId and numerofactura = pnumerofactura;
		WHEN 'L' THEN
				select * from ventadetalles;  
	END CASE;
   
   
  
     

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `gestionarventasencabezado` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `gestionarventasencabezado`(poperacion enum('G','E','C','L'),
																	 pnumerofactura int(11),
																	 ptipoidentificacioncliente enum('I','C','E'),
																	 pidentificacioncliente varchar(10),  
																	 pfecha datetime,
																	 ptotal double)
BEGIN
   Declare vnumeroregistros int;
   
	CASE poperacion
		WHEN 'G' THEN
			  Select count(1) into vnumeroregistros
			  from ventasencabezado
				where tipoidentificacioncliente = ptipoidentificacioncliente and numerofactura = pnumerofactura and identificacioncliente = pidentificacioncliente;
			  if (vnumeroregistros = 0) then
				 Insert Into 
				  ventasencabezado
				  values(pnumerofactura,
						 ptipoidentificacioncliente,
						 pidentificacioncliente,  
						 pfecha,
						 ptotal);
			  elseif (vnumeroregistros = 1) then   
				 update ventasencabezado set numerofactura = pnumerofactura,
						 tipoidentificacioncliente = ptipoidentificacioncliente,
						 identificacioncliente = pidentificacioncliente,  
						 fecha = pfecha,
						 total = ptotal
				where tipoidentificacioncliente = ptipoidentificacioncliente and numerofactura = pnumerofactura and identificacioncliente = pidentificacioncliente;
			 end if;  
		WHEN 'E' THEN
				Delete from ventasencabezado 
				where tipoidentificacioncliente = ptipoidentificacioncliente and numerofactura = pnumerofactura and identificacioncliente = pidentificacioncliente;
		WHEN 'C' THEN
				select * from ventasencabezado
				where tipoidentificacioncliente = ptipoidentificacioncliente and numerofactura = pnumerofactura and identificacioncliente = pidentificacioncliente;
		WHEN 'L' THEN
				select * from ventasencabezado;  
	END CASE;
   
   
  
     

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-11-24 20:24:25
