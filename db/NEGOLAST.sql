CREATE DATABASE  IF NOT EXISTS `neog` /*!40100 DEFAULT CHARACTER SET utf8mb3 */ /*!80016 DEFAULT ENCRYPTION='N' */;
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
-- Table structure for table `genero`
--

DROP TABLE IF EXISTS `genero`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `genero` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `genero`
--

LOCK TABLES `genero` WRITE;
/*!40000 ALTER TABLE `genero` DISABLE KEYS */;
INSERT INTO `genero` VALUES (1,'Survival Horror'),(2,'Ciecia ficcion'),(3,'Anime'),(4,''),(5,''),(6,''),(7,''),(8,''),(9,''),(10,'terror'),(11,''),(12,'Drama');
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `plataformas`
--

LOCK TABLES `plataformas` WRITE;
/*!40000 ALTER TABLE `plataformas` DISABLE KEYS */;
INSERT INTO `plataformas` VALUES (1,'ps4'),(2,'ps5'),(3,'xbox'),(4,'pc');
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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post`
--

LOCK TABLES `post` WRITE;
/*!40000 ALTER TABLE `post` DISABLE KEYS */;
INSERT INTO `post` VALUES (1,0,'asd','asdasd','asdasd','2023-05-14','2023-05-31','',NULL,'2023-06-02 11:26:51',NULL),(5,1,'resident evil','maltin','cueva','2023-04-25','2023-06-15','',NULL,'2023-06-02 17:10:10',NULL),(6,1,'jump force','joselin','lesly','2023-01-24','2023-06-24','',NULL,'2023-06-02 17:25:06',NULL),(7,1,'asdasd','asdasd','cueva','2023-01-24','2023-06-24','',NULL,'2023-06-02 17:28:12',NULL),(8,7,'Watch Dog Legion','Ubisof Toronto','Steam','2022-12-15','2023-01-26','78c06db7be06a3908438109bfe879337.png','Este es un juego de','2023-06-05 18:44:02',NULL),(9,7,'Resident Evil 4','Capcom','Steam','2023-06-06','2023-06-14','c876e8479e04a303c5de7d26cfbf2b2e.png','Resident Evil 4 es una versión actualizada del juego original de 2005, uno de los títulos más populares y aclamados de la serie. En este juego, los jugadores asumen el papel del agente especial Leon S.           Kennedy mientras investiga una misteriosa aldea en Europa que está           infectada por un nuevo tipo de virus. Con una jugabilidad mejorada, gráficos mejorados y nuevas características, Resident Evil 4 promete ser una experiencia emocionante y aterradora para los fanáticos de la serie.','2023-06-05 22:41:06',NULL),(10,7,'street fighter 6','Capcom','Bandai','2023-06-04','2023-06-21','d087b345725d3a19ed9f85be6239c62b.jpg','Juego de pelea.......','2023-06-06 03:12:27',NULL);
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
  KEY `fk_post_has_genero_post_idx` (`post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post_has_genero`
--

LOCK TABLES `post_has_genero` WRITE;
/*!40000 ALTER TABLE `post_has_genero` DISABLE KEYS */;
INSERT INTO `post_has_genero` VALUES (5,1),(6,1),(5,2),(8,2),(8,3);
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
INSERT INTO `post_has_plataformas` VALUES (5,1),(8,1),(5,2),(6,2);
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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'jose','$2y$10$FykV5YRmBTbt5q2Z3mOR/OxBKNa0XHo3pA6OLJTvK4TdELUMm3UHq','user','eae439a3e6e1f5162e2658c3dffaa57e.png','jose martin','2023-06-02 11:15:17','2023-06-05 17:31:55'),(2,'maltin','maltin','user',NULL,NULL,'2023-06-02 11:15:17',NULL),(3,'asdas','$2y$10$O1UZocQcWpF1xzJxQGE7fe.tsZa7tWlTDYVc3cqpBBCdiKNquzN.W','user','','','2023-06-02 11:15:17',NULL),(4,'ewe','$2y$10$QGLulZL1tQeZtii0LuLdXuILa1b7UyeiXraodk/s7FXLGI8DJRYla','user','','machin','2023-06-02 11:15:17','2023-06-04 18:07:59'),(5,'wee','$2y$10$lStivMw84qJ0CHJzkw0gHuquv/CvvjUL.yl3TcvraHXph05uiI8jO','user','','','2023-06-02 11:15:17',NULL),(6,'wewe','$2y$10$Zf9ud8WrSxsp6W2FtL4H2eU4tD8DoipZJRXw.SvM5KlJ1fqgy9j16','user','','','2023-06-02 11:15:17',NULL),(7,'cueva','$2y$10$.PqKBiT3WikY3JvxxthxX.H6UBlRKCM/fMgW9PcSdHaA5XQ852G3y','user','06923712ebebed2296e90e93d43d73c7.jpg','josexd','2023-06-02 11:15:17','2023-06-06 14:51:00'),(8,'juan','$2y$10$C2S92bdHZJnbpElChPjxke3/mCyxyIA7WKzXEI2XbqZ4nYAatYm6K','user','','','2023-06-02 11:15:17',NULL),(9,'leo','$2y$10$QValvSK6sshZ70/jBoC1nenR8OI4PJeFGiOH/6CnbXpodXbjuIt9q','user','','','2023-06-02 11:16:23','2023-06-02 16:27:44'),(10,'joselin','$2y$10$Xl8yEnH4Vbn1UmFLZO9kHOgtkfMtkZ60lcOJalIlePGoOokhu458q','user','','','2023-06-04 04:33:29',NULL),(11,'nando','$2y$10$HvimybL.jXJk0Y9.Q3VuSOs8UOqGEZgd3nTKRF1i1pO4FY9i1uUra','user','','','2023-06-04 04:34:57',NULL),(12,'dani','$2y$10$BFRa5QLch7loUsjQ7JHJP.WdBbvboqyNRSqGotK0k60fAEoUHvUFi','user','','','2023-06-04 04:55:24',NULL),(13,'brant','$2y$10$XIZ5cP3xFFGstdZfSCcu1O6bdoAYvrIfMwzfg34E9B4XRkC7oEsoi','user','','','2023-06-06 03:29:20',NULL),(14,'josy','$2y$10$OcGR1138s4/iMTbbjlKDZusfDVtr0aZcmekUUyEzikhvN/kQ9ED02','user','','','2023-06-06 14:49:23',NULL),(15,'ilegal','$2y$10$.PqKBiT3WikY3JvxxthxX.H6UBlRKCM/fMgW9PcSdHaA5XQ852G3y','admin','','','2023-06-06 14:50:38','2023-06-06 15:00:01');
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

-- Dump completed on 2023-06-09 10:27:27
