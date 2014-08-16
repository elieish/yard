CREATE TABLE `group_functions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `function` varchar(50) NOT NULL DEFAULT '',
  `group` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8