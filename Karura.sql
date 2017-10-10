-- MySQL dump 10.13  Distrib 5.7.19, for Linux (x86_64)
--
-- Host: localhost    Database: Karura
-- ------------------------------------------------------
-- Server version	5.7.19-0ubuntu0.16.04.1

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
-- Current Database: `Karura`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `Karura` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `Karura`;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nom_UNIQUE` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (2,'gr'),(4,'headress'),(5,'swimming'),(1,'synchro'),(3,'twirling');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `color`
--

DROP TABLE IF EXISTS `color`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `color` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `hexa` char(7) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nom_UNIQUE` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `color`
--

LOCK TABLES `color` WRITE;
/*!40000 ALTER TABLE `color` DISABLE KEYS */;
INSERT INTO `color` VALUES (1,'red','#f60b0b'),(2,'grey','#d8cdcd'),(3,'gold','#eadf75'),(4,'blue','#55b4d8');
/*!40000 ALTER TABLE `color` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model`
--

DROP TABLE IF EXISTS `model`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `model` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `category_id` int(11) NOT NULL,
  `description` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nom_UNIQUE` (`name`),
  KEY `fk_modele_categorie1_idx` (`category_id`),
  CONSTRAINT `fk_modele_categorie1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model`
--

LOCK TABLES `model` WRITE;
/*!40000 ALTER TABLE `model` DISABLE KEYS */;
INSERT INTO `model` VALUES (1,'model1',1,NULL),(2,'model2',1,NULL),(3,'model3',1,NULL),(4,'model4',1,NULL),(5,'model5',1,NULL),(6,'model6',2,NULL),(7,'model7',2,NULL),(8,'model8',2,NULL),(9,'model9',2,NULL),(10,'model10',2,NULL),(11,'model11',3,NULL),(12,'model12',3,NULL),(13,'model13',3,NULL),(14,'model14',3,NULL),(15,'model15',3,NULL),(16,'model16',4,NULL),(17,'model17',4,NULL),(18,'model18',4,NULL),(19,'model19',4,NULL),(20,'model20',4,NULL);
/*!40000 ALTER TABLE `model` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_color`
--

DROP TABLE IF EXISTS `model_has_color`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `model_has_color` (
  `color_id` int(11) NOT NULL,
  `model_id` int(11) NOT NULL,
  `main_image` varchar(255) DEFAULT NULL,
  `secondary_image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`color_id`,`model_id`),
  KEY `fk_model_has_color_1_idx` (`color_id`,`model_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_color`
--

LOCK TABLES `model_has_color` WRITE;
/*!40000 ALTER TABLE `model_has_color` DISABLE KEYS */;
INSERT INTO `model_has_color` VALUES (1,1,'maillot_synchro1.jpg',NULL),(1,3,'maillot_synchro3.jpg',NULL),(1,6,'jupette_gr1.jpg',NULL),(1,10,'jupette_gr5.jpg',NULL),(1,11,'twirling1.jpg',NULL),(1,15,'twirling5.jpg',NULL),(1,16,'coiffe1.jpg',NULL),(1,20,'coiffe5.jpg',NULL),(2,2,'maillot_synchro2.jpg',NULL),(2,7,'jupette_gr2.jpg',NULL),(2,12,'twirling2.jpg',NULL),(2,17,'coiffe2.jpg',NULL),(3,4,'maillot_synchro4.jpg',NULL),(3,8,'jupette_gr3.jpg',NULL),(3,13,'twirling3.jpg',NULL),(3,18,'coiffe3.jpg',NULL),(4,5,'maillot_synchro5.jpg',NULL),(4,9,'jupette_gr5.jpg',NULL),(4,14,'twirling4.jpg',NULL),(4,19,'coiffe4.jpg',NULL);
/*!40000 ALTER TABLE `model_has_color` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-10-10 17:52:03
