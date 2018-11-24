SET FOREIGN_KEY_CHECKS = 0;

ALTER TABLE `sow_content` 
	ADD COLUMN `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' after key_stage, 
	ADD COLUMN `created_by` int(10) unsigned NOT NULL DEFAULT '0' after created,
    ADD COLUMN `published` tinyint(4) unsigned NOT NULL DEFAULT '1' after created_by;    

ALTER TABLE `sow_cs_concept` 
	ADD COLUMN IF NOT EXISTS `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' after abbr, 
	ADD COLUMN IF NOT EXISTS `created_by` int(10) unsigned NOT NULL DEFAULT '0' after created,
    ADD COLUMN IF NOT EXISTS `published` tinyint(4) unsigned NOT NULL DEFAULT '1' after created_by;    
    
ALTER TABLE `sow_exam_board` 
	ADD COLUMN IF NOT EXISTS `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' after name, 
	ADD COLUMN IF NOT EXISTS `created_by` int(10) unsigned NOT NULL DEFAULT '0' after created,
    ADD COLUMN IF NOT EXISTS `published` tinyint(4) unsigned NOT NULL DEFAULT '1' after created_by;

ALTER TABLE `sow_key_stage` 
	ADD COLUMN IF NOT EXISTS `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' after name, 
	ADD COLUMN IF NOT EXISTS `created_by` int(10) unsigned NOT NULL DEFAULT '0' after created,
    ADD COLUMN IF NOT EXISTS `published` tinyint(4) unsigned NOT NULL DEFAULT '1' after created_by;

ALTER TABLE `sow_ks123_pathway` 
	ADD COLUMN IF NOT EXISTS `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' after Generalisation, 
	ADD COLUMN IF NOT EXISTS `created_by` int(10) unsigned NOT NULL DEFAULT '0' after created,
    ADD COLUMN IF NOT EXISTS `published` tinyint(4) unsigned NOT NULL DEFAULT '1' after created_by;

ALTER TABLE `sow_learning_objective` 
	ADD COLUMN IF NOT EXISTS `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' after exam_board_id, 
	ADD COLUMN IF NOT EXISTS `created_by` int(10) unsigned NOT NULL DEFAULT '0' after created,
    ADD COLUMN IF NOT EXISTS `published` tinyint(4) unsigned NOT NULL DEFAULT '1' after created_by;
    
ALTER TABLE `sow_learning_objective_has_ks123_pathway` 
	ADD COLUMN IF NOT EXISTS `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' after learning_objective_id, 
	ADD COLUMN IF NOT EXISTS `created_by` int(10) unsigned NOT NULL DEFAULT '0' after created,
    ADD COLUMN IF NOT EXISTS `published` tinyint(4) unsigned NOT NULL DEFAULT '1' after created_by;
    
ALTER TABLE `sow_play_based` 
	ADD COLUMN IF NOT EXISTS `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' after name, 
	ADD COLUMN IF NOT EXISTS `created_by` int(10) unsigned NOT NULL DEFAULT '0' after created,
    ADD COLUMN IF NOT EXISTS `published` tinyint(4) unsigned NOT NULL DEFAULT '1' after created_by;
    
ALTER TABLE `sow_solo_taxonomy` 
	ADD COLUMN IF NOT EXISTS `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' after level, 
	ADD COLUMN IF NOT EXISTS `created_by` int(10) unsigned NOT NULL DEFAULT '0' after created,
    ADD COLUMN IF NOT EXISTS `published` tinyint(4) unsigned NOT NULL DEFAULT '1' after created_by;
    
ALTER TABLE `sow_subject_purpose` 
	ADD COLUMN IF NOT EXISTS `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' after name, 
	ADD COLUMN IF NOT EXISTS `created_by` int(10) unsigned NOT NULL DEFAULT '0' after created,
    ADD COLUMN IF NOT EXISTS `published` tinyint(4) unsigned NOT NULL DEFAULT '1' after created_by;
    
ALTER TABLE `sow_topic` 
	ADD COLUMN IF NOT EXISTS `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' after parent_id, 
	ADD COLUMN IF NOT EXISTS `created_by` int(10) unsigned NOT NULL DEFAULT '0' after created,
    ADD COLUMN IF NOT EXISTS `published` tinyint(4) unsigned NOT NULL DEFAULT '1' after created_by;
    
ALTER TABLE `sow_year` 
	ADD COLUMN IF NOT EXISTS `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' after keystage_id, 
	ADD COLUMN IF NOT EXISTS `created_by` int(10) unsigned NOT NULL DEFAULT '0' after created,
    ADD COLUMN IF NOT EXISTS `published` tinyint(4) unsigned NOT NULL DEFAULT '1' after created_by;
    
SET FOREIGN_KEY_CHECKS = 1;