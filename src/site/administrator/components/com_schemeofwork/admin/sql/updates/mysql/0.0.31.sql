ALTER TABLE `sow_year` CHANGE COLUMN `keystage_id` `key_stage_id` INT(11) NOT NULL DEFAULT '4';
ALTER TABLE `sow_year` MODIFY COLUMN `name` VARCHAR(4) NOT NULL;

