CREATE DATABASE  IF NOT EXISTS `neog` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `neog`;
-- MySQL dump 10.13  Distrib 8.0.31, for Win64 (x86_64)
--
-- Host: localhost    Database: neog
-- ------------------------------------------------------
-- Server version	8.0.31

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
-- Table structure for table `comentario`
--

DROP TABLE IF EXISTS `comentario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `comentario` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `post_id` int NOT NULL,
  `texto` varchar(400) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_comentario_user1_idx` (`user_id`),
  KEY `fk_comentario_post1_idx` (`post_id`),
  CONSTRAINT `fk_comentario_post1` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`),
  CONSTRAINT `fk_comentario_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comentario`
--

LOCK TABLES `comentario` WRITE;
/*!40000 ALTER TABLE `comentario` DISABLE KEYS */;
INSERT INTO `comentario` VALUES (1,22,11,'Juegazo de pelea.'),(2,22,11,'Juegazo'),(3,22,12,'asdasdasd'),(4,22,12,'sdsd'),(5,22,12,'asdasd'),(6,22,12,'asdasd'),(7,22,12,'Agregar'),(8,22,12,'asdasd'),(9,22,12,'asdasd'),(10,22,12,'asdasd'),(11,22,12,'Prueba'),(12,22,12,'Prueba 2'),(13,22,12,'asdasdasd'),(14,22,12,'asdasd'),(15,23,12,'sadasd'),(16,23,12,'sdaasd'),(17,23,12,'sdsd'),(18,23,12,'Prueba 6'),(19,23,12,'asdads'),(20,23,12,'asd'),(21,23,12,'asdasd'),(22,23,12,'asdasd'),(23,23,12,'asdasd'),(24,23,12,'asdasd'),(25,23,12,'asdasd'),(26,23,12,'asdasd'),(29,23,12,'asdasd'),(30,23,12,'asdasd'),(31,23,12,'asdasdasdasd'),(32,23,12,'asdasd'),(33,23,12,'asdasdxx'),(34,23,12,'asdasd'),(35,23,12,'asdasd'),(36,23,12,'asdasd'),(37,22,13,'asdasd'),(38,22,13,'asdasd'),(39,22,13,'asdasd'),(40,22,13,'asdasd'),(41,22,13,'asdasd'),(42,23,12,'asdasd'),(43,23,12,'asdasdasd'),(44,23,12,'asdasd'),(45,22,11,'asdasd'),(46,22,13,'asdasd'),(47,22,13,'asdasd'),(48,22,13,'asdasd'),(49,22,13,'asdasd'),(50,22,13,'asdasd'),(51,22,13,'asdasd'),(52,22,13,'asdasd'),(53,22,13,'asdasd'),(54,22,13,'dasasd'),(55,22,21,'asdasd'),(56,22,21,'sdsd'),(57,22,13,'asd'),(58,22,13,'Prueba 1'),(59,22,13,'Prueba 2'),(60,22,12,'as'),(61,22,21,'Prueba 2\r\n');
/*!40000 ALTER TABLE `comentario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `genero`
--

DROP TABLE IF EXISTS `genero`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `genero` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `genero`
--

LOCK TABLES `genero` WRITE;
/*!40000 ALTER TABLE `genero` DISABLE KEYS */;
INSERT INTO `genero` VALUES (13,'Guerra'),(14,'Accion'),(15,'Ciencia Ficcion'),(16,'Aventura'),(17,'sdasd'),(18,'Terror'),(19,'Anime'),(20,'Combate'),(21,'Deporte');
/*!40000 ALTER TABLE `genero` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `plataformas`
--

DROP TABLE IF EXISTS `plataformas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `plataformas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `plataformas`
--

LOCK TABLES `plataformas` WRITE;
/*!40000 ALTER TABLE `plataformas` DISABLE KEYS */;
INSERT INTO `plataformas` VALUES (5,'ps4'),(6,'ps5'),(7,'xbox');
/*!40000 ALTER TABLE `plataformas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `post`
--

DROP TABLE IF EXISTS `post`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `post` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `titulo` varchar(50) NOT NULL,
  `desarrollador` varchar(50) NOT NULL,
  `lanzador` varchar(50) NOT NULL,
  `trailer` date NOT NULL,
  `lanzamiento` date NOT NULL,
  `foto` longtext NOT NULL,
  `descripcion` longtext,
  `create_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `titulo_UNIQUE` (`titulo`),
  KEY `fk_post_user_idx` (`user_id`),
  CONSTRAINT `fk_post_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post`
--

LOCK TABLES `post` WRITE;
/*!40000 ALTER TABLE `post` DISABLE KEYS */;
INSERT INTO `post` VALUES (11,22,'street fighter 6','Capcomm','Bandai','2023-06-07','2023-06-21','e0da2b4f512c131fea408a9e2e4f0666.jpg','Juego de pelea....................................................','2023-06-06 17:20:40','2023-06-07 17:05:49'),(12,22,'Resident Evil 4','Ubisof Toronto','Steam','2023-05-28','2023-06-30','6d39233dbb89093d57c69033a50d63d7.png','Resident Evil 4 es una versión actualizada del juego original de 2005...','2023-06-06 17:22:17',NULL),(13,22,'Watch Dog Legion','Ubisof Toronto','Steam','2023-05-18','2023-06-22','392f4d43f4aeb510498f6b340994a6c1.jpeg','Este es un juego de guerra....','2023-06-06 17:23:41',NULL),(20,22,'Marvel\'s Spider-Man 2','Insomniac Games','Sony','2023-06-06','2023-06-13','13a4e9256a17c98c394af255c9c4466e.jpg','Juego de la pelicula el hombre araña...','2023-06-08 04:46:33',NULL),(21,22,'Assassin\'s Creed Mirage','UbiSoft','UbiSoft','2023-06-04','2023-10-12','ff266b9244a2710959f447685375725a.jpg','Assassin\'s Creed Mirage es el nombre definitivo del juego de 2023 de la saga de acción...','2023-06-08 04:55:48',NULL);
/*!40000 ALTER TABLE `post` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `post_has_genero`
--

DROP TABLE IF EXISTS `post_has_genero`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `post_has_genero` (
  `post_id` int NOT NULL,
  `genero_id` int NOT NULL,
  PRIMARY KEY (`post_id`,`genero_id`),
  KEY `fk_post_has_genero_genero1_idx` (`genero_id`),
  KEY `fk_post_has_genero_post1_idx` (`post_id`),
  CONSTRAINT `fk_post_has_genero_genero1` FOREIGN KEY (`genero_id`) REFERENCES `genero` (`id`),
  CONSTRAINT `fk_post_has_genero_post1` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post_has_genero`
--

LOCK TABLES `post_has_genero` WRITE;
/*!40000 ALTER TABLE `post_has_genero` DISABLE KEYS */;
INSERT INTO `post_has_genero` VALUES (13,13),(11,14),(13,14),(20,14),(21,14),(13,15),(20,15);
/*!40000 ALTER TABLE `post_has_genero` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `post_has_plataformas`
--

DROP TABLE IF EXISTS `post_has_plataformas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `post_has_plataformas` (
  `post_id` int NOT NULL,
  `plataformas_id` int NOT NULL,
  PRIMARY KEY (`post_id`,`plataformas_id`),
  KEY `fk_post_has_plataformas_plataformas1_idx` (`plataformas_id`),
  KEY `fk_post_has_plataformas_post1_idx` (`post_id`),
  CONSTRAINT `fk_post_has_plataformas_plataformas1` FOREIGN KEY (`plataformas_id`) REFERENCES `plataformas` (`id`),
  CONSTRAINT `fk_post_has_plataformas_post1` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post_has_plataformas`
--

LOCK TABLES `post_has_plataformas` WRITE;
/*!40000 ALTER TABLE `post_has_plataformas` DISABLE KEYS */;
INSERT INTO `post_has_plataformas` VALUES (13,7),(21,7);
/*!40000 ALTER TABLE `post_has_plataformas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `password` longtext NOT NULL,
  `rol` enum('user','admin') DEFAULT NULL,
  `foto` longtext,
  `nombre` varchar(100) DEFAULT NULL,
  `create_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username_UNIQUE` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (22,'cueva','$2y$10$Au6vMGmhOVVNctc9u7A/BeqWz7sgwn49M3chVA6kB0QHZw5h5jmxK','admin','3a936fbcbedff147ce59e944dbbf2f7f.png','','2023-06-06 17:15:43',NULL),(23,'prueba','$2y$10$BugnnXPKIeaEJO9L/M4.Gex0HQM/G6L6m3Jgr6ErzfIqvU2mQxhvq','user','','','2023-06-06 17:18:04',NULL),(24,'nuevo','$2y$10$BHWYi8Dyg9AYiMjHsCMA.unoI/OWTkglBsVN1ow.MJl1QUIH51cwy','user','','','2023-06-06 17:27:55',NULL),(25,'nuevo2','$2y$10$0FjvcJXd3zrR1Uw5SmcxD.ZpTXAIq4Io8KI2McN5Dl.bjcqcaTZJW','admin','34be698e9a4c70d554e3e98d19acfda1.png','','2023-06-06 17:31:00',NULL);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-06-19 14:46:09
