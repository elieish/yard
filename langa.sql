-- --------------------------------------------------------
-- Host:                         sql13.jnb1.host-h.net
-- Server version:               5.5.38-0+wheezy1 - (Debian)
-- Server OS:                    debian-linux-gnu
-- HeidiSQL Version:             8.3.0.4694
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping database structure for yardwgzemg_db1
CREATE DATABASE IF NOT EXISTS `yardwgzemg_db1` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `yardwgzemg_db1`;


-- Dumping structure for table yardwgzemg_db1.comments
DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `item` varchar(255) NOT NULL DEFAULT '',
  `user` varchar(11) NOT NULL DEFAULT '0',
  `comment` blob,
  `company` int(11) NOT NULL,
  `active` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table yardwgzemg_db1.comments: ~0 rows (approximately)
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;


-- Dumping structure for table yardwgzemg_db1.districts
DROP TABLE IF EXISTS `districts`;
CREATE TABLE IF NOT EXISTS `districts` (
  `uid` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `code` varchar(50) NOT NULL,
  `province_id` int(11) NOT NULL DEFAULT '0',
  `active` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=latin1;

-- Dumping data for table yardwgzemg_db1.districts: ~53 rows (approximately)
/*!40000 ALTER TABLE `districts` DISABLE KEYS */;
INSERT INTO `districts` (`uid`, `name`, `code`, `province_id`, `active`) VALUES
	(1, 'Amajuba District Municipality', 'DC25', 7, 1),
	(2, 'eThekwini Metropolitan Municipality', 'ETH', 7, 1),
	(3, 'iLembe District Municipality', 'DC29', 7, 1),
	(4, 'Sisonke District Municipality', 'DC43', 7, 1),
	(5, 'Ugu District Municipality', 'DC21', 7, 1),
	(6, 'uMgungundlovu District Municipality', 'DC22', 7, 1),
	(7, 'uMgungundlovu District Municipality', 'DC22', 7, 1),
	(8, 'uMkhanyakude District Municipality', 'DC27', 7, 1),
	(9, 'uMzinyathi District Municipality', 'DC24', 7, 1),
	(10, 'uThukela District Municipality', 'DC23', 7, 1),
	(11, 'uThukela District Municipality', 'DC28', 7, 1),
	(12, 'Zululand District Municipality', 'DC26', 7, 1),
	(13, 'City of Johannesburg Metropolitan Municipality', 'JHB', 2, 1),
	(14, 'City of Tshwane Metropolitan Municipality', 'TSH', 2, 1),
	(15, 'Ekurhuleni Metropolitan Municipality', 'EKU', 2, 1),
	(16, 'Sedibeng District Municipality', 'DC42', 2, 1),
	(17, 'West Rand District Municipality', 'DC48', 2, 1),
	(18, 'Capricorn District Municipality', 'DC35', 1, 1),
	(19, 'Mopani District Municipality', 'DC33', 1, 1),
	(20, 'Sekhukhune District Municipality', 'DC47', 1, 1),
	(21, 'Vhembe District Municipality', 'DC34', 1, 1),
	(22, 'Waterberg District Municipality', 'DC36', 1, 1),
	(23, 'Bojanala Platinum District Municipality', 'DC37', 3, 1),
	(24, 'Dr Kenneth Kaunda District Municipality', 'DC40', 3, 1),
	(25, 'Dr Ruth Segomotsi Mompati District Municipality', 'DC39', 3, 1),
	(26, 'Ngaka Modiri Molema District Municipality', 'DC38', 3, 1),
	(27, 'Ehlanzeni District Municipality', 'DC32', 4, 1),
	(28, 'Gert Sibande District Municipality', 'DC30', 4, 1),
	(29, 'Nkangala District Municipality', 'DC31', 4, 1),
	(30, 'Frances Baard District Municipality', 'DC9', 5, 1),
	(31, 'John Taolo Gaetsewe District Municipality', 'DC45', 5, 1),
	(32, 'Namakwa District Municipality', 'DC6', 5, 1),
	(33, 'Pixley ka Seme District Municipality', 'DC7', 5, 1),
	(34, 'ZF Mgcawu District Municipality', 'DC8', 5, 1),
	(35, 'Fezile Dabi District Municipality', 'DC20', 6, 1),
	(36, 'Lejweleputswa District Municipality', 'DC18', 6, 1),
	(37, 'Mangaung Metropolitan Municipality', 'MAN', 6, 1),
	(38, 'Thabo Mofutsanyana District Municipality', 'DC19', 6, 1),
	(39, 'Xhariep District Municipality', 'DC16', 6, 1),
	(40, 'Cape Winelands District Municipality', 'DC2', 8, 1),
	(41, 'Central Karoo District Municipality', 'DC5', 8, 1),
	(42, 'City of Cape Town Metropolitan Municipality', 'CPT', 8, 1),
	(43, 'Eden District Municipality', 'DC4', 8, 1),
	(44, 'Overberg District Municipality', 'DC3', 8, 1),
	(45, 'West Coast District Municipality', 'DC1', 8, 1),
	(46, 'Alfred Nzo District Municipality', 'DC44', 9, 1),
	(47, 'Amathole District Municipality', 'DC12', 9, 1),
	(48, 'Buffalo City Metropolitan Municipality', 'BUF', 9, 1),
	(49, 'Cacadu District Municipality', 'DC10', 9, 1),
	(50, 'Chris Hani District Municipality', 'DC13', 9, 1),
	(51, 'Joe Gqabi District Municipality', 'DC14', 9, 1),
	(52, 'Nelson Mandela Bay Metropolitan Municipality', 'NMA', 9, 1),
	(53, 'OR Tambo District Municipality', 'DC15', 9, 1);
/*!40000 ALTER TABLE `districts` ENABLE KEYS */;


-- Dumping structure for table yardwgzemg_db1.enterprises
DROP TABLE IF EXISTS `enterprises`;
CREATE TABLE IF NOT EXISTS `enterprises` (
  `uid` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `group_id` int(11) NOT NULL DEFAULT '0',
  `active` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table yardwgzemg_db1.enterprises: ~0 rows (approximately)
/*!40000 ALTER TABLE `enterprises` DISABLE KEYS */;
/*!40000 ALTER TABLE `enterprises` ENABLE KEYS */;


-- Dumping structure for table yardwgzemg_db1.enterprise_groups
DROP TABLE IF EXISTS `enterprise_groups`;
CREATE TABLE IF NOT EXISTS `enterprise_groups` (
  `uid` int(10) NOT NULL AUTO_INCREMENT,
  `group` varchar(50) NOT NULL,
  `active` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table yardwgzemg_db1.enterprise_groups: ~3 rows (approximately)
/*!40000 ALTER TABLE `enterprise_groups` DISABLE KEYS */;
INSERT INTO `enterprise_groups` (`uid`, `group`, `active`) VALUES
	(1, 'SMME', 1),
	(2, 'Co-op', 1),
	(3, 'Individual', 1);
/*!40000 ALTER TABLE `enterprise_groups` ENABLE KEYS */;


-- Dumping structure for table yardwgzemg_db1.files
DROP TABLE IF EXISTS `files`;
CREATE TABLE IF NOT EXISTS `files` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `branch` int(11) NOT NULL DEFAULT '0',
  `file` varchar(255) NOT NULL DEFAULT '',
  `item` varchar(255) NOT NULL DEFAULT '',
  `datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user` int(11) NOT NULL DEFAULT '0',
  `revision` int(5) NOT NULL DEFAULT '0',
  `type` varchar(30) NOT NULL DEFAULT 'general',
  `folder` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL DEFAULT '',
  `active` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table yardwgzemg_db1.files: ~0 rows (approximately)
/*!40000 ALTER TABLE `files` DISABLE KEYS */;
/*!40000 ALTER TABLE `files` ENABLE KEYS */;


-- Dumping structure for table yardwgzemg_db1.functions
DROP TABLE IF EXISTS `functions`;
CREATE TABLE IF NOT EXISTS `functions` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `function` varchar(50) NOT NULL DEFAULT '',
  `name` varchar(255) NOT NULL DEFAULT '',
  `category` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table yardwgzemg_db1.functions: ~5 rows (approximately)
/*!40000 ALTER TABLE `functions` DISABLE KEYS */;
INSERT INTO `functions` (`uid`, `function`, `name`, `category`) VALUES
	(1, 'admin_users', 'User Administration', 'Admin'),
	(2, 'District', 'District Administration', 'Admin'),
	(3, 'Provincial', 'Provincial Administration', 'Admin'),
	(4, 'National', 'National Administration', 'Admin'),
	(5, 'Local', 'Local Administration', 'Admin');
/*!40000 ALTER TABLE `functions` ENABLE KEYS */;


-- Dumping structure for table yardwgzemg_db1.functions_users
DROP TABLE IF EXISTS `functions_users`;
CREATE TABLE IF NOT EXISTS `functions_users` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `function` varchar(50) NOT NULL DEFAULT '',
  `user` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Dumping data for table yardwgzemg_db1.functions_users: ~5 rows (approximately)
/*!40000 ALTER TABLE `functions_users` DISABLE KEYS */;
INSERT INTO `functions_users` (`uid`, `function`, `user`) VALUES
	(2, 'District', 1),
	(3, 'Local', 1),
	(4, 'National', 1),
	(5, 'Provincial', 1),
	(6, 'admin_users', 1);
/*!40000 ALTER TABLE `functions_users` ENABLE KEYS */;


-- Dumping structure for table yardwgzemg_db1.groups
DROP TABLE IF EXISTS `groups`;
CREATE TABLE IF NOT EXISTS `groups` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user` int(11) NOT NULL DEFAULT '0',
  `name` varchar(100) NOT NULL DEFAULT '',
  `active` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table yardwgzemg_db1.groups: ~1 rows (approximately)
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
INSERT INTO `groups` (`uid`, `datetime`, `user`, `name`, `active`) VALUES
	(1, '2014-08-16 21:27:33', 1, 'Admin', 1);
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;


-- Dumping structure for table yardwgzemg_db1.members
DROP TABLE IF EXISTS `members`;
CREATE TABLE IF NOT EXISTS `members` (
  `uid` int(10) NOT NULL AUTO_INCREMENT,
  `membership_no` varchar(50) DEFAULT NULL,
  `title_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `age` int(11) NOT NULL,
  `tel` varchar(50) NOT NULL,
  `cell` varchar(50) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `province_id` int(11) NOT NULL DEFAULT '0',
  `district` varchar(50) NOT NULL,
  `local_area` varchar(50) NOT NULL,
  `sector_id` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `active` int(1) NOT NULL DEFAULT '1',
  `paid` int(11) DEFAULT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

-- Dumping data for table yardwgzemg_db1.members: ~15 rows (approximately)
/*!40000 ALTER TABLE `members` DISABLE KEYS */;
INSERT INTO `members` (`uid`, `membership_no`, `title_id`, `name`, `surname`, `gender`, `dob`, `age`, `tel`, `cell`, `email`, `province_id`, `district`, `local_area`, `sector_id`, `created_at`, `updated_at`, `deleted_at`, `active`, `paid`) VALUES
	(1, 'EI180714FS', 10, 'Elie', 'Ishimwe', '1', '2014-08-19', 0, '031 332 6581', '08296991141', 'eliana@gmail.com', 6, '', '', 0, '2014-08-18 12:30:44', '2014-09-01 18:49:16', '0000-00-00 00:00:00', 0, 1),
	(2, '', 2, 'Mack', 'Dollvins', '2', '2014-08-28', 0, '031 555 891', '082882447', 'mackdolvins@gmail.com', 2, '', '', 0, '2014-08-18 14:18:19', '2014-08-20 19:07:18', '0000-00-00 00:00:00', 0, 1),
	(3, 'TT180714KZN', 1, 'Testing', 'Testing', '1', '2014-08-19', 0, '', '', 'elieish1@gmailcom', 7, '', '', 0, '2014-08-18 14:30:43', '2014-09-01 18:48:10', '0000-00-00 00:00:00', 0, 0),
	(4, 'MD180714KZN', 2, 'mamam', 'dodo', '2', '2014-08-30', 0, '0835897456', '0785968475', 'mackdolvins@gmail.com', 7, '', '', 0, '2014-08-18 14:31:17', '2014-08-20 19:07:20', '0000-00-00 00:00:00', 0, 0),
	(5, 'PB180714NW', 1, 'Pameka', 'buthelee', '1', '2014-08-30', 0, '0835897456', '0785968475', 'mackdolvins@gmail.com', 3, '', '', 0, '2014-08-18 15:33:47', '2014-08-20 19:07:21', '0000-00-00 00:00:00', 0, 0),
	(6, 'GR180714LP', 5, 'GuGU', 'Radebe', '2', '2014-08-30', 0, '0835897456', '0785968475', 'elie@gmail.com', 1, '', '', 0, '2014-08-18 15:38:12', '2014-08-20 19:07:22', '0000-00-00 00:00:00', 0, 0),
	(7, 'MG180714KZN', 3, 'Malusi', 'Gugu', '1', '2014-08-21', 0, '0823456876', '0318765489', 'malusimchunu@yahoo.com', 7, '', '', 0, '2014-08-18 16:52:41', '2014-08-20 19:07:32', '0000-00-00 00:00:00', 0, 0),
	(8, 'NN180714KZN', 1, 'Noah', 'Nyawo', '1', '2014-08-18', 0, '0837177321', '083717732100', 'noahnyawo@yahoo.com', 7, '', '', 0, '2014-08-18 16:54:53', '2014-08-20 19:07:26', '0000-00-00 00:00:00', 0, 1),
	(9, 'KE190714FS', 7, 'Kapanga', 'Elie', '1', '2014-08-27', 0, '08296991142', '031 332 6581', 'elieish1@gmailcom', 6, '', '', 0, '2014-08-19 15:09:33', '2014-09-01 18:48:27', '0000-00-00 00:00:00', 1, 1),
	(10, 'HI190714KZN', 4, 'Homemakers Expo', 'Ishimwe', '1', '2014-08-18', 0, '353', '031 332 6581', 'elieish@gmailcom', 7, '', '', 0, '2014-08-19 15:10:02', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0),
	(11, '', 12, 'Bonisiwe', 'Nzuza', '2', '0000-00-00', 0, '036 6318056', '0839839959', 'veklephinzuza@gmail.com', 7, '', '', 0, '2014-08-19 21:37:09', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0),
	(12, 'EI230714FS', 1, 'Eliana', 'Ishimwe', '1', '2014-08-26', 0, '031 332 6581', '08296991141', 'elieish1@gmail.com', 6, '', '', 0, '2014-08-23 13:13:09', '2014-09-01 18:49:19', '0000-00-00 00:00:00', 1, 0),
	(13, '270714EC', 0, '', '', '0', '0000-00-00', 0, '', '', 'csdcsd', 9, '', '', 0, '2014-08-27 18:45:41', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0),
	(14, 'EI010914GPJHB', 10, 'Elie', 'Ishimwe', '1', '2014-09-08', 0, '031 332 6581', '0829699114', 'elieish@gmail.com', 2, '13', '', 0, '2014-09-01 18:49:26', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0),
	(15, 'MD020914KZNETH', 10, 'Mack', 'Dolvins', '1', '2014-09-02', 0, '0820666866', '0786060256', 'mackdolvins@gmail.co', 7, '2', '', 0, '2014-09-02 09:42:43', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0);
/*!40000 ALTER TABLE `members` ENABLE KEYS */;


-- Dumping structure for table yardwgzemg_db1.provinces
DROP TABLE IF EXISTS `provinces`;
CREATE TABLE IF NOT EXISTS `provinces` (
  `uid` int(10) NOT NULL AUTO_INCREMENT,
  `province` varchar(50) NOT NULL,
  `abreviation` varchar(3) DEFAULT NULL,
  `active` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- Dumping data for table yardwgzemg_db1.provinces: ~9 rows (approximately)
/*!40000 ALTER TABLE `provinces` DISABLE KEYS */;
INSERT INTO `provinces` (`uid`, `province`, `abreviation`, `active`) VALUES
	(1, 'Limpopo', 'LP', 1),
	(2, 'Gauteng', 'GP', 1),
	(3, 'North West', 'NW', 1),
	(4, 'Mpumalanga', 'MP', 1),
	(5, 'Northern Cape', 'NC', 1),
	(6, 'Free State', 'FS', 1),
	(7, 'KwaZulu-Natal', 'KZN', 1),
	(8, 'Western Cape', 'WC', 1),
	(9, 'Eastern Cape', 'EC', 1);
/*!40000 ALTER TABLE `provinces` ENABLE KEYS */;


-- Dumping structure for table yardwgzemg_db1.sectors
DROP TABLE IF EXISTS `sectors`;
CREATE TABLE IF NOT EXISTS `sectors` (
  `uid` int(10) NOT NULL AUTO_INCREMENT,
  `sector` varchar(50) NOT NULL,
  `active` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table yardwgzemg_db1.sectors: ~4 rows (approximately)
/*!40000 ALTER TABLE `sectors` DISABLE KEYS */;
INSERT INTO `sectors` (`uid`, `sector`, `active`) VALUES
	(1, 'National', 1),
	(2, 'Provincial', 1),
	(3, 'District', 1),
	(4, 'Local', 1);
/*!40000 ALTER TABLE `sectors` ENABLE KEYS */;


-- Dumping structure for table yardwgzemg_db1.titles
DROP TABLE IF EXISTS `titles`;
CREATE TABLE IF NOT EXISTS `titles` (
  `uid` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `active` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- Dumping data for table yardwgzemg_db1.titles: ~12 rows (approximately)
/*!40000 ALTER TABLE `titles` DISABLE KEYS */;
INSERT INTO `titles` (`uid`, `title`, `active`) VALUES
	(1, 'National Chair', 1),
	(2, 'National Treasurer', 1),
	(3, 'National Secretary', 1),
	(4, 'Provincial Chair', 1),
	(5, 'Provincial Treasurer', 1),
	(6, 'Provincial Secretary', 1),
	(7, 'District Chair', 1),
	(8, 'District Treasurer', 1),
	(9, 'District Secretary', 1),
	(10, 'Mr', 1),
	(11, 'Mrs', 1),
	(12, 'Ms', 1);
/*!40000 ALTER TABLE `titles` ENABLE KEYS */;


-- Dumping structure for table yardwgzemg_db1.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user` int(11) NOT NULL DEFAULT '0',
  `title` int(11) DEFAULT NULL,
  `province` int(11) DEFAULT NULL,
  `district` int(11) DEFAULT NULL,
  `username` varchar(50) NOT NULL DEFAULT '',
  `password` varchar(50) NOT NULL DEFAULT '',
  `first_name` varchar(50) NOT NULL DEFAULT '',
  `last_name` varchar(50) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `tel` varchar(30) NOT NULL DEFAULT '',
  `mobile` varchar(30) NOT NULL DEFAULT '',
  `fax` varchar(30) NOT NULL DEFAULT '',
  `NationalSecretary` varchar(255) DEFAULT NULL,
  `ProvincialSecretary` varchar(255) DEFAULT NULL,
  `ProvincialTreasurer` varchar(255) DEFAULT NULL,
  `NationalTreasurer` varchar(255) DEFAULT NULL,
  `notes` varchar(255) NOT NULL DEFAULT '',
  `active` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table yardwgzemg_db1.users: ~1 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`uid`, `datetime`, `user`, `title`, `province`, `district`, `username`, `password`, `first_name`, `last_name`, `email`, `tel`, `mobile`, `fax`, `NationalSecretary`, `ProvincialSecretary`, `ProvincialTreasurer`, `NationalTreasurer`, `notes`, `active`) VALUES
	(1, '2014-08-16 21:27:32', 0, NULL, NULL, NULL, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Admin', 'User', '', '', '', '', NULL, NULL, NULL, NULL, '', 1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;


-- Dumping structure for table yardwgzemg_db1.user_groups
DROP TABLE IF EXISTS `user_groups`;
CREATE TABLE IF NOT EXISTS `user_groups` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `group_id` int(11) NOT NULL DEFAULT '0',
  `active` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table yardwgzemg_db1.user_groups: ~1 rows (approximately)
/*!40000 ALTER TABLE `user_groups` DISABLE KEYS */;
INSERT INTO `user_groups` (`uid`, `datetime`, `user`, `user_id`, `group_id`, `active`) VALUES
	(1, '2014-08-16 21:27:33', 1, 1, 1, 1);
/*!40000 ALTER TABLE `user_groups` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
