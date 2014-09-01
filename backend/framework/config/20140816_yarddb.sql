-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.5.34-0ubuntu0.13.04.1 - (Ubuntu)
-- Server OS:                    debian-linux-gnu
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2014-08-16 11:06:03
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping database structure for yarddb
CREATE DATABASE IF NOT EXISTS `yarddb` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `yarddb`;


-- Dumping structure for table yarddb.enterprises
CREATE TABLE IF NOT EXISTS `enterprises` (
  `uid` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `group_id` int(11) NOT NULL DEFAULT '0',
  `active`      int(1)      NOT NULL default 1,
  PRIMARY KEY (`uid`
)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table yarddb.enterprises: ~0 rows (approximately)
/*!40000 ALTER TABLE `enterprises` DISABLE KEYS */;
/*!40000 ALTER TABLE `enterprises` ENABLE KEYS */;


-- Dumping structure for table yarddb.enterprise_groups
CREATE TABLE IF NOT EXISTS `enterprise_groups` (
  `uid` int(10) NOT NULL AUTO_INCREMENT,
  `group` varchar(50) NOT NULL,
  `active`      int(1)      NOT NULL default 1,
  PRIMARY KEY (`uid`
)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table yarddb.enterprise_groups: ~0 rows (approximately)
/*!40000 ALTER TABLE `enterprise_groups` DISABLE KEYS */;
INSERT INTO `enterprise_groups` (`uid`, `group`,`active`) VALUES
	(1, 'SMME',1),
	(2, 'Co-op',1),
	(3, 'Individual',1);
/*!40000 ALTER TABLE `enterprise_groups` ENABLE KEYS */;


-- Dumping structure for table yarddb.members
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
  `active`      int(1)      NOT NULL default 1,
  PRIMARY KEY (`uid`
)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table yarddb.members: ~0 rows (approximately)
/*!40000 ALTER TABLE `members` DISABLE KEYS */;
/*!40000 ALTER TABLE `members` ENABLE KEYS */;


-- Dumping structure for table yarddb.provincies
CREATE TABLE IF NOT EXISTS `provinces` (
  `uid` int(10) NOT NULL AUTO_INCREMENT,
  `province` varchar(50) NOT NULL,
  `active`      int(1)      NOT NULL default 1,
  PRIMARY KEY (`uid`
)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- Dumping data for table yarddb.provincies: ~0 rows (approximately)
/*!40000 ALTER TABLE `provincies` DISABLE KEYS */;
INSERT INTO `provinces` (`uid`, `province`,`active`) VALUES
	(1, 'Limpopo',1),
	(2, 'Gauteng',1),
	(3, 'North West',1),
	(4, 'Mpumalanga',1),
	(5, 'Northern Cape',1),
	(6, 'Free State',1),
	(7, 'KwaZulu-Natal',1),
	(8, 'Western Cape',1),
	(9, 'Eastern Cape',1);
/*!40000 ALTER TABLE `provincies` ENABLE KEYS */;


-- Dumping structure for table yarddb.sectors
CREATE TABLE IF NOT EXISTS `sectors` (
  `uid` int(10) NOT NULL AUTO_INCREMENT,
  `sector` varchar(50) NOT NULL,
  `active`      int(1)      NOT NULL default 1,
  PRIMARY KEY (`uid`
)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table yarddb.sectors: ~0 rows (approximately)
/*!40000 ALTER TABLE `sectors` DISABLE KEYS */;
INSERT INTO `sectors` (`uid`, `sector`,`active`) VALUES
	(1, 'National',1),
	(2, 'Provincial',1),
	(3, 'District',1),
	(4, 'Local',1);
/*!40000 ALTER TABLE `sectors` ENABLE KEYS */;


-- Dumping structure for table yarddb.titles
CREATE TABLE IF NOT EXISTS `titles` (
  `uid` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `active`  int(1)      NOT NULL default 1,
  PRIMARY KEY (`uid`
)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- Dumping data for table yarddb.titles: ~0 rows (approximately)
/*!40000 ALTER TABLE `titles` DISABLE KEYS */;
INSERT INTO `titles` (`uid`, `title`,`active`) VALUES
	(1, 'National Chair',1),
	(2, 'National Treasurer',1),
	(3, 'National Secretary',1),
	(4, 'Provincial Chair',1),
	(5, 'Provincial Treasurer',1),
	(6, 'Provincial Secretary',1),
	(7, 'District Chair',1),
	(8, 'District Treasurer',1),
	(9, 'District Secretary',1),
	(10, 'Mr',1),
	(11, 'Mrs',1),
	(12, 'Ms',1);
/*!40000 ALTER TABLE `titles` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

CREATE TABLE `users` (
  `uid`       int(11)     auto_increment,
  `datetime`      datetime    NOT NULL default '0000-00-00 00:00:00',
  `user`        int(11)     NOT NULL default 0,
  `username`      varchar(50)   NOT NULL default '',
  `password`      varchar(50)   NOT NULL default '',
  `first_name`    varchar(50)   NOT NULL default '',
  `last_name`     varchar(50)   NOT NULL default '',
  `email`       varchar(255)  NOT NULL default '',
  `tel`       varchar(30)   NOT NULL default '',
  `mobile`      varchar(30)   NOT NULL default '',
  `fax`       varchar(30)   NOT NULL default '',
  `notes`       varchar(255)  NOT NULL default '',
  `active`      int(1)      NOT NULL default 1,
  PRIMARY KEY (`uid`
)
);

CREATE TABLE `groups` (
  `uid`       int(11)     auto_increment,
  `datetime`      datetime    NOT NULL default '0000-00-00 00:00:00',
  `user`        int(11)     NOT NULL default 0,
  `name`        varchar(100)  NOT NULL default '',
  `active`      int(1)      NOT NULL default 1,
  PRIMARY KEY (`uid`
)
);

CREATE TABLE `user_groups` (
  `uid`       int(11)     auto_increment,
  `datetime`      datetime    NOT NULL default '0000-00-00 00:00:00',
  `user`        int(11)     NOT NULL default 0,
  `user_id`     int(11)     NOT NULL default 0,
  `group_id`      int(11)     NOT NULL default 0,
  `active`      int(1)      NOT NULL default 1,
  PRIMARY KEY (`uid`
)
);

INSERT INTO `users` (`datetime`, `username`, `password`, `first_name`, `last_name`, `active`) VALUES(NOW(), 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Admin', 'User', 1);
INSERT INTO `groups` (`datetime`, `user`, `name`) VALUES(NOW(), 1, 'Admin');
INSERT INTO `user_groups` (`datetime`, `user`, `user_id`, `group_id`, `active`) VALUES(NOW(), 1, 1, 1, 1);


ALTER TABLE `provinces` ADD `abreviation` varchar(3) AFTER `province`;

UPDATE `provinces` SET `abreviation` = 'EC' WHERE `uid`= 9;
UPDATE `provinces` SET `abreviation` = 'FS' WHERE `uid`= 6;
UPDATE `provinces` SET `abreviation` = 'GP' WHERE `uid`= 2;
UPDATE `provinces` SET `abreviation` = 'KZN' WHERE `uid`= 7;
UPDATE `provinces` SET `abreviation` = 'LP' WHERE `uid`= 1;
UPDATE `provinces` SET `abreviation` = 'NC' WHERE `uid`= 5;
UPDATE `provinces` SET `abreviation` = 'NW' WHERE `uid`= 3;
UPDATE `provinces` SET `abreviation` = 'NC' WHERE `uid`= 5;
UPDATE `provinces` SET `abreviation` = 'WC' WHERE `uid`= 8;
UPDATE `provinces` SET `abreviation` = 'MP' WHERE `uid`= 4;


CREATE TABLE IF NOT EXISTS `functions` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `function` varchar(50) NOT NULL DEFAULT '',
  `name` varchar(255) NOT NULL DEFAULT '',
  `category` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`uid`)
);

CREATE TABLE IF NOT EXISTS `comments` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `item` varchar(255) NOT NULL DEFAULT '',
  `user` varchar(11) NOT NULL DEFAULT '0',
  `comment` blob,
  `company` int(11) NOT NULL,
  `active` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`uid`)
);


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
);

INSERT INTO `functions` (`uid`, `function`, `name`, `category`)
VALUES  (1, 'admin_users', 'User Administration', 'Admin');


CREATE TABLE IF NOT EXISTS `functions_users` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `function` varchar(50) NOT NULL DEFAULT '',
  `user` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`uid`)
);

INSERT INTO `functions` (`uid`, `function`, `name`, `category`)
VALUES  (2, 'District', 'District Administration', 'Admin');
INSERT INTO `functions` (`uid`, `function`, `name`, `category`)
VALUES  (3, 'Provincial', 'Provincial Administration', 'Admin');
INSERT INTO `functions` (`uid`, `function`, `name`, `category`)
VALUES  (4, 'National', 'National Administration', 'Admin');
INSERT INTO `functions` (`uid`, `function`, `name`, `category`)
VALUES  (5, 'Local', 'Local Administration', 'Admin');

CREATE TABLE IF NOT EXISTS `districts` (
  `uid` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `code` varchar(50) NOT NULL,
  `province_id` int(11) NOT NULL DEFAULT '0',
  `active`      int(1)      NOT NULL default 1,
  PRIMARY KEY (`uid`
)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `districts` (`uid`, `name`, `code`,`province_id`, `active`)
VALUES  (1, 'Amajuba District Municipality','DC25', 7, 1);
INSERT INTO `districts` (`uid`, `name`, `code`,`province_id`, `active`)
VALUES  (2, 'eThekwini Metropolitan Municipality','ETH', 7, 1);
INSERT INTO `districts` (`uid`, `name`, `code`,`province_id`, `active`)
VALUES  (3, 'iLembe District Municipality','DC29', 7, 1);
INSERT INTO `districts` (`uid`, `name`, `code`,`province_id`, `active`)
VALUES  (4, 'Sisonke District Municipality','DC43', 7, 1);
INSERT INTO `districts` (`uid`, `name`, `code`,`province_id`, `active`)
VALUES  (5, 'Ugu District Municipality','DC21', 7, 1);
INSERT INTO `districts` (`uid`, `name`, `code`,`province_id`, `active`)
VALUES  (6, 'uMgungundlovu District Municipality','DC22', 7, 1);
INSERT INTO `districts` (`uid`, `name`, `code`,`province_id`, `active`)
VALUES  (7, 'uMgungundlovu District Municipality','DC22', 7, 1);
INSERT INTO `districts` (`uid`, `name`, `code`,`province_id`, `active`)
VALUES  (8, 'uMkhanyakude District Municipality','DC27', 7, 1);
INSERT INTO `districts` (`uid`, `name`, `code`,`province_id`, `active`)
VALUES  (9, 'uMzinyathi District Municipality','DC24', 7, 1);
INSERT INTO `districts` (`uid`, `name`, `code`,`province_id`, `active`)
VALUES  (10, 'uThukela District Municipality','DC23', 7, 1);
INSERT INTO `districts` (`uid`, `name`, `code`,`province_id`, `active`)
VALUES  (11, 'uThukela District Municipality','DC28', 7, 1);
INSERT INTO `districts` (`uid`, `name`, `code`,`province_id`, `active`)
VALUES  (12, 'Zululand District Municipality','DC26', 7, 1);
INSERT INTO `districts` (`uid`, `name`, `code`,`province_id`, `active`)
VALUES  (13, 'City of Johannesburg Metropolitan Municipality','JHB', 2, 1);
INSERT INTO `districts` (`uid`, `name`, `code`,`province_id`, `active`)
VALUES  (14, 'City of Tshwane Metropolitan Municipality','TSH', 2, 1);
INSERT INTO `districts` (`uid`, `name`, `code`,`province_id`, `active`)
VALUES  (15, 'Ekurhuleni Metropolitan Municipality','EKU', 2, 1);
INSERT INTO `districts` (`uid`, `name`, `code`,`province_id`, `active`)
VALUES  (16, 'Sedibeng District Municipality','DC42', 2, 1);
INSERT INTO `districts` (`uid`, `name`, `code`,`province_id`, `active`)
VALUES  (17, 'West Rand District Municipality','DC48', 2, 1);
INSERT INTO `districts` (`uid`, `name`, `code`,`province_id`, `active`)
VALUES  (18, 'Capricorn District Municipality','DC35', 1, 1);
INSERT INTO `districts` (`uid`, `name`, `code`,`province_id`, `active`)
VALUES  (19, 'Mopani District Municipality','DC33', 1, 1);
INSERT INTO `districts` (`uid`, `name`, `code`,`province_id`, `active`)
VALUES  (20, 'Sekhukhune District Municipality','DC47', 1, 1);
INSERT INTO `districts` (`uid`, `name`, `code`,`province_id`, `active`)
VALUES  (21, 'Vhembe District Municipality','DC34', 1, 1);
INSERT INTO `districts` (`uid`, `name`, `code`,`province_id`, `active`)
VALUES  (22, 'Waterberg District Municipality','DC36', 1, 1);
INSERT INTO `districts` (`uid`, `name`, `code`,`province_id`, `active`)
VALUES  (23, 'Bojanala Platinum District Municipality','DC37', 3, 1);
INSERT INTO `districts` (`uid`, `name`, `code`,`province_id`, `active`)
VALUES  (24, 'Dr Kenneth Kaunda District Municipality','DC40', 3, 1);
INSERT INTO `districts` (`uid`, `name`, `code`,`province_id`, `active`)
VALUES  (25, 'Dr Ruth Segomotsi Mompati District Municipality','DC39', 3, 1);
INSERT INTO `districts` (`uid`, `name`, `code`,`province_id`, `active`)
VALUES  (26, 'Ngaka Modiri Molema District Municipality','DC38', 3, 1);
INSERT INTO `districts` (`uid`, `name`, `code`,`province_id`, `active`)
VALUES  (27, 'Ehlanzeni District Municipality','DC32', 4, 1);
INSERT INTO `districts` (`uid`, `name`, `code`,`province_id`, `active`)
VALUES  (28, 'Gert Sibande District Municipality','DC30', 4, 1);
INSERT INTO `districts` (`uid`, `name`, `code`,`province_id`, `active`)
VALUES  (29, 'Nkangala District Municipality','DC31', 4, 1);
INSERT INTO `districts` (`uid`, `name`, `code`,`province_id`, `active`)
VALUES  (30, 'Frances Baard District Municipality','DC9', 5, 1);
INSERT INTO `districts` (`uid`, `name`, `code`,`province_id`, `active`)
VALUES  (31, 'John Taolo Gaetsewe District Municipality','DC45', 5, 1);
INSERT INTO `districts` (`uid`, `name`, `code`,`province_id`, `active`)
VALUES  (32, 'Namakwa District Municipality','DC6', 5, 1);
INSERT INTO `districts` (`uid`, `name`, `code`,`province_id`, `active`)
VALUES  (33, 'Pixley ka Seme District Municipality','DC7', 5, 1);
INSERT INTO `districts` (`uid`, `name`, `code`,`province_id`, `active`)
VALUES  (34, 'ZF Mgcawu District Municipality','DC8', 5, 1);
INSERT INTO `districts` (`uid`, `name`, `code`,`province_id`, `active`)
VALUES  (35, 'Fezile Dabi District Municipality','DC20', 6, 1);
INSERT INTO `districts` (`uid`, `name`, `code`,`province_id`, `active`)
VALUES  (36, 'Lejweleputswa District Municipality','DC18', 6, 1);
INSERT INTO `districts` (`uid`, `name`, `code`,`province_id`, `active`)
VALUES  (37, 'Mangaung Metropolitan Municipality','MAN', 6, 1);
INSERT INTO `districts` (`uid`, `name`, `code`,`province_id`, `active`)
VALUES  (38, 'Thabo Mofutsanyana District Municipality','DC19', 6, 1);
INSERT INTO `districts` (`uid`, `name`, `code`,`province_id`, `active`)
VALUES  (39, 'Xhariep District Municipality','DC16', 6, 1);
INSERT INTO `districts` (`uid`, `name`, `code`,`province_id`, `active`)
VALUES  (40, 'Cape Winelands District Municipality','DC2', 8, 1);
INSERT INTO `districts` (`uid`, `name`, `code`,`province_id`, `active`)
VALUES  (41, 'Central Karoo District Municipality','DC5', 8, 1);
INSERT INTO `districts` (`uid`, `name`, `code`,`province_id`, `active`)
VALUES  (42, 'City of Cape Town Metropolitan Municipality','CPT', 8, 1);
INSERT INTO `districts` (`uid`, `name`, `code`,`province_id`, `active`)
VALUES  (43, 'Eden District Municipality','DC4', 8, 1);
INSERT INTO `districts` (`uid`, `name`, `code`,`province_id`, `active`)
VALUES  (44, 'Overberg District Municipality','DC3', 8, 1);
INSERT INTO `districts` (`uid`, `name`, `code`,`province_id`, `active`)
VALUES  (45, 'West Coast District Municipality','DC1', 8, 1);
INSERT INTO `districts` (`uid`, `name`, `code`,`province_id`, `active`)
VALUES  (46, 'Alfred Nzo District Municipality','DC44', 9, 1);
INSERT INTO `districts` (`uid`, `name`, `code`,`province_id`, `active`)
VALUES  (47, 'Amathole District Municipality','DC12', 9, 1);
INSERT INTO `districts` (`uid`, `name`, `code`,`province_id`, `active`)
VALUES  (48, 'Buffalo City Metropolitan Municipality','BUF', 9, 1);
INSERT INTO `districts` (`uid`, `name`, `code`,`province_id`, `active`)
VALUES  (49, 'Cacadu District Municipality','DC10', 9, 1);
INSERT INTO `districts` (`uid`, `name`, `code`,`province_id`, `active`)
VALUES  (50, 'Chris Hani District Municipality','DC13', 9, 1);
INSERT INTO `districts` (`uid`, `name`, `code`,`province_id`, `active`)
VALUES  (51, 'Joe Gqabi District Municipality','DC14', 9, 1);
INSERT INTO `districts` (`uid`, `name`, `code`,`province_id`, `active`)
VALUES  (52, 'Nelson Mandela Bay Metropolitan Municipality','NMA', 9, 1);
INSERT INTO `districts` (`uid`, `name`, `code`,`province_id`, `active`)
VALUES  (53, 'OR Tambo District Municipality','DC15', 9, 1);
ALTER TABLE `users` ADD `province` int AFTER `user`;
ALTER TABLE `users` ADD `district` int AFTER `province`;



















