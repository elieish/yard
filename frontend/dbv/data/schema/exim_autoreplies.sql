CREATE TABLE `exim_autoreplies` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `account` int(11) NOT NULL DEFAULT '0',
  `autoreply` text NOT NULL,
  PRIMARY KEY (`uid`),
  KEY `account` (`account`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC