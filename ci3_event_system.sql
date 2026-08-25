-- CodeIgniter 3 Dynamic Event Registration & Approval System with Quotas
-- Database Dump

CREATE DATABASE IF NOT EXISTS `ci3_event_system` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `ci3_event_system`;

-- --------------------------------------------------------

-- Table structure for `users`
DROP TABLE IF EXISTS `registration_approvals`;
DROP TABLE IF EXISTS `registrations`;
DROP TABLE IF EXISTS `approval_bands`;
DROP TABLE IF EXISTS `event_quotas`;
DROP TABLE IF EXISTS `events`;
DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) UNIQUE NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `role` VARCHAR(50) NOT NULL DEFAULT 'User', -- 'Admin', 'Sub-Admin', 'Employee', 'Manager', 'External', 'User'
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Seed default accounts (Password for all is 'password' hashed with password_hash)
-- Password hash for 'password': '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'
INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`) VALUES
(1, 'System Admin', 'admin@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Admin'),
(2, 'Department Manager (Approver Level 1)', 'approver1@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Sub-Admin'),
(3, 'HR Director (Approver Level 2)', 'approver2@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Sub-Admin'),
(4, 'John Employee', 'employee@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Employee'),
(5, 'Jane Manager', 'manager@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Manager'),
(6, 'Alex External', 'external@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'External');

-- --------------------------------------------------------

-- Table structure for `events`
CREATE TABLE `events` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(255) NOT NULL,
  `description` TEXT,
  `start_date` DATE NOT NULL,
  `end_date` DATE NOT NULL,
  `form_schema` TEXT, -- Stores JSON representation of dynamic fields
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `events` (`id`, `name`, `description`, `start_date`, `end_date`, `form_schema`) VALUES
(1, 'Enterprise Leadership Summit 2026', 'A high-impact seminar on modern organizational leadership and technology strategy.', '2026-09-01', '2026-09-03', '[{"name":"tshirt_size","label":"T-Shirt Size","type":"select","required":true,"options":["S","M","L","XL"]},{"name":"dietary_preference","label":"Dietary Preference","type":"text","required":false,"options":[]},{"name":"emergency_contact","label":"Emergency Phone","type":"text","required":true,"options":[]}]'),
(2, 'Full-Stack Web Architecture Workshop', 'Hands-on training session covering high-throughput microservices and scalable web architecture.', '2026-09-10', '2026-09-12', '[{"name":"experience_level","label":"Experience Level","type":"select","required":true,"options":["Beginner","Intermediate","Advanced"]},{"name":"github_profile","label":"GitHub Profile URL","type":"text","required":true,"options":[]}]');

-- --------------------------------------------------------

-- Table structure for `event_quotas`
CREATE TABLE `event_quotas` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `event_id` INT NOT NULL,
  `role_name` VARCHAR(50) NOT NULL,
  `quota_limit` INT NOT NULL DEFAULT 0,
  FOREIGN KEY (`event_id`) REFERENCES `events`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `event_quotas` (`id`, `event_id`, `role_name`, `quota_limit`) VALUES
(1, 1, 'Employee', 2),
(2, 1, 'Manager', 5),
(3, 1, 'External', 10),
(4, 2, 'Employee', 1),
(5, 2, 'Manager', 2);

-- --------------------------------------------------------

-- Table structure for `approval_bands`
CREATE TABLE `approval_bands` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `event_id` INT NOT NULL,
  `role_name` VARCHAR(50) NOT NULL, -- The approver role required for this step (e.g., 'Sub-Admin')
  `level_sequence` INT NOT NULL DEFAULT 1,
  FOREIGN KEY (`event_id`) REFERENCES `events`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `approval_bands` (`id`, `event_id`, `role_name`, `level_sequence`) VALUES
(1, 1, 'Sub-Admin', 1),
(2, 1, 'Sub-Admin', 2),
(3, 2, 'Sub-Admin', 1);

-- --------------------------------------------------------

-- Table structure for `registrations`
CREATE TABLE `registrations` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `event_id` INT NOT NULL,
  `user_id` INT NOT NULL,
  `status` ENUM('pending', 'approved', 'rejected', 'waitlisted') NOT NULL DEFAULT 'pending',
  `form_data` TEXT, -- Submitted JSON responses
  `current_approval_level` INT NOT NULL DEFAULT 1,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`event_id`) REFERENCES `events`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

-- Table structure for `registration_approvals`
CREATE TABLE `registration_approvals` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `registration_id` INT NOT NULL,
  `approver_id` INT NOT NULL,
  `status` ENUM('approved', 'rejected') NOT NULL,
  `comments` TEXT,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`registration_id`) REFERENCES `registrations`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`approver_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
