CREATE DATABASE  IF NOT EXISTS `db_fastparking` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `db_fastparking`;
-- MySQL dump 10.13  Distrib 8.0.20, for Win64 (x86_64)
--
-- Host: localhost    Database: db_fastparking
-- ------------------------------------------------------
-- Server version	8.0.20

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
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `customer` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(80) NOT NULL,
  `email` varchar(320) NOT NULL,
  `cpf` varchar(20) NOT NULL,
  `phone_number` varchar(16) NOT NULL,
  `password` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `cpf` (`cpf`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer`
--

LOCK TABLES `customer` WRITE;
/*!40000 ALTER TABLE `customer` DISABLE KEYS */;
INSERT INTO `customer` VALUES (8,'John Doe','johndoe@gmail.com','444.333.222-11','11963677923','senha123'),(9,'Jane Doe','janedow@gmail.com','555.444.333-22','11963677923','senha123'),(10,'Carlos Armandes','armandescarlos@gmail.com','666.555.444-33','11963677923','senha123'),(11,'Julia Jefferson','juliajeff@gmail.com','777.666.555-44','11963677923','senha123'),(12,'Davie Mccree','thedavie@gmail.com','888.777.666-55','11963677923','senha123'),(13,'Frank Fisher','frankfisher@gmail.com','999.888.777-66','11963677923','senha123'),(14,'Mary Martin','marymartin@gmail.com','111.222.333-444','11963677923','senha123'),(15,'singular','tse@mail.com','222.333.444-55','9123789','klasjd190ziAS@dxzc');
/*!40000 ALTER TABLE `customer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `parking_spot`
--

DROP TABLE IF EXISTS `parking_spot`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `parking_spot` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(10) NOT NULL,
  `vehicle_type_id` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `FK_parking_spot__vehicle_type_id` (`vehicle_type_id`),
  CONSTRAINT `FK_parking_spot__vehicle_type_id` FOREIGN KEY (`vehicle_type_id`) REFERENCES `vehicle_type` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `parking_spot`
--

LOCK TABLES `parking_spot` WRITE;
/*!40000 ALTER TABLE `parking_spot` DISABLE KEYS */;
INSERT INTO `parking_spot` VALUES (81,'A-1',1),(82,'A-2',1),(83,'A-3',2),(84,'A-4',1),(85,'A-5',3),(86,'A-6',3),(87,'A-7',5),(88,'A-8',1),(89,'A-9',4),(90,'A-10',1),(91,'B-1',1),(92,'B-2',1),(93,'B-3',5),(94,'B-4',1),(95,'B-5',3),(96,'B-6',1),(97,'B-7',2),(98,'B-8',1),(99,'B-9',4),(100,'B-10',1);
/*!40000 ALTER TABLE `parking_spot` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vehicle`
--

DROP TABLE IF EXISTS `vehicle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vehicle` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `plate` varchar(10) DEFAULT NULL,
  `vehicle_colour_id` int unsigned NOT NULL,
  `vehicle_type_id` int unsigned NOT NULL,
  `vehicle_model_id` int unsigned NOT NULL,
  `customer_id` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `FK_vehicle__vehicle_colour_id` (`vehicle_colour_id`),
  KEY `FK_vehicle__vehicle_model_id` (`vehicle_model_id`),
  KEY `FK_vehicle__vehicle_type_id` (`vehicle_type_id`),
  KEY `FK_vehicle__customer_id` (`customer_id`),
  CONSTRAINT `FK_vehicle__customer_id` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`),
  CONSTRAINT `FK_vehicle__vehicle_colour_id` FOREIGN KEY (`vehicle_colour_id`) REFERENCES `vehicle_colour` (`id`),
  CONSTRAINT `FK_vehicle__vehicle_model_id` FOREIGN KEY (`vehicle_model_id`) REFERENCES `vehicle_model` (`id`),
  CONSTRAINT `FK_vehicle__vehicle_type_id` FOREIGN KEY (`vehicle_type_id`) REFERENCES `vehicle_type` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehicle`
--

LOCK TABLES `vehicle` WRITE;
/*!40000 ALTER TABLE `vehicle` DISABLE KEYS */;
/*!40000 ALTER TABLE `vehicle` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vehicle_colour`
--

DROP TABLE IF EXISTS `vehicle_colour`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vehicle_colour` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehicle_colour`
--

LOCK TABLES `vehicle_colour` WRITE;
/*!40000 ALTER TABLE `vehicle_colour` DISABLE KEYS */;
INSERT INTO `vehicle_colour` VALUES (6,'amarelo'),(5,'azul'),(3,'branco'),(2,'cinza'),(1,'preto'),(9,'rosa'),(8,'roxo'),(7,'verde'),(4,'vermelho');
/*!40000 ALTER TABLE `vehicle_colour` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vehicle_in_out`
--

DROP TABLE IF EXISTS `vehicle_in_out`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vehicle_in_out` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `total_price` double unsigned DEFAULT NULL,
  `entrance_time` datetime NOT NULL,
  `exit_time` datetime DEFAULT NULL,
  `vehicle_id` int unsigned NOT NULL,
  `parking_spot_id` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `FK_vehicle_in_out__vehicle_id` (`vehicle_id`),
  KEY `FK_vehicle_int_out__parking_spot_id` (`parking_spot_id`),
  CONSTRAINT `FK_vehicle_in_out__vehicle_id` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicle` (`id`),
  CONSTRAINT `FK_vehicle_int_out__parking_spot_id` FOREIGN KEY (`parking_spot_id`) REFERENCES `parking_spot` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehicle_in_out`
--

LOCK TABLES `vehicle_in_out` WRITE;
/*!40000 ALTER TABLE `vehicle_in_out` DISABLE KEYS */;
/*!40000 ALTER TABLE `vehicle_in_out` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vehicle_model`
--

DROP TABLE IF EXISTS `vehicle_model`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vehicle_model` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehicle_model`
--

LOCK TABLES `vehicle_model` WRITE;
/*!40000 ALTER TABLE `vehicle_model` DISABLE KEYS */;
INSERT INTO `vehicle_model` VALUES (1,'outro'),(2,'Corsa.'),(3,'Celta'),(4,'Onix'),(5,'Prisma'),(6,'cobalt'),(7,'Punto'),(8,'Siena'),(9,'Uno'),(10,'Palio'),(11,'Mobi'),(12,'Toro'),(13,'Strada'),(14,'Idea'),(15,'GOL'),(16,'FOX'),(17,'UP'),(18,'Savero'),(19,'Voyage'),(20,'Fusca'),(21,'Ecosport'),(22,'Fiesta'),(23,'Sandero'),(24,'Logan'),(25,'Clio'),(26,'Duster'),(27,'Kwid'),(28,'Captur'),(29,'HB20'),(30,'I30'),(31,'Tucson'),(32,'Corolla'),(33,'Hilux'),(34,'Etios'),(35,'Fit'),(36,'Civic'),(37,'Citroen'),(38,'Audi'),(39,'Jeep'),(40,'Peugeot'),(41,'outro'),(42,'Corsa.'),(43,'Celta'),(44,'Onix'),(45,'Prisma'),(46,'cobalt'),(47,'Punto'),(48,'Siena'),(49,'Uno'),(50,'Palio'),(51,'Mobi'),(52,'Toro'),(53,'Strada'),(54,'Idea'),(55,'GOL'),(56,'FOX'),(57,'UP'),(58,'Savero'),(59,'Voyage'),(60,'Fusca'),(61,'Ecosport'),(62,'Fiesta'),(63,'Sandero'),(64,'Logan'),(65,'Clio'),(66,'Duster'),(67,'Kwid'),(68,'Captur'),(69,'HB20'),(70,'I30'),(71,'Tucson'),(72,'Corolla'),(73,'Hilux'),(74,'Etios'),(75,'Fit'),(76,'Civic'),(77,'Citroen'),(78,'Audi'),(79,'Jeep'),(80,'Peugeot');
/*!40000 ALTER TABLE `vehicle_model` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vehicle_type`
--

DROP TABLE IF EXISTS `vehicle_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vehicle_type` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `price` double NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehicle_type`
--

LOCK TABLES `vehicle_type` WRITE;
/*!40000 ALTER TABLE `vehicle_type` DISABLE KEYS */;
INSERT INTO `vehicle_type` VALUES (1,'carro',10),(2,'moto',5),(3,'van',15),(4,'ônibus',20),(5,'avião',50);
/*!40000 ALTER TABLE `vehicle_type` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-06-06 13:41:39
