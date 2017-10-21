
CREATE DATABASE  IF NOT EXISTS `Inventario` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `Inventario`;
-- MySQL dump 10.13  Distrib 5.6.17, for osx10.6 (i386)
--
-- Host: localhost    Database: Inventario
-- ------------------------------------------------------
-- Server version	5.6.19

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `AsignacionItem`
--

DROP TABLE IF EXISTS `AsignacionItem`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `AsignacionItem` (
  `ID` int(11) NOT NULL,
  `Cantidad` int(11) NOT NULL,
  `DepartamentoID` int(11) NOT NULL,
  `ItemID` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID_UNIQUE` (`ID`),
  KEY `fk_AsignacionItem_Departamento1_idx` (`DepartamentoID`),
  KEY `fk_AsignacionItem_Item1_idx` (`ItemID`),
  CONSTRAINT `fk_AsignacionItem_Departamento1` FOREIGN KEY (`DepartamentoID`) REFERENCES `Departamento` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_AsignacionItem_Item1` FOREIGN KEY (`ItemID`) REFERENCES `Item` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `AsignacionItem`
--

LOCK TABLES `AsignacionItem` WRITE;
/*!40000 ALTER TABLE `AsignacionItem` DISABLE KEYS */;
/*!40000 ALTER TABLE `AsignacionItem` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Categoria`
--

DROP TABLE IF EXISTS `Categoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Categoria` (
  `ID` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Descripcion` varchar(2000) DEFAULT NULL,
  `Estado` varchar(1) NOT NULL,
  `CategoriaPadreID` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID_UNIQUE` (`ID`),
  UNIQUE KEY `Nombre_UNIQUE` (`Nombre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Categoria`
--

LOCK TABLES `Categoria` WRITE;
/*!40000 ALTER TABLE `Categoria` DISABLE KEYS */;
/*!40000 ALTER TABLE `Categoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Departamento`
--

DROP TABLE IF EXISTS `Departamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Departamento` (
  `ID` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Descripcion` varchar(2000) DEFAULT NULL,
  `Estado` varchar(1) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID_UNIQUE` (`ID`),
  UNIQUE KEY `Nombre_UNIQUE` (`Nombre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Departamento`
--

LOCK TABLES `Departamento` WRITE;
/*!40000 ALTER TABLE `Departamento` DISABLE KEYS */;
/*!40000 ALTER TABLE `Departamento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Item`
--

DROP TABLE IF EXISTS `Item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Item` (
  `ID` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Cantidad` int(11) NOT NULL,
  `Descripcion` varchar(2000) DEFAULT NULL,
  `CodigoBarras` varchar(100) DEFAULT NULL,
  `Imagen` blob,
  `Estado` varchar(1) NOT NULL,
  `CantidadMinima` int(11) DEFAULT NULL,
  `CategoriaID` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `idInventario_UNIQUE` (`ID`),
  UNIQUE KEY `Nombre_UNIQUE` (`Nombre`),
  UNIQUE KEY `CodigoBarras_UNIQUE` (`CodigoBarras`),
  KEY `fk_Item_Categoria1_idx` (`CategoriaID`),
  CONSTRAINT `fk_Item_Categoria1` FOREIGN KEY (`CategoriaID`) REFERENCES `Categoria` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Item`
--

LOCK TABLES `Item` WRITE;
/*!40000 ALTER TABLE `Item` DISABLE KEYS */;
/*!40000 ALTER TABLE `Item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `MovimientoItem`
--

DROP TABLE IF EXISTS `MovimientoItem`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `MovimientoItem` (
  `ID` int(11) NOT NULL,
  `ItemID` int(11) NOT NULL,
  `TipoMovimientoID` int(11) NOT NULL,
  `Fecha` datetime NOT NULL,
  `Cantidad` int(11) NOT NULL,
  `UsuarioID` int(11) NOT NULL,
  `Estado` varchar(1) NOT NULL,
  `DepartamentoID` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID_UNIQUE` (`ID`),
  KEY `fk_MovimientosItem_Item_idx` (`ItemID`),
  KEY `fk_MovimientoItem_TipoMovimiento1_idx` (`TipoMovimientoID`),
  KEY `fk_MovimientoItem_Departamento1_idx` (`DepartamentoID`),
  CONSTRAINT `fk_MovimientoItem_Departamento1` FOREIGN KEY (`DepartamentoID`) REFERENCES `Departamento` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_MovimientoItem_TipoMovimiento1` FOREIGN KEY (`TipoMovimientoID`) REFERENCES `TipoMovimiento` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_MovimientosItem_Item` FOREIGN KEY (`ItemID`) REFERENCES `Item` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `MovimientoItem`
--

LOCK TABLES `MovimientoItem` WRITE;
/*!40000 ALTER TABLE `MovimientoItem` DISABLE KEYS */;
/*!40000 ALTER TABLE `MovimientoItem` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Rol`
--

DROP TABLE IF EXISTS `Rol`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Rol` (
  `ID` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Descripcion` varchar(2000) DEFAULT NULL,
  `Estado` varchar(1) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID_UNIQUE` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Rol`
--

LOCK TABLES `Rol` WRITE;
/*!40000 ALTER TABLE `Rol` DISABLE KEYS */;
INSERT INTO `Rol` VALUES (1,'admin','Adminisrador','A');
/*!40000 ALTER TABLE `Rol` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `SolicitudAsignacion`
--

DROP TABLE IF EXISTS `SolicitudAsignacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `SolicitudAsignacion` (
  `ID` int(11) NOT NULL,
  `FechaSolicitud` datetime NOT NULL,
  `UsuarioAutorizadorID` int(11) NOT NULL,
  `RolAutorizadorID` int(11) NOT NULL,
  `FechaAutorizacion` datetime NOT NULL,
  `AsignacionItemID` int(11) NOT NULL,
  `UsuarioID` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL DEFAULT '1',
  `estado` varchar(1) NOT NULL DEFAULT 'P',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID_UNIQUE` (`ID`),
  KEY `fk_SolicitudAsignacion_AsignacionItem1_idx` (`AsignacionItemID`),
  KEY `fk_SolicitudAsignacion_Usuario1_idx` (`UsuarioID`),
  KEY `fk_SolicitudAsignacion_Usuario2_idx` (`UsuarioAutorizadorID`),
  KEY `fk_SolicitudAsignacion_Rol1_idx` (`RolAutorizadorID`),
  CONSTRAINT `fk_SolicitudAsignacion_AsignacionItem1` FOREIGN KEY (`AsignacionItemID`) REFERENCES `AsignacionItem` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_SolicitudAsignacion_Rol1` FOREIGN KEY (`RolAutorizadorID`) REFERENCES `Rol` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_SolicitudAsignacion_Usuario1` FOREIGN KEY (`UsuarioID`) REFERENCES `Usuario` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_SolicitudAsignacion_Usuario2` FOREIGN KEY (`UsuarioAutorizadorID`) REFERENCES `Usuario` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `SolicitudAsignacion`
--

LOCK TABLES `SolicitudAsignacion` WRITE;
/*!40000 ALTER TABLE `SolicitudAsignacion` DISABLE KEYS */;
/*!40000 ALTER TABLE `SolicitudAsignacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `SolicitudMovimiento`
--

DROP TABLE IF EXISTS `SolicitudMovimiento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `SolicitudMovimiento` (
  `ID` int(11) NOT NULL,
  `FechaSolicitud` datetime NOT NULL,
  `UsuarioAutorizadorID` int(11) NOT NULL,
  `RolAutorizadorID` int(11) NOT NULL,
  `MovimientoItemID` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID_UNIQUE` (`ID`),
  KEY `fk_SolicitudMovimiento_MovimientoItem1_idx` (`MovimientoItemID`),
  KEY `fk_SolicitudMovimiento_Usuario1_idx` (`UsuarioAutorizadorID`),
  KEY `fk_SolicitudMovimiento_Rol1_idx` (`RolAutorizadorID`),
  CONSTRAINT `fk_SolicitudMovimiento_MovimientoItem1` FOREIGN KEY (`MovimientoItemID`) REFERENCES `MovimientoItem` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_SolicitudMovimiento_Rol1` FOREIGN KEY (`RolAutorizadorID`) REFERENCES `Rol` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_SolicitudMovimiento_Usuario1` FOREIGN KEY (`UsuarioAutorizadorID`) REFERENCES `Usuario` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `SolicitudMovimiento`
--

LOCK TABLES `SolicitudMovimiento` WRITE;
/*!40000 ALTER TABLE `SolicitudMovimiento` DISABLE KEYS */;
/*!40000 ALTER TABLE `SolicitudMovimiento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TipoMovimiento`
--

DROP TABLE IF EXISTS `TipoMovimiento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TipoMovimiento` (
  `ID` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Descripcion` varchar(2000) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID_UNIQUE` (`ID`),
  UNIQUE KEY `Nombre_UNIQUE` (`Nombre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TipoMovimiento`
--

LOCK TABLES `TipoMovimiento` WRITE;
/*!40000 ALTER TABLE `TipoMovimiento` DISABLE KEYS */;
/*!40000 ALTER TABLE `TipoMovimiento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Usuario`
--

DROP TABLE IF EXISTS `Usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Usuario` (
  `ID` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Clave` varchar(100) NOT NULL,
  `Estado` varchar(1) NOT NULL,
  `RolID` int(11) NOT NULL,
  `DepartamentoID` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID_UNIQUE` (`ID`),
  UNIQUE KEY `Nombre_UNIQUE` (`Nombre`),
  KEY `fk_Usuario_Rol1_idx` (`RolID`),
  KEY `fk_Usuario_Departamento1_idx` (`DepartamentoID`),
  CONSTRAINT `fk_Usuario_Departamento1` FOREIGN KEY (`DepartamentoID`) REFERENCES `Departamento` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Usuario_Rol1` FOREIGN KEY (`RolID`) REFERENCES `Rol` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Usuario`
--

LOCK TABLES `Usuario` WRITE;
/*!40000 ALTER TABLE `Usuario` DISABLE KEYS */;
/*!40000 ALTER TABLE `Usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-05-12 23:41:35
