ALTER TABLE `sow_schemeofwork` ADD COLUMN IF NOT EXISTS `asset_id` INT(10) UNSIGNED NOT NULL DEFAULT '0' AFTER `id`;