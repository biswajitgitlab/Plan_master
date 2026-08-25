-- MySQL dump 10.13  Distrib 8.0.46, for Linux (x86_64)
--
-- Host: 127.0.0.1    Database: ci3_event_system
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
  `id` int NOT NULL AUTO_INCREMENT,
  `event_id` int NOT NULL,
  `role_name` varchar(50) NOT NULL,
  `level_sequence` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `event_id` (`event_id`),
  CONSTRAINT `approval_bands_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `approval_bands`
--

LOCK TABLES `approval_bands` WRITE;
/*!40000 ALTER TABLE `approval_bands` DISABLE KEYS */;
INSERT INTO `approval_bands` VALUES (1,1,'Manager',1),(2,1,'Sub-Admin',2),(3,2,'Manager',1),(4,2,'Admin',2),(5,3,'Sub-Admin',1),(6,4,'Manager',1),(7,5,'Sub-Admin',1),(8,6,'Manager',1),(9,7,'Sub-Admin',1),(10,8,'Manager',1),(11,9,'Sub-Admin',1),(12,10,'Manager',1),(13,11,'Sub-Admin',1),(14,12,'Manager',1);
/*!40000 ALTER TABLE `approval_bands` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `event_quotas`
--

DROP TABLE IF EXISTS `event_quotas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `event_quotas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `event_id` int NOT NULL,
  `role_name` varchar(50) NOT NULL,
  `quota_limit` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `event_id` (`event_id`),
  CONSTRAINT `event_quotas_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `event_quotas`
--

LOCK TABLES `event_quotas` WRITE;
/*!40000 ALTER TABLE `event_quotas` DISABLE KEYS */;
INSERT INTO `event_quotas` VALUES (1,1,'Employee',50),(2,1,'Manager',20),(3,1,'External',10),(4,2,'Employee',10),(5,2,'Manager',25),(6,2,'External',5),(7,3,'Employee',30),(8,3,'External',20),(9,4,'Employee',40),(10,4,'Manager',15),(11,5,'Employee',60),(12,5,'External',40),(13,6,'Employee',100),(14,6,'Manager',50),(15,7,'Employee',45),(16,7,'Manager',15),(17,8,'Employee',80),(18,8,'External',30),(19,9,'Employee',25),(20,10,'Employee',50),(21,11,'Employee',35),(22,12,'Employee',40);
/*!40000 ALTER TABLE `event_quotas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `events` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `location` varchar(255) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `form_schema` text,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `events`
--

LOCK TABLES `events` WRITE;
/*!40000 ALTER TABLE `events` DISABLE KEYS */;
INSERT INTO `events` VALUES (1,'Annual Corporate Tech Summit 2026','A high-impact enterprise conference focusing on cloud modernization, AI automation, and security posture across organizational workflows.','2026-09-15 09:00:00','2026-09-17 17:00:00','Grand Auditorium, HQ North Building','events/413be7578149d8b520ed8e490c5ca194.png',1,'[{\"name\":\"department\",\"label\":\"Department\",\"type\":\"select\",\"required\":true,\"options\":[\"Engineering\",\"HR\",\"Marketing\",\"Sales\",\"Design\"]},{\"name\":\"dietary_requirements\",\"label\":\"Dietary Requirements\",\"type\":\"text\",\"required\":false},{\"name\":\"t_shirt_size\",\"label\":\"T-Shirt Size\",\"type\":\"select\",\"required\":true,\"options\":[\"S\",\"M\",\"L\",\"XL\",\"XXL\"]}]','2026-08-26 00:02:04'),(2,'Leadership & Executive Growth Retreat','An exclusive strategic alignment retreat designed for division leaders, senior managers, and directors.','2026-10-05 08:30:00','2026-10-07 18:00:00','Pacific Bay Resort & Conference Center',NULL,1,'[{\"name\":\"management_level\",\"label\":\"Management Level\",\"type\":\"select\",\"required\":true,\"options\":[\"Team Lead\",\"Manager\",\"Director\",\"VP\",\"C-Suite\"]},{\"name\":\"accommodation\",\"label\":\"Room Preference\",\"type\":\"select\",\"required\":true,\"options\":[\"Single King\",\"Double Suite\",\"No Accommodation Needed\"]}]','2026-08-26 00:02:04'),(3,'Global Cybersecurity Hackathon','A 48-hour competitive hacking event testing incident response, zero-trust architecture, and secure coding practices.','2026-10-20 10:00:00','2026-10-22 16:00:00','Innovation Lab & Virtual Streams',NULL,1,'[{\"name\":\"track\",\"label\":\"Hackathon Track\",\"type\":\"select\",\"required\":true,\"options\":[\"Offensive Security\",\"Defensive Architecture\",\"AI Threat Intelligence\"]},{\"name\":\"team_name\",\"label\":\"Team Name (if applicable)\",\"type\":\"text\",\"required\":false,\"options\":[]}]','2026-08-26 00:02:04'),(4,'Product Strategy & UX Design Expo','Exploring user-centered design systems, product analytics, and customer onboarding experiences.','2026-11-02 09:00:00','2026-11-03 17:00:00','Design Studio Hall B',NULL,1,'[{\"name\":\"portfolio_url\",\"label\":\"Portfolio / Dribbble Link\",\"type\":\"text\",\"required\":false,\"options\":[]},{\"name\":\"workshop_choice\",\"label\":\"Preferred Afternoon Workshop\",\"type\":\"select\",\"required\":true,\"options\":[\"Design Tokens in Figma\",\"Usability Testing\",\"Framer Motion Animation\"]}]','2026-08-26 00:02:04'),(5,'Data Science & Machine Learning Bootcamp','Intensive hands-on workshop covering LLM fine-tuning, retrieval-augmented generation (RAG), and data engineering pipelines.','2026-11-12 09:30:00','2026-11-14 16:30:00','Virtual Live Classrooms',NULL,1,'[{\"name\":\"python_experience\",\"label\":\"Python Proficiency Level\",\"type\":\"select\",\"required\":true,\"options\":[\"Basic\",\"Intermediate\",\"Advanced\",\"Expert\"]},{\"name\":\"gpu_access\",\"label\":\"Require Cloud GPU Instance?\",\"type\":\"select\",\"required\":true,\"options\":[\"Yes - PyTorch CUDA\",\"No - Local Environment\"]}]','2026-08-26 00:02:04'),(6,'Annual Diversity & Inclusion Gala','Celebrating organizational milestones, inclusion initiatives, and employee resource group achievements.','2026-12-05 18:00:00','2026-12-05 22:30:00','Grand Ballroom, City Hotel',NULL,1,'[{\"name\":\"guest_name\",\"label\":\"Plus-One Full Name (Optional)\",\"type\":\"text\",\"required\":false,\"options\":[]},{\"name\":\"meal_preference\",\"label\":\"Dinner Entree Choice\",\"type\":\"select\",\"required\":true,\"options\":[\"Grilled Salmon\",\"Pan-Seared Filet Mignon\",\"Vegan Truffle Risotto\"]}]','2026-08-26 00:02:04'),(7,'DevOps & Cloud Native Infrastructure Summit','Best practices for Kubernetes deployment, GitOps pipelines, infrastructure as code, and observability.','2026-12-15 09:00:00','2026-12-16 17:00:00','Tech Hub Conference Center',NULL,1,'[{\"name\":\"cloud_provider\",\"label\":\"Primary Cloud Provider\",\"type\":\"select\",\"required\":true,\"options\":[\"AWS\",\"GCP\",\"Azure\",\"On-Premises Hybrid\"]}]','2026-08-26 00:02:04'),(8,'Enterprise AI & Automation Conference','Showcasing real-world enterprise AI applications, automated workflows, and governance frameworks.','2027-01-10 09:00:00','2027-01-11 17:00:00','Convention Center, Main Hall',NULL,1,'[{\"name\":\"use_case\",\"label\":\"Target Automation Use Case\",\"type\":\"text\",\"required\":true,\"options\":[]}]','2026-08-26 00:02:04'),(9,'Agile Product Delivery Workshop','Refining team velocity, sprint planning, OKR alignment, and Kanban flow methodologies.','2027-01-22 09:00:00','2027-01-22 16:00:00','Training Room 3A, West Wing',NULL,1,'[{\"name\":\"jira_role\",\"label\":\"Role in Jira/Linear\",\"type\":\"select\",\"required\":true,\"options\":[\"Scrum Master\",\"Product Owner\",\"Developer\",\"QA Lead\"]}]','2026-08-26 00:02:04'),(10,'Corporate Sustainability & ESG Forum','Keynote addresses on green computing, carbon footprint reduction, and sustainable supply chain logistics.','2027-02-08 09:00:00','2027-02-09 16:00:00','Green Tech Center Auditorium',NULL,1,'[{\"name\":\"department\",\"label\":\"Department\",\"type\":\"text\",\"required\":true,\"options\":[]}]','2026-08-26 00:02:04'),(11,'Financial Tech & Open Banking Summit','Deep dives into payment gateways, compliance, API banking, and fraud prevention algorithms.','2027-02-20 09:00:00','2027-02-21 17:00:00','Financial District Plaza',NULL,1,'[{\"name\":\"financial_role\",\"label\":\"Domain Focus\",\"type\":\"select\",\"required\":true,\"options\":[\"Payments\",\"Risk & Compliance\",\"Core Banking APIs\",\"Security\"]}]','2026-08-26 00:02:04'),(12,'Global Marketing & Brand Strategy Expo','Exploring omnichannel campaigns, content personalization, AI copy generation, and brand positioning.','2027-03-05 09:00:00','2027-03-06 17:00:00','Creative Studios Center',NULL,1,'[{\"name\":\"channel\",\"label\":\"Primary Marketing Channel\",\"type\":\"select\",\"required\":true,\"options\":[\"Digital / Performance\",\"Brand & PR\",\"Growth & Lifecycle\",\"Event Marketing\"]}]','2026-08-26 00:02:04');
/*!40000 ALTER TABLE `events` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `registration_approvals`
--

DROP TABLE IF EXISTS `registration_approvals`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `registration_approvals` (
  `id` int NOT NULL AUTO_INCREMENT,
  `registration_id` int NOT NULL,
  `approver_id` int NOT NULL,
  `status` enum('approved','rejected') NOT NULL,
  `comments` text,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `registration_id` (`registration_id`),
  KEY `approver_id` (`approver_id`),
  CONSTRAINT `registration_approvals_ibfk_1` FOREIGN KEY (`registration_id`) REFERENCES `registrations` (`id`) ON DELETE CASCADE,
  CONSTRAINT `registration_approvals_ibfk_2` FOREIGN KEY (`approver_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `registration_approvals`
--

LOCK TABLES `registration_approvals` WRITE;
/*!40000 ALTER TABLE `registration_approvals` DISABLE KEYS */;
INSERT INTO `registration_approvals` VALUES (1,2,2,'approved','Approved by Level 1 Manager','2026-08-25 11:35:00'),(2,2,1,'approved','Approved by System Admin (Level 2)','2026-08-25 11:40:00'),(3,5,2,'approved','Approved hackathon registration for Alex External','2026-08-25 15:25:00'),(4,6,2,'approved','Approved by reviewer','2026-08-26 00:11:08');
/*!40000 ALTER TABLE `registration_approvals` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `registrations`
--

DROP TABLE IF EXISTS `registrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `registrations` (
  `id` int NOT NULL AUTO_INCREMENT,
  `event_id` int NOT NULL,
  `user_id` int NOT NULL,
  `status` enum('pending','approved','rejected','waitlisted') NOT NULL DEFAULT 'pending',
  `form_data` text,
  `current_approval_level` int NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `event_id` (`event_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `registrations_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE,
  CONSTRAINT `registrations_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `registrations`
--

LOCK TABLES `registrations` WRITE;
/*!40000 ALTER TABLE `registrations` DISABLE KEYS */;
INSERT INTO `registrations` VALUES (1,1,4,'pending','{\"department\":\"Engineering\",\"dietary\":\"Vegetarian\",\"tshirt\":\"L\"}',1,'2026-08-25 10:15:00'),(2,1,5,'approved','{\"department\":\"Marketing\",\"dietary\":\"None\",\"tshirt\":\"M\"}',2,'2026-08-25 11:30:00'),(3,1,6,'waitlisted','{\"department\":\"Sales\",\"dietary\":\"Gluten-Free\",\"tshirt\":\"XL\"}',1,'2026-08-25 12:45:00'),(4,2,4,'pending','{\"management_level\":\"Team Lead\",\"accommodation\":\"Single King\"}',1,'2026-08-25 14:00:00'),(5,3,6,'approved','{\"track\":\"Offensive Security\",\"team_name\":\"ZeroDay Cyber\"}',1,'2026-08-25 15:20:00'),(6,3,4,'approved','{\"track\":\"Offensive Security\",\"team_name\":\"CyberKnights\"}',1,'2026-08-26 00:10:08'),(7,1,1,'pending','{\"department\":\"Engineering\",\"dietary\":\"\",\"tshirt\":\"XXL\"}',1,'2026-08-26 00:36:45');
/*!40000 ALTER TABLE `registrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL DEFAULT 'User',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'System Admin','admin@example.com','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','Admin','2026-08-26 00:02:04'),(2,'Department Manager','approver1@example.com','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','Sub-Admin','2026-08-26 00:02:04'),(3,'HR Director','approver2@example.com','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','Sub-Admin','2026-08-26 00:02:04'),(4,'John Employee','employee@example.com','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','Employee','2026-08-26 00:02:04'),(5,'Jane Manager','manager@example.com','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','Manager','2026-08-26 00:02:04'),(6,'Alex External','external@example.com','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','External','2026-08-26 00:02:04'),(7,'Reliant Admin','admin@reliant.com','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','Admin','2026-08-26 00:02:04'),(8,'Reliant Manager','manager@reliant.com','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','Sub-Admin','2026-08-26 00:02:04'),(9,'Reliant Employee','employee@reliant.com','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','Employee','2026-08-26 00:02:04');
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

-- Dump completed on 2026-08-26  0:40:20
