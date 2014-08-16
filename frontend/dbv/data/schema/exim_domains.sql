CREATE TABLE `exim_domains` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `domain` varchar(255) NOT NULL DEFAULT '',
  `type` varchar(10) NOT NULL DEFAULT 'local',
  `active` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`uid`),
  KEY `domain` (`domain`),
  KEY `type` (`type`),
  KEY `active` (`active`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC