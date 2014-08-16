ALTER TABLE `exim_logs`
    ADD COLUMN `company` INT UNSIGNED NOT NULL DEFAULT '0' AFTER `date`,
    ADD COLUMN `cost_center` INT UNSIGNED NOT NULL DEFAULT '0' AFTER `company`,
    ADD COLUMN `department` INT UNSIGNED NOT NULL DEFAULT '0' AFTER `cost_center`,
    CHANGE COLUMN `sender` `sender` VARCHAR(100) NULL DEFAULT NULL AFTER `department`;

UPDATE 
    `exim_logs` el
    SET 
        `company` = (SELECT `company_id` FROM `employees` WHERE `email` = el.`sender` AND `active` = 1 LIMIT 1),
        `cost_center` = (SELECT `cost_center_id` FROM `employees` WHERE `email` = el.`sender` AND `active` = 1 LIMIT 1),
        `department`  = (SELECT `department_id` FROM `employees` WHERE `email` = el.`sender` AND `active` = 1 LIMIT 1)