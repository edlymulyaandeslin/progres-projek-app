-- MySQL dump 10.13  Distrib 8.0.19, for Win64 (x86_64)
--
-- Host: localhost    Database: progres_projek
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.28-MariaDB

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
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `judulprojeks`
--

DROP TABLE IF EXISTS `judulprojeks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `judulprojeks` (
  `id` char(26) NOT NULL,
  `user_id` char(26) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `pembimbing` varchar(255) NOT NULL DEFAULT '',
  `status` varchar(255) NOT NULL DEFAULT 'diajukan',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `judulprojeks`
--

LOCK TABLES `judulprojeks` WRITE;
/*!40000 ALTER TABLE `judulprojeks` DISABLE KEYS */;
INSERT INTO `judulprojeks` VALUES ('01hjmh9amqwh3wt99ctjfd2mx0','5','Dr.','Ms. Jada Hauck DVM','diajukan','2023-12-26 19:22:33','2023-12-26 19:22:33');
/*!40000 ALTER TABLE `judulprojeks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `levels`
--

DROP TABLE IF EXISTS `levels`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `levels` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `levels`
--

LOCK TABLES `levels` WRITE;
/*!40000 ALTER TABLE `levels` DISABLE KEYS */;
INSERT INTO `levels` VALUES (1,'mahasiswa','2023-12-26 19:22:33','2023-12-26 19:22:33'),(2,'mentor','2023-12-26 19:22:33','2023-12-26 19:22:33'),(3,'koordinator','2023-12-26 19:22:33','2023-12-26 19:22:33'),(4,'admin','2023-12-26 19:22:33','2023-12-26 19:22:33');
/*!40000 ALTER TABLE `levels` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `logbooks`
--

DROP TABLE IF EXISTS `logbooks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `logbooks` (
  `id` char(26) NOT NULL,
  `user_id` char(26) NOT NULL,
  `judul_id` char(26) NOT NULL,
  `description` text NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'diajukan',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `logbooks`
--

LOCK TABLES `logbooks` WRITE;
/*!40000 ALTER TABLE `logbooks` DISABLE KEYS */;
INSERT INTO `logbooks` VALUES ('01hjmh9an2wy5errty49n4g1t9','3','1','Provident cum deserunt facilis dolores inventore tenetur qui optio modi.','diajukan','2023-12-26 19:22:33','2023-12-26 19:22:33'),('01hjmh9an8p4frbvjwhd1ewpqa','1','1','Quisquam aut exercitationem et velit occaecati aut sequi quidem mollitia rerum rerum et.','diajukan','2023-12-26 19:22:33','2023-12-26 19:22:33'),('01hjmh9anc37gsvhnhs2qjt06a','2','1','Itaque id placeat omnis exercitationem maxime aut odit corporis asperiores est temporibus soluta laboriosam.','diajukan','2023-12-26 19:22:33','2023-12-26 19:22:33'),('01hjmh9anh3ehvn1ca58d8vmg1','4','1','Enim quia molestiae doloribus provident iure excepturi rem.','diajukan','2023-12-26 19:22:33','2023-12-26 19:22:33'),('01hjmh9ann4dvz04bxqfn9b4eb','3','1','Dolor ipsa aut delectus quae cum vitae.','diajukan','2023-12-26 19:22:33','2023-12-26 19:22:33');
/*!40000 ALTER TABLE `logbooks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_reset_tokens_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2019_12_14_000001_create_personal_access_tokens_table',1),(5,'2023_12_06_015517_create_presentasis_table',1),(6,'2023_12_06_015547_create_logbooks_table',1),(7,'2023_12_06_015628_create_judulprojeks_table',1),(8,'2023_12_06_023314_create_levels_table',1),(9,'2023_12_13_142618_add_status_to_users',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `presentasis`
--

DROP TABLE IF EXISTS `presentasis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `presentasis` (
  `id` char(26) NOT NULL,
  `user_id` char(26) NOT NULL,
  `judul_id` char(26) NOT NULL,
  `tanggal` varchar(255) NOT NULL DEFAULT '',
  `jam` varchar(255) NOT NULL DEFAULT '',
  `status` varchar(255) NOT NULL DEFAULT 'diajukan',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `presentasis`
--

LOCK TABLES `presentasis` WRITE;
/*!40000 ALTER TABLE `presentasis` DISABLE KEYS */;
INSERT INTO `presentasis` VALUES ('01hjmh9anvkc6hqhpa9t82p15x','5','1','1974-05-06','11:18:56','diajukan','2023-12-26 19:22:33','2023-12-26 19:22:33');
/*!40000 ALTER TABLE `presentasis` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` char(26) NOT NULL,
  `level_id` bigint(20) unsigned NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `tempat_lahir` varchar(255) NOT NULL,
  `tanggal_lahir` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `agama` varchar(255) NOT NULL,
  `jenis_kelamin` varchar(255) NOT NULL,
  `pekerjaan` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tanggal_mulai` varchar(255) NOT NULL DEFAULT '',
  `tanggal_selesai` varchar(255) NOT NULL DEFAULT '',
  `status` varchar(255) NOT NULL DEFAULT 'deactive',
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES ('01hjmh9am9kzrqedapcsjbtgdh',3,'Dina Rahayu','dinarahayu@gmail.com','$2y$12$VhAwJf1TKIPhu7jf83fwiOb32ymwt/0GVwsaIqhAyttH5GslWkCe6','Mumbai','2010-03-19','Pasir pengaraian, Rokan hulu','islam','laki-laki','Medical Technician','2023-12-26 19:22:33','dEJBGOwXNv','2023-12-26 19:22:33','2023-12-26 19:22:33','','','deactive'),('01hjmh99a3340r2p8fjpbnjb98',4,'Edly Mulya Andeslin','edlymulyaandeslin@gmail.com','$2y$12$Ttj1vtIvN1TAZpvQYn10Xefb5FzN9hHlYtbRQxB6iuGst.FEuQR0.','Pasir Pengaraian','2002-03-09','Pasir pengaraian, Rokan hulu','islam','perempuan','Crushing Grinding Machine Operator','2023-12-26 19:22:31','JCi9Z0OtWa','2023-12-26 19:22:31','2023-12-26 19:22:31','','','deactive'),('01hjmh9a9sq5vasp310r8wassn',2,'Laska Prayoga','laskaprayoga@gmail.com','$2y$12$/1CEYXA9reel/EKKouuzeOIf1GbgVi147S2nVZwj03DTqmqQA950S','Dalu Dalu','2007-03-19','Pasir pengaraian, Rokan hulu','islam','perempuan','Executive Secretary','2023-12-26 19:22:32','7Ujk8ime07','2023-12-26 19:22:32','2023-12-26 19:22:32','','','deactive'),('01hjmh99mx9tf2s1qahks3mnxn',1,'Rian Lesmana','rianlesmanaputra@gmail.com','$2y$12$f5nn6wvVfop/jH6SNlbteeoA5yMXxz2taGafA10Rb/gr/1.36ro4m','Surau Gading','2014-03-19','Pasir pengaraian, Rokan hulu','islam','perempuan','Operations Research Analyst','2023-12-26 19:22:32','tf8OXDwaZp','2023-12-26 19:22:32','2023-12-26 19:22:32','','','deactive'),('01hjmh99z8j5jxmg0jrcm4sssm',1,'Sayyid Jafar','sundek@gmail.com','$2y$12$4UJyCNQu5iGtW2GTg2/ge.BrhkakUfLCU5S0gM8l1h7SWjoF88bWq','Mumbai','2010-03-19','Pasir pengaraian, Rokan hulu','islam','perempuan','Visual Designer','2023-12-26 19:22:32','dVVh0cbchc','2023-12-26 19:22:32','2023-12-26 19:22:32','','','deactive');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'progres_projek'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-12-27  9:23:56
