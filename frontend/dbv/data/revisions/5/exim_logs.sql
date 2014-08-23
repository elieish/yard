ALTER TABLE `exim_logs`
	CHANGE COLUMN `status` `status` VARCHAR(30) NULL DEFAULT 'Unknown' AFTER `fax_reference`;
UPDATE `exim_logs`
	SET `status` = 'Unknown' WHERE ISNULL(`status`) OR `status` = '';