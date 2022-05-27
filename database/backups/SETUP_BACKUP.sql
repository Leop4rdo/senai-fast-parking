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
  `phone_number` varchar(16) NOT NULL,
  `password` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer`
--

LOCK TABLES `customer` WRITE;
/*!40000 ALTER TABLE `customer` DISABLE KEYS */;
INSERT INTO `customer` VALUES (1,'John Doe','johndoe@gmail.com','11963677923','senha123'),(2,'Abraham Lincoln','abrahamlikesapple@gmail.com','53408398237','passwordonetwothree'),(3,'Leo Cemia','email@gmail.com','11999999999','pkpkpkpk'),(4,'Sr. Banana','bananananica@gmail.com','11979797979','bananaprata'),(5,'teste','teste@mail.com','9123789','klasjd190ziAS@dxzc');
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
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `parking_spot`
--

LOCK TABLES `parking_spot` WRITE;
/*!40000 ALTER TABLE `parking_spot` DISABLE KEYS */;
INSERT INTO `parking_spot` VALUES (1,'A-1',1),(2,'A-2',1),(3,'A-3',2),(4,'A-4',1),(5,'A-5',3),(6,'A-6',3),(7,'A-7',5),(8,'A-8',1),(9,'A-9',4),(10,'A-10',1),(11,'B-1',1),(12,'B-2',1),(13,'B-3',5),(14,'B-4',1),(15,'B-5',3),(16,'B-6',1),(17,'B-7',2),(18,'B-8',1),(19,'B-9',4),(20,'B-10',1);
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehicle`
--

LOCK TABLES `vehicle` WRITE;
/*!40000 ALTER TABLE `vehicle` DISABLE KEYS */;
INSERT INTO `vehicle` VALUES (1,'BGSD-123',1,2,6,1),(2,'AAAA-321',4,3,4,1),(3,'BBBB-321',5,5,8,1),(4,'CCCC-321',7,1,3,1),(5,'DDDD-321',2,1,2,1),(6,'EEEE-321',6,1,1,3);
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehicle_model`
--

LOCK TABLES `vehicle_model` WRITE;
/*!40000 ALTER TABLE `vehicle_model` DISABLE KEYS */;
INSERT INTO `vehicle_model` VALUES (1,'Conversível.'),(2,'Sedã'),(3,'SUV'),(4,'Minivan'),(5,'Honda CG 160'),(6,'Trail'),(7,'Jato'),(8,'Turboélice');
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
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

-- Dump completed on 2022-05-27 15:40:22
