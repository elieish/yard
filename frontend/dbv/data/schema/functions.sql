CREATE TABLE `functions` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `function` varchar(50) NOT NULL DEFAULT '',
  `name` varchar(255) NOT NULL DEFAULT '',
  `category` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8