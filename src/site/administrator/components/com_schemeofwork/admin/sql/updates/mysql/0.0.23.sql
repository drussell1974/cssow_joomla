ALTER TABLE `sow_schemeofwork` ADD COLUMN IF NOT EXISTS `created` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00' AFTER `asset_id`;
ALTER TABLE `sow_schemeofwork` ADD COLUMN IF NOT EXISTS `created_by` INT(10) UNSIGNED NOT NULL DEFAULT '0' AFTER `created`;