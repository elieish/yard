ALTER TABLE `exim_logs`
    CHANGE COLUMN `subject` `subject` VARCHAR(255) NULL DEFAULT NULL AFTER `message_id`;