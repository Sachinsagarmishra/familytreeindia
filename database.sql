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
  `state` varchar(100) DEFAULT NULL,
  `source` varchar(100) DEFAULT 'contact_page',
  `ip_address` varchar(45) DEFAULT NULL,
  `status` varchar(20) DEFAULT 'new',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Razorpay donation payment records
CREATE TABLE IF NOT EXISTS `donations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `donor_name` varchar(150) NOT NULL,
  `donor_address` text NOT NULL,
  `donor_mobile` varchar(30) NOT NULL,
  `amount` decimal(12,2) NOT NULL,
  `currency` varchar(10) NOT NULL DEFAULT 'INR',
  `razorpay_mode` enum('test','live') NOT NULL DEFAULT 'test',
  `razorpay_order_id` varchar(100) DEFAULT NULL,
  `razorpay_payment_id` varchar(100) DEFAULT NULL,
  `razorpay_signature` varchar(255) DEFAULT NULL,
  `status` varchar(40) NOT NULL DEFAULT 'created',
  `payment_method` varchar(50) DEFAULT NULL,
  `payer_email` varchar(150) DEFAULT NULL,
  `payer_contact` varchar(30) DEFAULT NULL,
  `receipt` varchar(100) DEFAULT NULL,
  `source` varchar(100) DEFAULT NULL,
  `webhook_event_id` varchar(150) DEFAULT NULL,
  `raw_payload` longtext DEFAULT NULL,
  `paid_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `razorpay_order_id` (`razorpay_order_id`),
  KEY `razorpay_payment_id` (`razorpay_payment_id`),
  KEY `status` (`status`),
  KEY `razorpay_mode` (`razorpay_mode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Razorpay webhook event log for idempotent sync
CREATE TABLE IF NOT EXISTS `razorpay_webhook_events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` varchar(150) NOT NULL,
  `event_type` varchar(100) DEFAULT NULL,
  `payload` longtext DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `event_id` (`event_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT IGNORE INTO `site_settings` (`setting_key`, `setting_value`) VALUES
('razorpay_mode', 'test'),
('razorpay_currency', 'INR'),
('razorpay_test_key_id', ''),
('razorpay_test_key_secret', ''),
('razorpay_test_webhook_secret', ''),
('razorpay_live_key_id', ''),
('razorpay_live_key_secret', ''),
('razorpay_live_webhook_secret', '');
