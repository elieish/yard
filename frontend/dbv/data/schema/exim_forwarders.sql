CREATE TABLE `exim_forwarders` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `account` int(11) NOT NULL DEFAULT '0',
  `forwarder` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`uid`),
  KEY `account` (`account`),
  KEY `forwarder` (`forwarder`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC