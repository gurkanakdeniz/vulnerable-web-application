-- MySQL dump 10.13  Distrib 5.7.17, for Linux (x86_64)
--
-- Host: localhost    Database: vulsite
-- ------------------------------------------------------
-- Server version	5.7.17-0ubuntu0.16.04.2

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
-- Table structure for table `KisiBilgileri`
--

DROP TABLE IF EXISTS `KisiBilgileri`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `KisiBilgileri` (
  `NAME` varchar(100) NOT NULL,
  `PASS` varchar(20) DEFAULT NULL,
  `EM` varchar(20) DEFAULT NULL,
  `ADRES` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`NAME`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `KisiBilgileri`
--

LOCK TABLES `KisiBilgileri` WRITE;
/*!40000 ALTER TABLE `KisiBilgileri` DISABLE KEYS */;
INSERT INTO `KisiBilgileri` VALUES ('test1','1234','test1@mail.com','ISTANBUL'),('test2','1234569','test2@mail.com','KOCAELI');
/*!40000 ALTER TABLE `KisiBilgileri` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Ogrenciler`
--

DROP TABLE IF EXISTS `Ogrenciler`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Ogrenciler` (
  `NUMARA` int(11) NOT NULL,
  `NAME` varchar(100) DEFAULT NULL,
  `CLASS` int(11) DEFAULT NULL,
  `ORTALAMA` decimal(8,2) DEFAULT NULL,
  PRIMARY KEY (`NUMARA`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Ogrenciler`
--

LOCK TABLES `Ogrenciler` WRITE;
/*!40000 ALTER TABLE `Ogrenciler` DISABLE KEYS */;
INSERT INTO `Ogrenciler` VALUES (170201021,'Ahmet Demir',3,2.24),(170201022,'Mehmet Tut',4,3.04),(170201023,'Ayse Bak',2,3.96),(170201024,'Zeliha Deniz',3,3.66),(170201025,'Ali Pek',2,2.89),(170201026,'Sudesu Pamuk',3,2.71),(170201027,'Deniz Gok',3,3.89),(170201028,'Alev Toprak',4,3.54),(170201029,'Oguz Atay',1,3.42),(170201030,'Orhan Veli',3,2.26);
/*!40000 ALTER TABLE `Ogrenciler` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'vulsite'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-04-24 21:41:11
