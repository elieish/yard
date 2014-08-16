/* Default SQL data to run for first time installation */
INSERT INTO `users` (`datetime`, `username`, `password`, `first_name`, `last_name`, `active`) VALUES(NOW(), 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Admin', 'User', 1);

INSERT INTO `groups` (`datetime`, `user`, `name`) VALUES(NOW(), 1, 'Admin');

INSERT INTO `user_groups` (`datetime`, `user`, `user_id`, `group_id`, `active`) VALUES(NOW(), 1, 1, 1, 1);

INSERT INTO `functions` (`function`, `name`, `category`) VALUES('home', 'Home Page', 'General');
INSERT INTO `functions` (`function`, `name`, `category`) VALUES('admin_menu', 'Admin Menu', 'Admin');
INSERT INTO `functions` (`function`, `name`, `category`) VALUES('admin_users', 'User Administration', 'Admin');

INSERT INTO `group_functions` (`function`, `group`) VALUES('home', 1);
INSERT INTO `group_functions` (`function`, `group`) VALUES('admin_menu', 1);
INSERT INTO `group_functions` (`function`, `group`) VALUES('admin_users', 1);

INSERT INTO `exim_accounts` 
    (`email_address`, `user`, `password`, `domain`, `system_guid`, `system_uid`, `autoreply`, `forward`, `maildir`, `home`, `active`, `deliver_first`) VALUES 
    ('postmaster@amefax.co.za', 'fax', 'fax123', 1, 12, 8, 0, 0, '/var/spool/amefax/Maildir', '/var/spool/amefax/', 1, 0);

INSERT INTO `exim_domains` (`domain`, `type`, `active`) VALUES ('amefax.co.za', 'local', 1);
INSERT INTO `exim_domains` (`domain`, `type`, `active`) VALUES ('isfax.co.za', 'relay', 1);
INSERT INTO `exim_domains` (`domain`, `type`, `active`) VALUES ('incoming.vax.co.za', 'relay', 1);

INSERT INTO `exim_forwarders` (`account`, `forwarder`) VALUES (1, 'anthon@ws.co.za');
