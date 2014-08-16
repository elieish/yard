CREATE TABLE `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `item` varchar(255) NOT NULL DEFAULT '',
  `user` varchar(11) NOT NULL DEFAULT '0',
  `comment` blob,
  `company` int(11) NOT NULL,
  `active` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8