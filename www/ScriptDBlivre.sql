/*
  Auteur : Yoann Meier
  Site de livre
  Version : 3.0
  Dump de la base données du site
*/

-- MySQL dump 10.13  Distrib 8.0.29, for Win64 (x86_64)
--
-- Host: localhost    Database: dblivre
-- ------------------------------------------------------
-- Server version	5.5.5-10.5.15-MariaDB-0+deb11u1

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


DROP DATABASE IF EXISTS dblivre;
CREATE DATABASE dblivre CHARACTER SET utf8 COLLATE utf8_general_ci;

USE dblivre;

--
-- Table structure for table `genre`
--

DROP TABLE IF EXISTS `genre`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `genre` (
  `idgenre` int(11) NOT NULL AUTO_INCREMENT,
  `genre` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idgenre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `genre`
--

LOCK TABLES `genre` WRITE;
/*!40000 ALTER TABLE `genre` DISABLE KEYS */;
INSERT INTO `genre` VALUES (1,'Fantasy'),(2,'Conte et jeunesse'),(3,'Roman'),(4,'Fantastique'),(5,'Policier'),(6,'Fiction'),(7,'Action');
/*!40000 ALTER TABLE `genre` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `liste`
--

DROP TABLE IF EXISTS `liste`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `liste` (
  `idutilisateur` int(11) NOT NULL,
  `idlivre` int(11) NOT NULL,
  PRIMARY KEY (`idutilisateur`,`idlivre`),
  KEY `fk_liste_livre1_idx` (`idlivre`),
  CONSTRAINT `fk_liste_livre1` FOREIGN KEY (`idlivre`) REFERENCES `livre` (`idlivre`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_liste_utilisateur` FOREIGN KEY (`idutilisateur`) REFERENCES `utilisateur` (`idutilisateur`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `liste`
--

LOCK TABLES `liste` WRITE;
/*!40000 ALTER TABLE `liste` DISABLE KEYS */;
INSERT INTO `liste` VALUES (1,3),(1,4),(1,5),(1,6),(1,8),(1,14),(3,4),(3,6),(3,11),(3,12),(3,13);
/*!40000 ALTER TABLE `liste` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `livre`
--

DROP TABLE IF EXISTS `livre`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `livre` (
  `idlivre` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) DEFAULT NULL,
  `annee` int(11) DEFAULT NULL,
  `description` varchar(10000) DEFAULT NULL,
  `auteur` varchar(100) DEFAULT NULL,
  `vente` int(11) DEFAULT NULL,
  `idgenre` int(11) NOT NULL,
  `image` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idlivre`,`idgenre`),
  KEY `fk_livre_genre1_idx` (`idgenre`),
  CONSTRAINT `fk_livre_genre1` FOREIGN KEY (`idgenre`) REFERENCES `genre` (`idgenre`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `livre`
--

LOCK TABLES `livre` WRITE;
/*!40000 ALTER TABLE `livre` DISABLE KEYS */;
INSERT INTO `livre` VALUES (2,'Un conte de deux villes',1859,'Ce roman historique de Charles Dickens met en parall&egrave;le Londres et Paris &agrave; la fin du XVIIIe si&egrave;cle, avant et pendant la R&eacute;volution industrielle.','Charles Dickens',200000000,3,'Un_conte_de_deux_villes.gif'),(3,'Le Seigneur des Anneaux',1955,'Une contr&eacute; paisible o&ugrave; vivent les Hobbits. Un anneau magique &agrave; la puissance infinie. Sauron, son cr&eacute;ateur, pr&ecirc;t &agrave; d&eacute;vaster le monde entier pour r&eacute;cup&eacute;rer son bien. Frodon, jeune Hobbit, d&eacute;tenteur de l&#039;Anneau malgr&eacute; lui. Gandalf, le Magicien, venu avertir Frodon du danger. Et voil&agrave; d&eacute;j&agrave; les Cavaliers Noirs qui approchent.','J.R.R. Tolkien',150000000,1,'seigneurAnneaux.jfif'),(4,'Bilbo le Hobbit',1937,'Bilbo, comme tous les hobbits, est un petit &ecirc;tre paisible qui n&#039;aime pas &ecirc;tre d&eacute;rang&eacute; quand il est &agrave; table. L&#039;aventure lui tombe dessus comme la foudre, quand le magicien Gandalf et treize nains barbus viennent lui parler de tr&eacute;sor, d&#039;exp&eacute;dition p&eacute;rilleuse, et du dragon Smaug qu&#039;il va affronter. Car Bilbo doit partir avec eux ! Et le plus extraordinaire, c&#039;est que le hobbit affrontera tous les dangers, sans jamais perdre son humour, m&ecirc;me s&#039;il tremblera plus d&#039;une fois.','J.R.R. Tolkien',140600000,1,'Bilbo_le_Hobbit.jpg'),(5,'Le Petit Prince',1943,'Le narrateur, un pilote qui est tomb\\u00e9 en panne d&#39;essence dans le Sahara, fait la connaissance d\\u2019un prince extraordinaire venant d\\u2019une autre plan\\u00e8te.','Antoine de Saint-Exup\\u00e9ry',140000000,2,'petitPrince.jfif'),(6,'Harry Potter 1',1997,'Harry Potter, orphelin \\u00e9lev\\u00e9 dans une famille qui ne l&#39;aime pas, voit son existence boulevers\\u00e9e du jour au lendemain. La nuit de son onzi\\u00e8me anniversaire, un g\\u00e9ant vient le chercher pour l&#39;emmener \\u00e0 Poudlard, une \\u00e9cole de sorcellerie.','J.K. Rowling',120000000,4,'HarryPotter.jpg'),(7,'Dix petits n�gres',1939,'Dix personnes sont invit\\u00e9es sur une \\u00eele par un h\\u00f4te inconnu. Elles sont myst\\u00e9rieusement assassin\\u00e9es les unes apr\\u00e8s les autres, suivant une comptine.','Agatha Christie',100000000,5,'DixPetitsNegres.jpg'),(8,'Le Reve dans le pavillon',1791,'Un roman \\u00e9crit au XVIIIe si\\u00e8cle dans lequel prose et vers s&#39;intercalent pour faire revivre une adolescence pass\\u00e9e dans une grande famille mandchoue.','Cao Xueqin',100000000,6,'LeR�veDansLePavillonRouge.jfif'),(9,'Le Ma&icirc;tre et Marguerite',1940,'A Moscou, dans le milieu &eacute;triqu&eacute; des bureaucrates et des \\u00e9crivains officiels arrive un personnage inattendu qui d\\u00e9nonce les hypocrisies : le diable.','Mikha&iuml;l Boulgakov',100000000,3,'Le_Maitre_et_Marguerite.jpg'),(10,'Alice au pays des merveilles',1865,'Alice est une enfant d&eacute;routante qui va faire la rencontre d&#039;une multitude de personnages d&eacute;fiant toute logique apr&egrave;s avoir suivi un curieux lapin.','Lewis Carroll',100000000,2,'AliceAuPaysDesMerveilles.jpg'),(11,'Harry Potter 2',1998,'Harry Potter fait une deuxi&egrave;me rentr&eacute;e &agrave; l&#039;&eacute;cole des sorciers. Cette ann&eacute;e d&eacute;bute de fa\\u00e7on &eacute;trange quand une mal&eacute;diction s&#039;abat sur les &eacute;l&egrave;ves.','J.K. Rowling',77000000,4,'Harry_Potter_et_la_Chambre_des_secrets.jpg'),(12,'Harry Potter 3',1999,'Sirius Black, le dangereux criminel qui s&#039;est &eacute;chapp&eacute; de la forteresse d&#039;Azkaban, recherche Harry Potter. Suivez Harry dans sa 3&egrave;me ann&eacute;e &agrave; Poudlard.','J.K. Rowling',65000000,4,'Harry_Potter_et_le_Prisonnier_d_Azkaban.jpg'),(13,'Harry Potter 4',2000,'Une grande nouvelle attend Harry &agrave; Poudlard : la tenue d&#039;un tournoi de magie. Il va se trouver plong&eacute; au c&oelig;ur d&#039;&eacute;v&eacute;nements des plus dramatiques.','J.K. Rowling',65000000,4,'HarryPotter4.jfif'),(14,'Don Quichotte',1615,'Alonzo Quixada sera chevalier sous le nom de Don Quichotte ! Les gens le traitent de fou, mais qu&#039;importe. Il veut vivre comme les h&eacute;ros de romans. Sur les routes d&#039;Espagne, le voil&agrave; parti en qu&ecirc;te d&#039;exploits, intr&eacute;pide et g&eacute;n&eacute;reux. Avec Sancho Panza, son fid&egrave;le &eacute;cuyer, il va vivre de fabuleuses aventures. Mais pas du tout celles qu&#039;il imaginait !\r\n\r\n','Miguel de Cervant&egrave;s',500000000,3,'donQuichotte.jfif');
/*!40000 ALTER TABLE `livre` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `utilisateur` (
  `idutilisateur` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(45) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `mdp` varchar(100) DEFAULT NULL,
  `role` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idutilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `utilisateur`
--

LOCK TABLES `utilisateur` WRITE;
/*!40000 ALTER TABLE `utilisateur` DISABLE KEYS */;
INSERT INTO `utilisateur` VALUES (1,'Yoann','yoann.mr@eduge.ch','$2y$10$KGEBqxIbdtzleqbso8Rz2ufFzNpxUJRk5f2QYT4VYAZKOn0pUysyy','utilisateur'),(2,'Admin','admin@eduge.ch','$2y$10$KGEBqxIbdtzleqbso8Rz2ufFzNpxUJRk5f2QYT4VYAZKOn0pUysyy','admin'),(3,'Jean','jean@bon.gmail.com','$2y$10$jF0mIffmu8t9qbGJZAdwXOHtPrWHBVzrKzNJ0Zu2Vpud6d9NEGvL2','utilisateur');
/*!40000 ALTER TABLE `utilisateur` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'dblivre'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-06-08 13:20:03
