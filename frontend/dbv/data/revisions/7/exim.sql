ALTER TABLE `exim_logs`
    CHANGE COLUMN `status` `status` VARCHAR(100) NULL DEFAULT 'Pending' AFTER `fax_reference`;
UPDATE `exim_logs` SET `status` = 'Pending' WHERE `status` = 'Unknown';

ALTER TABLE `amefax`.`exim_accounts` ENGINE InnoDB;
ALTER TABLE `amefax`.`exim_autoreplies` ENGINE InnoDB;
ALTER TABLE `amefax`.`exim_domains` ENGINE InnoDB;
ALTER TABLE `amefax`.`exim_forwarders` ENGINE InnoDB;
ALTER TABLE `amefax`.`exim_logs` ENGINE InnoDB;