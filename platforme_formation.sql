-- MySQL dump 10.13  Distrib 8.0.46, for Linux (x86_64)
--
-- Host: localhost    Database: platforme_formation
-- ------------------------------------------------------
-- Server version	8.0.46-0ubuntu0.24.04.4

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
-- Table structure for table `cours`
--

DROP TABLE IF EXISTS `cours`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cours` (
  `id_cours` int NOT NULL AUTO_INCREMENT,
  `title` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_cours`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cours`
--

LOCK TABLES `cours` WRITE;
/*!40000 ALTER TABLE `cours` DISABLE KEYS */;
INSERT INTO `cours` VALUES (1,'Python pour débutants'),(2,'Bases de données MySQL'),(3,'Développement Web'),(4,'Introduction à Data Science');
/*!40000 ALTER TABLE `cours` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inscription`
--

DROP TABLE IF EXISTS `inscription`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `inscription` (
  `id_user` int NOT NULL,
  `id_cours` int NOT NULL,
  `date` varchar(50) DEFAULT NULL,
  `statu` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_user`,`id_cours`),
  KEY `k1` (`id_cours`),
  CONSTRAINT `inscription_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`),
  CONSTRAINT `k1` FOREIGN KEY (`id_cours`) REFERENCES `cours` (`id_cours`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inscription`
--

LOCK TABLES `inscription` WRITE;
/*!40000 ALTER TABLE `inscription` DISABLE KEYS */;
INSERT INTO `inscription` VALUES (1,1,'2026-09-01','EN_COURS'),(1,2,'2026-09-05','EN_COURS'),(2,1,'2026-09-03','EN_COURS'),(2,3,'2026-09-10','EN_COURS'),(3,1,'2026-09-04','TERMINE'),(3,4,'2026-09-12','EN_COURS'),(4,2,'2026-09-08','EN_COURS');
/*!40000 ALTER TABLE `inscription` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lecons`
--

DROP TABLE IF EXISTS `lecons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `lecons` (
  `id_lecon` int NOT NULL AUTO_INCREMENT,
  `lec_title` varchar(50) DEFAULT NULL,
  `id_module` int NOT NULL,
  PRIMARY KEY (`id_lecon`),
  KEY `k3` (`id_module`),
  CONSTRAINT `k3` FOREIGN KEY (`id_module`) REFERENCES `module` (`id_module`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lecons`
--

LOCK TABLES `lecons` WRITE;
/*!40000 ALTER TABLE `lecons` DISABLE KEYS */;
INSERT INTO `lecons` VALUES (1,'Qu’est-ce que Python ?',1),(2,'Installation de Python',1),(3,'Variables en Python',2),(4,'Types de données',2),(5,'Les conditions if else',3),(6,'Les boucles for et while',3),(7,'Créer une fonction',4),(8,'Paramètres et retour',4),(9,'Introduction à MySQL',5),(10,'Créer une base de données',5),(11,'CREATE TABLE',6),(12,'INSERT INTO',6),(13,'Clés primaires',7),(14,'Clés étrangères',7),(15,'SELECT et WHERE',8),(16,'JOIN en MySQL',8),(17,'Structure HTML',9),(18,'Les sélecteurs CSS',9),(19,'Introduction à JavaScript',10),(20,'Variables JavaScript',10),(21,'Introduction au Backend',11),(22,'Introduction à la Data Science',12),(23,'Introduction à NumPy',13),(24,'Introduction à Pandas',13),(25,'Nettoyage des données',14),(26,'Analyse statistique',14);
/*!40000 ALTER TABLE `lecons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `module`
--

DROP TABLE IF EXISTS `module`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `module` (
  `id_module` int NOT NULL AUTO_INCREMENT,
  `mod_title` varchar(50) DEFAULT NULL,
  `mod_ordre` varchar(10) DEFAULT NULL,
  `id_cours` int NOT NULL,
  PRIMARY KEY (`id_module`),
  KEY `k2` (`id_cours`),
  CONSTRAINT `k2` FOREIGN KEY (`id_cours`) REFERENCES `cours` (`id_cours`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `module`
--

LOCK TABLES `module` WRITE;
/*!40000 ALTER TABLE `module` DISABLE KEYS */;
INSERT INTO `module` VALUES (1,'Introduction à Python','1',1),(2,'Variables et types','2',1),(3,'Conditions et boucles','3',1),(4,'Fonctions Python','4',1),(5,'Introduction à MySQL','1',2),(6,'Création des tables','2',2),(7,'Clés et relations','3',2),(8,'Requêtes SQL','4',2),(9,'HTML et CSS','1',3),(10,'JavaScript','2',3),(11,'Backend','3',3),(12,'Introduction à la Data Science','1',4),(13,'NumPy et Pandas','2',4),(14,'Analyse de données','3',4);
/*!40000 ALTER TABLE `module` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `progression`
--

DROP TABLE IF EXISTS `progression`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `progression` (
  `id_user` int NOT NULL,
  `id_lecon` int NOT NULL,
  `proportion` float DEFAULT NULL,
  `statu` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id_user`,`id_lecon`),
  KEY `mulkey_prog1` (`id_lecon`),
  CONSTRAINT `mulkey_prog` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`),
  CONSTRAINT `mulkey_prog1` FOREIGN KEY (`id_lecon`) REFERENCES `lecons` (`id_lecon`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `progression`
--

LOCK TABLES `progression` WRITE;
/*!40000 ALTER TABLE `progression` DISABLE KEYS */;
INSERT INTO `progression` VALUES (1,1,0.75,'OUI'),(1,2,1,'OUI'),(1,3,0.75,'ENCOURS'),(1,4,0,'NON'),(1,9,0.5,'ENCOURS'),(1,10,0,'NON'),(2,1,0.25,'OUI'),(2,2,0.5,'ENCOURS'),(2,17,0.25,'ENCOURS'),(3,1,0.25,'OUI'),(3,2,1,'OUI'),(3,3,1,'OUI'),(3,4,1,'OUI'),(3,22,0.5,'ENCOURS'),(4,9,1,'OUI'),(4,10,0.75,'ENCOURS'),(4,11,0,'NON'),(5,22,1,'OUI'),(5,23,0.5,'ENCOURS'),(5,24,0.25,'ENCOURS');
/*!40000 ALTER TABLE `progression` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `role` enum('STUDENT','TEACHER','ADMIN') NOT NULL,
  `password` varchar(200) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Sedera','sedera@gmail.com','ADMIN','1234'),(2,'Jean','jean@gmail.com','STUDENT',''),(3,'Sarah','sarah@gmail.com','STUDENT','1234'),(4,'Paul','paul@gmail.com','STUDENT',''),(5,'Marie','marie@gmail.com','STUDENT',''),(6,'sedera123','sedera123@gmail.com','STUDENT','1234'),(7,'sedera123','sedera123@gmail.com','STUDENT','1234'),(8,'sss','ssss@gil.co','STUDENT','1111'),(9,'sedera1234','test@gmail.com','STUDENT','1234');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-10-09 22:53:55
