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
CREATE TABLE IF NOT EXISTS `provincies` (
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
