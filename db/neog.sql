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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `genero`
--

LOCK TABLES `genero` WRITE;
/*!40000 ALTER TABLE `genero` DISABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `plataformas`
--

LOCK TABLES `plataformas` WRITE;
/*!40000 ALTER TABLE `plataformas` DISABLE KEYS */;
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
  `lanzamiento` date DEFAULT NULL,
  `clasificacion` varchar(45) DEFAULT NULL,
  `create_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `titulo_UNIQUE` (`titulo`),
  KEY `fk_post_user_idx` (`user_id`),
  CONSTRAINT `fk_post_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post`
--

LOCK TABLES `post` WRITE;
/*!40000 ALTER TABLE `post` DISABLE KEYS */;
INSERT INTO `post` VALUES (1,0,'asd','asdasd','asdasd','2023-05-14','2023-05-31','asdasd','2023-06-02 11:26:51',NULL),(5,1,'resident evil','maltin','cueva','2023-04-25','2023-06-15','dsdds','2023-06-02 17:10:10',NULL),(6,1,'jump force','joselin','lesly','2023-01-24','2023-06-24','gore','2023-06-02 17:25:06',NULL),(7,1,'asdasd','asdasd','cueva','2023-01-24','2023-06-24','sdsd','2023-06-02 17:28:12',NULL);
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
/*!40000 ALTER TABLE `post_has_genero` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `post_has_genero1`
--

DROP TABLE IF EXISTS `post_has_genero1`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `post_has_genero1` (
  `post_id` int NOT NULL,
  `genero_id` int NOT NULL,
  PRIMARY KEY (`post_id`,`genero_id`),
  KEY `fk_post_has_genero1_genero1_idx` (`genero_id`),
  KEY `fk_post_has_genero1_post1_idx` (`post_id`),
  CONSTRAINT `fk_post_has_genero1_genero1` FOREIGN KEY (`genero_id`) REFERENCES `genero` (`id`),
  CONSTRAINT `fk_post_has_genero1_post1` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post_has_genero1`
--

LOCK TABLES `post_has_genero1` WRITE;
/*!40000 ALTER TABLE `post_has_genero1` DISABLE KEYS */;
/*!40000 ALTER TABLE `post_has_genero1` ENABLE KEYS */;
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
  `foto` varchar(300) DEFAULT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `create_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username_UNIQUE` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'jose','jose','user',NULL,NULL,'2023-06-02 11:15:17',NULL),(2,'maltin','maltin','user',NULL,NULL,'2023-06-02 11:15:17',NULL),(3,'asdas','$2y$10$O1UZocQcWpF1xzJxQGE7fe.tsZa7tWlTDYVc3cqpBBCdiKNquzN.W','user','','','2023-06-02 11:15:17',NULL),(4,'ewe','$2y$10$QGLulZL1tQeZtii0LuLdXuILa1b7UyeiXraodk/s7FXLGI8DJRYla','user','','','2023-06-02 11:15:17',NULL),(5,'wee','$2y$10$lStivMw84qJ0CHJzkw0gHuquv/CvvjUL.yl3TcvraHXph05uiI8jO','user','','','2023-06-02 11:15:17',NULL),(6,'wewe','$2y$10$Zf9ud8WrSxsp6W2FtL4H2eU4tD8DoipZJRXw.SvM5KlJ1fqgy9j16','user','','','2023-06-02 11:15:17',NULL),(7,'cueva','$2y$10$ShoS8GhIhIz9P2dg7Ye7medHciXHKkiz9SVA8GfBxI1tq6HAJGHVy','user','','','2023-06-02 11:15:17',NULL),(8,'juan','$2y$10$C2S92bdHZJnbpElChPjxke3/mCyxyIA7WKzXEI2XbqZ4nYAatYm6K','user','','','2023-06-02 11:15:17',NULL),(9,'leo','$2y$10$QValvSK6sshZ70/jBoC1nenR8OI4PJeFGiOH/6CnbXpodXbjuIt9q','user','','','2023-06-02 11:16:23','2023-06-02 16:27:44');
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

-- Dump completed on 2023-06-02 16:57:28
