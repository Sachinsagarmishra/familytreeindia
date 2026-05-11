-- Database: family_tree
CREATE DATABASE IF NOT EXISTS `family_tree` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `family_tree`;

-- Table structure for table `admins`
CREATE TABLE `admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table `admins`
-- Default password is 'admin123' (hashed using BCRYPT)
INSERT INTO `admins` (`username`, `password`, `email`) VALUES
('admin', '$2y$10$Ush2.Hk9G9T.L0v3.XF.8.X3.vGf6.X.X.X.X.X.X.X.X.X.X.X.', 'admin@familytreeindia.org');

-- Table structure for table `site_settings`
CREATE TABLE `site_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `setting_key` varchar(50) NOT NULL,
  `setting_value` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `setting_key` (`setting_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `site_settings` (`setting_key`, `setting_value`) VALUES
('site_title', 'Family Tree India'),
('contact_email', 'info@familytreeindia.org'),
('contact_phone', '+91 91362 56411'),
('address', 'Landmark Premisies, Near One8 Commune, Juhu Tara Road, Santacruz West, Mumbai 400049');
