-- MySQL dump 10.13  Distrib 8.0.46, for Linux (x86_64)
--
-- Host: localhost    Database: event_system
-- ------------------------------------------------------
-- Server version	8.0.46-0ubuntu0.24.04.3

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
-- Table structure for table `approval_bands`
--

DROP TABLE IF EXISTS `approval_bands`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `approval_bands` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `event_id` bigint unsigned NOT NULL,
  `role_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level_sequence` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `approval_bands_event_id_foreign` (`event_id`),
  CONSTRAINT `approval_bands_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `approval_bands`
--

LOCK TABLES `approval_bands` WRITE;
/*!40000 ALTER TABLE `approval_bands` DISABLE KEYS */;
INSERT INTO `approval_bands` VALUES (1,1,'Manager',1,'2026-08-25 12:37:46','2026-08-25 12:37:46'),(2,2,'Manager',1,'2026-08-25 12:37:46','2026-08-25 12:37:46'),(3,3,'Manager',1,'2026-08-25 12:37:46','2026-08-25 12:37:46'),(4,4,'Manager',1,'2026-08-25 12:37:46','2026-08-25 12:37:46'),(5,5,'Manager',1,'2026-08-25 12:37:46','2026-08-25 12:37:46'),(6,6,'Manager',1,'2026-08-25 12:37:46','2026-08-25 12:37:46'),(7,7,'Manager',1,'2026-08-25 12:37:46','2026-08-25 12:37:46'),(8,8,'Manager',1,'2026-08-25 12:37:46','2026-08-25 12:37:46'),(9,9,'Manager',1,'2026-08-25 12:37:46','2026-08-25 12:37:46'),(10,10,'Manager',1,'2026-08-25 12:37:46','2026-08-25 12:37:46'),(11,11,'Manager',1,'2026-08-25 12:37:46','2026-08-25 12:37:46'),(12,12,'Manager',1,'2026-08-25 12:37:46','2026-08-25 12:37:46');
/*!40000 ALTER TABLE `approval_bands` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `event_quotas`
--

DROP TABLE IF EXISTS `event_quotas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `event_quotas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `event_id` bigint unsigned NOT NULL,
  `role_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quota_limit` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `event_quotas_event_id_foreign` (`event_id`),
  CONSTRAINT `event_quotas_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `event_quotas`
--

LOCK TABLES `event_quotas` WRITE;
/*!40000 ALTER TABLE `event_quotas` DISABLE KEYS */;
INSERT INTO `event_quotas` VALUES (1,1,'Employee',50,'2026-08-25 12:37:46','2026-08-25 12:37:46'),(2,1,'Manager',15,'2026-08-25 12:37:46','2026-08-25 12:37:46'),(3,2,'Employee',50,'2026-08-25 12:37:46','2026-08-25 12:37:46'),(4,2,'Manager',15,'2026-08-25 12:37:46','2026-08-25 12:37:46'),(5,3,'Employee',50,'2026-08-25 12:37:46','2026-08-25 12:37:46'),(6,3,'Manager',15,'2026-08-25 12:37:46','2026-08-25 12:37:46'),(7,4,'Employee',50,'2026-08-25 12:37:46','2026-08-25 12:37:46'),(8,4,'Manager',15,'2026-08-25 12:37:46','2026-08-25 12:37:46'),(9,5,'Employee',50,'2026-08-25 12:37:46','2026-08-25 12:37:46'),(10,5,'Manager',15,'2026-08-25 12:37:46','2026-08-25 12:37:46'),(11,6,'Employee',50,'2026-08-25 12:37:46','2026-08-25 12:37:46'),(12,6,'Manager',15,'2026-08-25 12:37:46','2026-08-25 12:37:46'),(13,7,'Employee',50,'2026-08-25 12:37:46','2026-08-25 12:37:46'),(14,7,'Manager',15,'2026-08-25 12:37:46','2026-08-25 12:37:46'),(15,8,'Employee',50,'2026-08-25 12:37:46','2026-08-25 12:37:46'),(16,8,'Manager',15,'2026-08-25 12:37:46','2026-08-25 12:37:46'),(17,9,'Employee',50,'2026-08-25 12:37:46','2026-08-25 12:37:46'),(18,9,'Manager',15,'2026-08-25 12:37:46','2026-08-25 12:37:46'),(19,10,'Employee',50,'2026-08-25 12:37:46','2026-08-25 12:37:46'),(20,10,'Manager',15,'2026-08-25 12:37:46','2026-08-25 12:37:46'),(21,11,'Employee',50,'2026-08-25 12:37:46','2026-08-25 12:37:46'),(22,11,'Manager',15,'2026-08-25 12:37:46','2026-08-25 12:37:46'),(23,12,'Employee',50,'2026-08-25 12:37:46','2026-08-25 12:37:46'),(24,12,'Manager',15,'2026-08-25 12:37:46','2026-08-25 12:37:46');
/*!40000 ALTER TABLE `event_quotas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `events` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` bigint unsigned NOT NULL,
  `form_schema` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `events_created_by_foreign` (`created_by`),
  CONSTRAINT `events_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `events`
--

LOCK TABLES `events` WRITE;
/*!40000 ALTER TABLE `events` DISABLE KEYS */;
INSERT INTO `events` VALUES (1,'Annual Corporate Tech Summit 2026','Join industry leaders and innovators to discuss cloud technology, AI advancement, and enterprise digital strategy.','2026-08-30','2026-09-01','Grand Auditorium, HQ North Building',NULL,1,'\"[{\\\"name\\\":\\\"department\\\",\\\"label\\\":\\\"Department\\\",\\\"type\\\":\\\"select\\\",\\\"required\\\":true,\\\"options\\\":[\\\"Engineering\\\",\\\"HR\\\",\\\"Marketing\\\",\\\"Sales\\\",\\\"Finance\\\",\\\"Design\\\"]},{\\\"name\\\":\\\"dietary\\\",\\\"label\\\":\\\"Dietary Requirements\\\",\\\"type\\\":\\\"text\\\",\\\"required\\\":false}]\"','2026-08-25 12:37:46','2026-08-25 12:37:46'),(2,'Leadership & Executive Growth Retreat','An exclusive 3-day workshop focused on high-impact executive communication, strategic decision making, and team mentorship.','2026-09-06','2026-09-09','Pacific Bay Resort & Conference Center',NULL,1,'\"[{\\\"name\\\":\\\"department\\\",\\\"label\\\":\\\"Department\\\",\\\"type\\\":\\\"select\\\",\\\"required\\\":true,\\\"options\\\":[\\\"Engineering\\\",\\\"HR\\\",\\\"Marketing\\\",\\\"Sales\\\",\\\"Finance\\\",\\\"Design\\\"]},{\\\"name\\\":\\\"dietary\\\",\\\"label\\\":\\\"Dietary Requirements\\\",\\\"type\\\":\\\"text\\\",\\\"required\\\":false}]\"','2026-08-25 12:37:46','2026-08-25 12:37:46'),(3,'Global Cybersecurity Hackathon','Test your defensive skills and solve real-world vulnerability scenarios with developers from around the world.','2026-09-14','2026-09-15','Innovation Lab & Virtual Streams',NULL,1,'\"[{\\\"name\\\":\\\"department\\\",\\\"label\\\":\\\"Department\\\",\\\"type\\\":\\\"select\\\",\\\"required\\\":true,\\\"options\\\":[\\\"Engineering\\\",\\\"HR\\\",\\\"Marketing\\\",\\\"Sales\\\",\\\"Finance\\\",\\\"Design\\\"]},{\\\"name\\\":\\\"dietary\\\",\\\"label\\\":\\\"Dietary Requirements\\\",\\\"type\\\":\\\"text\\\",\\\"required\\\":false}]\"','2026-08-25 12:37:46','2026-08-25 12:37:46'),(4,'Product Strategy & UX Design Expo','Discover cutting-edge UI/UX trends, modern design systems, and rapid prototyping workflows for enterprise software.','2026-09-19','2026-09-20','Design Studio Hall B',NULL,1,'\"[{\\\"name\\\":\\\"department\\\",\\\"label\\\":\\\"Department\\\",\\\"type\\\":\\\"select\\\",\\\"required\\\":true,\\\"options\\\":[\\\"Engineering\\\",\\\"HR\\\",\\\"Marketing\\\",\\\"Sales\\\",\\\"Finance\\\",\\\"Design\\\"]},{\\\"name\\\":\\\"dietary\\\",\\\"label\\\":\\\"Dietary Requirements\\\",\\\"type\\\":\\\"text\\\",\\\"required\\\":false}]\"','2026-08-25 12:37:46','2026-08-25 12:37:46'),(5,'Data Science & Machine Learning Bootcamp','Hands-on training session covering python models, neural networks, and scalable data pipeline management.','2026-09-24','2026-09-26','Virtual Live Classrooms',NULL,1,'\"[{\\\"name\\\":\\\"department\\\",\\\"label\\\":\\\"Department\\\",\\\"type\\\":\\\"select\\\",\\\"required\\\":true,\\\"options\\\":[\\\"Engineering\\\",\\\"HR\\\",\\\"Marketing\\\",\\\"Sales\\\",\\\"Finance\\\",\\\"Design\\\"]},{\\\"name\\\":\\\"dietary\\\",\\\"label\\\":\\\"Dietary Requirements\\\",\\\"type\\\":\\\"text\\\",\\\"required\\\":false}]\"','2026-08-25 12:37:46','2026-08-25 12:37:46'),(6,'Enterprise Architecture & Cloud Optimization','Learn strategies for multi-cloud deployment, cost management, and microservice resilience at enterprise scale.','2026-09-29','2026-09-30','Tech Hub Conference Room 3',NULL,1,'\"[{\\\"name\\\":\\\"department\\\",\\\"label\\\":\\\"Department\\\",\\\"type\\\":\\\"select\\\",\\\"required\\\":true,\\\"options\\\":[\\\"Engineering\\\",\\\"HR\\\",\\\"Marketing\\\",\\\"Sales\\\",\\\"Finance\\\",\\\"Design\\\"]},{\\\"name\\\":\\\"dietary\\\",\\\"label\\\":\\\"Dietary Requirements\\\",\\\"type\\\":\\\"text\\\",\\\"required\\\":false}]\"','2026-08-25 12:37:46','2026-08-25 12:37:46'),(7,'Q3 Global Town Hall & Strategy Review','Company-wide updates from executive leadership, team recognition, and Q3 corporate roadmap alignment.','2026-10-04','2026-10-04','Main Amphitheater & Global Stream',NULL,1,'\"[{\\\"name\\\":\\\"department\\\",\\\"label\\\":\\\"Department\\\",\\\"type\\\":\\\"select\\\",\\\"required\\\":true,\\\"options\\\":[\\\"Engineering\\\",\\\"HR\\\",\\\"Marketing\\\",\\\"Sales\\\",\\\"Finance\\\",\\\"Design\\\"]},{\\\"name\\\":\\\"dietary\\\",\\\"label\\\":\\\"Dietary Requirements\\\",\\\"type\\\":\\\"text\\\",\\\"required\\\":false}]\"','2026-08-25 12:37:46','2026-08-25 12:37:46'),(8,'Agile Transformation & Scrum Mastery Workshop','Master sprint planning, velocity tracking, and cross-functional team collaboration for agile practitioners.','2026-10-09','2026-10-10','Agile Center of Excellence',NULL,1,'\"[{\\\"name\\\":\\\"department\\\",\\\"label\\\":\\\"Department\\\",\\\"type\\\":\\\"select\\\",\\\"required\\\":true,\\\"options\\\":[\\\"Engineering\\\",\\\"HR\\\",\\\"Marketing\\\",\\\"Sales\\\",\\\"Finance\\\",\\\"Design\\\"]},{\\\"name\\\":\\\"dietary\\\",\\\"label\\\":\\\"Dietary Requirements\\\",\\\"type\\\":\\\"text\\\",\\\"required\\\":false}]\"','2026-08-25 12:37:46','2026-08-25 12:37:46'),(9,'Sustainability & Green Tech Forum','Exploring carbon footprint reduction in data centers, eco-friendly logistics, and sustainable corporate governance.','2026-10-14','2026-10-15','Eco-Pavilion Hall 1',NULL,1,'\"[{\\\"name\\\":\\\"department\\\",\\\"label\\\":\\\"Department\\\",\\\"type\\\":\\\"select\\\",\\\"required\\\":true,\\\"options\\\":[\\\"Engineering\\\",\\\"HR\\\",\\\"Marketing\\\",\\\"Sales\\\",\\\"Finance\\\",\\\"Design\\\"]},{\\\"name\\\":\\\"dietary\\\",\\\"label\\\":\\\"Dietary Requirements\\\",\\\"type\\\":\\\"text\\\",\\\"required\\\":false}]\"','2026-08-25 12:37:46','2026-08-25 12:37:46'),(10,'Customer Success & Support Excellence Summit','Best practices for customer retention, automated support workflows, and building customer-centric organizations.','2026-10-19','2026-10-20','Customer Experience Center',NULL,1,'\"[{\\\"name\\\":\\\"department\\\",\\\"label\\\":\\\"Department\\\",\\\"type\\\":\\\"select\\\",\\\"required\\\":true,\\\"options\\\":[\\\"Engineering\\\",\\\"HR\\\",\\\"Marketing\\\",\\\"Sales\\\",\\\"Finance\\\",\\\"Design\\\"]},{\\\"name\\\":\\\"dietary\\\",\\\"label\\\":\\\"Dietary Requirements\\\",\\\"type\\\":\\\"text\\\",\\\"required\\\":false}]\"','2026-08-25 12:37:46','2026-08-25 12:37:46'),(11,'Financial Planning & Risk Management Seminar','Corporate finance overview covering compliance regulations, treasury management, and risk mitigation models.','2026-10-24','2026-10-25','Finance Executive Suite',NULL,1,'\"[{\\\"name\\\":\\\"department\\\",\\\"label\\\":\\\"Department\\\",\\\"type\\\":\\\"select\\\",\\\"required\\\":true,\\\"options\\\":[\\\"Engineering\\\",\\\"HR\\\",\\\"Marketing\\\",\\\"Sales\\\",\\\"Finance\\\",\\\"Design\\\"]},{\\\"name\\\":\\\"dietary\\\",\\\"label\\\":\\\"Dietary Requirements\\\",\\\"type\\\":\\\"text\\\",\\\"required\\\":false}]\"','2026-08-25 12:37:46','2026-08-25 12:37:46'),(12,'DevOps Automation & CI/CD Pipeline Summit','Automating infrastructure deployment with Kubernetes, Terraform, and GitHub Actions pipelines.','2026-10-29','2026-10-30','DevOps Training Hub',NULL,1,'\"[{\\\"name\\\":\\\"department\\\",\\\"label\\\":\\\"Department\\\",\\\"type\\\":\\\"select\\\",\\\"required\\\":true,\\\"options\\\":[\\\"Engineering\\\",\\\"HR\\\",\\\"Marketing\\\",\\\"Sales\\\",\\\"Finance\\\",\\\"Design\\\"]},{\\\"name\\\":\\\"dietary\\\",\\\"label\\\":\\\"Dietary Requirements\\\",\\\"type\\\":\\\"text\\\",\\\"required\\\":false}]\"','2026-08-25 12:37:46','2026-08-25 12:37:46');
/*!40000 ALTER TABLE `events` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
  KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`)
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
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` smallint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2026_08_25_155827_create_permission_tables',1),(5,'2026_08_25_155841_create_events_table',1),(6,'2026_08_25_155842_create_event_quotas_table',1),(7,'2026_08_25_155843_create_approval_bands_table',1),(8,'2026_08_25_155844_create_registrations_table',1),(9,'2026_08_25_155845_create_registration_approvals_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `model_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_permissions`
--

LOCK TABLES `model_has_permissions` WRITE;
/*!40000 ALTER TABLE `model_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `model_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_roles`
--

DROP TABLE IF EXISTS `model_has_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `model_has_roles` (
  `role_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_roles`
--

LOCK TABLES `model_has_roles` WRITE;
/*!40000 ALTER TABLE `model_has_roles` DISABLE KEYS */;
INSERT INTO `model_has_roles` VALUES (1,'App\\Models\\User',1),(2,'App\\Models\\User',2),(3,'App\\Models\\User',3);
/*!40000 ALTER TABLE `model_has_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `registration_approvals`
--

DROP TABLE IF EXISTS `registration_approvals`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `registration_approvals` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `registration_id` bigint unsigned NOT NULL,
  `approver_id` bigint unsigned NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comments` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `registration_approvals_registration_id_foreign` (`registration_id`),
  KEY `registration_approvals_approver_id_foreign` (`approver_id`),
  CONSTRAINT `registration_approvals_approver_id_foreign` FOREIGN KEY (`approver_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `registration_approvals_registration_id_foreign` FOREIGN KEY (`registration_id`) REFERENCES `registrations` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `registration_approvals`
--

LOCK TABLES `registration_approvals` WRITE;
/*!40000 ALTER TABLE `registration_approvals` DISABLE KEYS */;
INSERT INTO `registration_approvals` VALUES (1,3,1,'approved','Approved - Quota verified.','2026-08-25 12:37:46','2026-08-25 12:37:46'),(2,4,2,'rejected','Department allocation limit reached for this session.','2026-08-25 12:37:46','2026-08-25 12:37:46');
/*!40000 ALTER TABLE `registration_approvals` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `registrations`
--

DROP TABLE IF EXISTS `registrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `registrations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `event_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `form_data` json DEFAULT NULL,
  `current_approval_level` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `registrations_event_id_foreign` (`event_id`),
  KEY `registrations_user_id_foreign` (`user_id`),
  CONSTRAINT `registrations_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE,
  CONSTRAINT `registrations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `registrations`
--

LOCK TABLES `registrations` WRITE;
/*!40000 ALTER TABLE `registrations` DISABLE KEYS */;
INSERT INTO `registrations` VALUES (1,1,3,'pending','\"{\\\"department\\\":\\\"Engineering\\\",\\\"dietary\\\":\\\"Vegetarian\\\"}\"',1,'2026-08-25 12:37:46','2026-08-25 12:37:46'),(2,2,3,'pending','\"{\\\"department\\\":\\\"Marketing\\\",\\\"dietary\\\":\\\"None\\\"}\"',1,'2026-08-25 12:37:46','2026-08-25 12:37:46'),(3,3,3,'approved','\"{\\\"department\\\":\\\"Sales\\\",\\\"dietary\\\":\\\"Gluten Free\\\"}\"',1,'2026-08-25 12:37:46','2026-08-25 12:37:46'),(4,4,3,'rejected','\"{\\\"department\\\":\\\"Design\\\",\\\"dietary\\\":\\\"None\\\"}\"',1,'2026-08-25 12:37:46','2026-08-25 12:37:46'),(5,5,3,'waitlisted','\"{\\\"department\\\":\\\"HR\\\",\\\"dietary\\\":\\\"Vegan\\\"}\"',1,'2026-08-25 12:37:46','2026-08-25 12:37:46');
/*!40000 ALTER TABLE `registrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `role_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_has_permissions`
--

LOCK TABLES `role_has_permissions` WRITE;
/*!40000 ALTER TABLE `role_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `role_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Admin','web','2026-08-25 12:37:43','2026-08-25 12:37:43'),(2,'Manager','web','2026-08-25 12:37:43','2026-08-25 12:37:43'),(3,'Employee','web','2026-08-25 12:37:43','2026-08-25 12:37:43');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('xGvAZgApGMGdo0p7gYsBTcRazpBQcvNkb6ik3uaq',1,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36','eyJfdG9rZW4iOiJyandHMUhRaVVPSjAySG43ek40dExmb2o1YzkxUWZFS2YwVHk3MnVvIiwidXJsIjpbXSwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2xvY2FsaG9zdDo4MDgwXC9hcHByb3ZhbHM/c3RhdHVzPWFsbCIsInJvdXRlIjoiYXBwcm92YWxzLmluZGV4In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfSwibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiOjF9',1787681414);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Admin User','admin@reliant.com',NULL,'$2y$12$txwkr8DbaiPMC9RgAVJgZuTEpitdf41dv6eqWxlYax2K5VK3p8lIa',NULL,'2026-08-25 12:37:44','2026-08-25 12:37:44'),(2,'Manager (Approver)','manager@reliant.com',NULL,'$2y$12$rLUl6KvsFhsBk67ZPB3vdOPpEgPNOHDuTjiriAcXOp0fYDEBQ3.2i',NULL,'2026-08-25 12:37:45','2026-08-25 12:37:45'),(3,'Regular Employee','employee@reliant.com',NULL,'$2y$12$MyZne3zAEVkxWH3fBQY1NeLmGpy7TSeER6s9s43PrQdKnsqCYqWDa',NULL,'2026-08-25 12:37:46','2026-08-25 12:37:46');
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

-- Dump completed on 2026-08-25 23:42:23
