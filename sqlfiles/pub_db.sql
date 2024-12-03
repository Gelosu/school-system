-- MySQL dump 10.13  Distrib 8.0.36, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: pub_db
-- ------------------------------------------------------
-- Server version	8.0.37

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
-- Table structure for table `documents`
--

DROP TABLE IF EXISTS `documents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `documents` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci NOT NULL,
  `file_json` text COLLATE utf8mb4_general_ci NOT NULL,
  `user_id` int NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `documents`
--

LOCK TABLES `documents` WRITE;
/*!40000 ALTER TABLE `documents` DISABLE KEYS */;
INSERT INTO `documents` VALUES (1,'GREETINGS TO NEW KLD WEBSITE ','&lt;p&gt;Good day everyone,&lt;br&gt;To Honored professors, dear students, respected colleagues, and distinguished guests,&lt;/p&gt;&lt;p&gt;It is with immense excitement and pride that I welcome you all to this very special occasion&mdash;the launch of the new and improved KLD website. Today marks a significant step forward in our journey of fostering knowledge, connection, and innovation, and I&rsquo;m thrilled that we can share this moment together.&lt;/p&gt;&lt;p&gt;As we know, technology is no longer just a tool; it&rsquo;s a bridge that connects ideas, people, and opportunities. With that in mind, our mission at KLD has always been to create a platform that empowers its users&mdash;whether you&rsquo;re a student pursuing academic growth, a professor sharing your wisdom, or a professional seeking cutting-edge solutions.&lt;/p&gt;&lt;p&gt;The revamped KLD website represents a fresh, user-friendly design that is not only visually appealing but also loaded with features designed to meet your needs:&lt;/p&gt;&lt;ul&gt;&lt;li&gt;&lt;strong&gt;For students&lt;/strong&gt;, we&rsquo;ve enhanced accessibility to resources, enabling you to learn faster, connect smarter, and grow without limits.&lt;/li&gt;&lt;li&gt;&lt;strong&gt;For our professors&lt;/strong&gt;, we&rsquo;ve streamlined tools to make your invaluable contributions more impactful and accessible to the wider audience.&lt;/li&gt;&lt;li&gt;&lt;strong&gt;For partners and collaborators&lt;/strong&gt;, our site offers a dynamic space to network and exchange innovative ideas.&lt;/li&gt;&lt;/ul&gt;&lt;p&gt;Every feature, every update, every pixel of this website was built with you in mind. Your feedback over the years has been our guiding light, and we&rsquo;ve worked tirelessly to incorporate suggestions, simplify processes, and deliver a seamless experience that reflects KLD&rsquo;s vision of excellence.&lt;/p&gt;&lt;p&gt;I want to take a moment to thank all the brilliant minds who made this website a reality. From developers and designers to content creators and strategists, your hard work and dedication have brought this dream to life.&lt;/p&gt;&lt;p&gt;But this is just the beginning. As we navigate this new chapter, we invite all of you to explore the website, engage with its features, and share your thoughts. Your continued input will help us grow even stronger together.&lt;/p&gt;&lt;p&gt;Let&rsquo;s celebrate this milestone as a reminder of what we can achieve when innovation meets collaboration. On behalf of everyone at KLD, I welcome you to the future of learning, discovery, and engagement.&lt;/p&gt;&lt;p&gt;Thank you, and let&rsquo;s make the most of this exciting new journey together!&lt;/p&gt;															','[\"1732439580_kldbuilding.jpg\"]',1,'2024-11-24 17:13:39'),(2,'TEST YOUTUBE VIDEO','&lt;p&gt;VIdeo of bruno mars and lady gaga please be inspired students&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;&lt;b&gt;DIE WITH A SMILE&lt;/b&gt;&lt;/p&gt;&lt;p&gt;&lt;b&gt;&lt;br&gt;&lt;/b&gt;&lt;/p&gt;&lt;p&gt;&lt;b&gt;https://www.youtube.com/watch?v=fnPxkuFIA48&lt;/b&gt;&lt;br&gt;&lt;/p&gt;','null',1,'2024-11-24 17:24:07'),(3,'TESTING GDRIVE LINK','&lt;p&gt;&lt;b&gt;GDRIVE LINK&lt;/b&gt;&lt;/p&gt;&lt;p&gt;&lt;b&gt;TEST PURPOSES :&amp;gt;&lt;/b&gt;&lt;/p&gt;&lt;p&gt;&lt;b&gt;https://drive.google.com/file/d/1HypZInsbz2Y-a0ZnufBGC0TBuNpN_y1m/view?usp=sharing&lt;/b&gt;&lt;br&gt;&lt;/p&gt;','null',1,'2024-11-24 17:27:04'),(4,'UPLOADING PICTURE TEST ','&lt;b&gt;&lt;span style=&quot;font-size: 24px;&quot;&gt;GENSHIN IMPACT IS THE BEST GAME OF THE YEAR!!!!&lt;/span&gt;&lt;/b&gt;','[\"1732441020_download (2).jfif\",\"1732441020_download (5).jfif\",\"1732441020_download (4).jfif\",\"1732441020_download.jfif\",\"1732441020_download (3).jfif\",\"1732441020_download (6).jfif\",\"1732441020_download (1).jfif\"]',1,'2024-11-24 17:37:05'),(5,'UPLOADING ONE IMAGE','DBSABDSADABDSABDBSADBABDABDBSADBABDABDASBDBSADBSABDABDBADBABDABDBDBSABDSADABDSABDBSADBABDABDBSADBABDABDASBDBSADBSABDABDBADBABDABDBDBSABDSADABDSABDBSADBABDABDBSADBABDABDASBDBSADBSABDABDBADBABDABDBDBSABDSADABDSABDBSADBABDABDBSADBABDABDASBDBSADBSABDABDBADBABDABDBDBSABDSADABDSABDBSADBABDABDBSADBABDABDASBDBSADBSABDABDBADBABDABDBDBSABDSADABDSABDBSADBABDABDBSADBABDABDASBDBSADBSABDABDBADBABDABDBDBSABDSADABDSABDBSADBABDABDBSADBABDABDASBDBSADBSABDABDBADBABDABDBDBSABDSADABDSABDBSADBABDABDBSADBABDABDASBDBSADBSABDABDBADBABDABDBDBSABDSADABDSABDBSADBABDABDBSADBABDABDASBDBSADBSABDABDBADBABDABDBDBSABDSADABDSABDBSADBABDABDBSADBABDABDASBDBSADBSABDABDBADBABDABDBDBSABDSADABDSABDBSADBABDABDBSADBABDABDASBDBSADBSABDABDBADBABDABDBDBSABDSADABDSABDBSADBABDABDBSADBABDABDASBDBSADBSABDABDBADBABDABDBDBSABDSADABDSABDBSADBABDABDBSADBABDABDASBDBSADBSABDABDBADBABDABDBDBSABDSADABDSABDBSADBABDABDBSADBABDABDASBDBSADBSABDABDBADBABDABDBDBSABDSADABDSABDBSADBABDABDBSADBABDABDASBDBSADBSABDABDBADBABDABDBDBSABDSADABDSABDBSADBABDABDBSADBABDABDASBDBSADBSABDABDBADBABDABDBDBSABDSADABDSABDBSADBABDABDBSADBABDABDASBDBSADBSABDABDBADBABDABDBDBSABDSADABDSABDBSADBABDABDBSADBABDABDASBDBSADBSABDABDBADBABDABDBDBSABDSADABDSABDBSADBABDABDBSADBABDABDASBDBSADBSABDABDBADBABDABDB','[\"1732441440_download (2).jfif\"]',4,'2024-11-24 17:44:31');
/*!40000 ALTER TABLE `documents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `firstname` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `lastname` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `middlename` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `contact` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `address` text COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `password` text COLLATE utf8mb4_general_ci NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT '2' COMMENT '1=Admin,2= users',
  `avatar` text COLLATE utf8mb4_general_ci NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Admin','Admin','','+12354654787','Sample','admin@admin.com','0192023a7bbd73250516f069df18b500',1,'','2020-11-11 15:35:19'),(2,'John','Smith','C','+14526-5455-44','Address','jsmith@sample.com','1254737c076cf867dc53d60a0364f38e',2,'1605080820_avatar.jpg','2020-11-11 09:24:40'),(3,'dej','p','c','0999999999','b3 l18','dej@gmail.com','e80172c1d41584d525bcacfb7c2440db',2,'','2024-11-14 22:53:06'),(4,'CHRISTIAN ANGELO','DUMAOP','ESPIRITU','09298196821','DSABDASDSADADADA','angelo.dumaop01@gmail.com','827ccb0eea8a706c4c34a16891f84e7b',2,'1732436700_1605057840_avatar.jpg','2024-11-24 13:59:20');
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

-- Dump completed on 2024-12-02 15:08:20
