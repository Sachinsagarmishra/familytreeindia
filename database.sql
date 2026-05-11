-- SQL Dump for Family Tree
-- Import this directly into your existing database

-- Table structure for table `admins`
CREATE TABLE IF NOT EXISTS `admins` (
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
INSERT IGNORE INTO `admins` (`username`, `password`, `email`) VALUES
('admin', '$2y$10$Ush2.Hk9G9T.L0v3.XF.8.X3.vGf6.X.X.X.X.X.X.X.X.X.X.X.', 'admin@familytreeindia.org');

-- Table structure for table `site_settings`
CREATE TABLE IF NOT EXISTS `site_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `setting_key` varchar(50) NOT NULL,
  `setting_value` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `setting_key` (`setting_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Default settings
INSERT IGNORE INTO `site_settings` (`setting_key`, `setting_value`) VALUES
('site_title', 'Family Tree India'),
('contact_email', 'info@familytreeindia.org'),
('contact_phone', '+91 91362 56411'),
('address', 'Landmark Premisies, Near One8 Commune, Juhu Tara Road, Santacruz West, Mumbai 400049'),
('smtp_host', 'smtp.gmail.com'),
('smtp_port', '587'),
('smtp_user', ''),
('smtp_pass', ''),
('smtp_encryption', 'tls'),
('from_email', 'info@familytreeindia.org');

-- Table structure for table `leads`
CREATE TABLE IF NOT EXISTS `leads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `company` varchar(100) DEFAULT NULL,
  `interest` varchar(100) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `status` varchar(20) DEFAULT 'new',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
