/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Author:  Dave
 * Created: 16-Nov-2018
 */

-- ----------------------------------------------------------------------------
-- MySQL Workbench Migration
-- Migrated Schemata: cssow
-- Source Schemata: cssow
-- Created: Mon Nov 12 15:39:29 2018
-- Workbench Version: 8.0.13
-- ----------------------------------------------------------------------------

SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------------------------------------------------------
-- Table sow_cs_concept
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `sow_cs_concept` (
  `id` INT(11) NOT NULL,
  `name` VARCHAR(20) NOT NULL,
  `abbr` CHAR(2) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

-- ----------------------------------------------------------------------------
-- Table sow_exam_board
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `sow_exam_board` (
  `id` INT(11) NOT NULL,
  `name` VARCHAR(15) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

-- ----------------------------------------------------------------------------
-- Table sow_key_stage
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `sow_key_stage` (
  `id` INT(11) NOT NULL,
  `name` VARCHAR(3) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

-- ----------------------------------------------------------------------------
-- Table sow_ks123_pathway
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `sow_ks123_pathway` (
  `id` INT(11) NOT NULL,
  `objective` VARCHAR(1000) NOT NULL,
  `year_id` INT(11) NOT NULL,
  `topic_id` INT(11) NOT NULL,
  `subject_purpose_id` INT(11) NULL DEFAULT NULL,
  `Abstraction` VARCHAR(5) NULL DEFAULT NULL,
  `Decomposition` VARCHAR(5) NULL DEFAULT NULL,
  `Algorithmic Thinking` VARCHAR(5) NULL DEFAULT NULL,
  `Evaluation` VARCHAR(5) NULL DEFAULT NULL,
  `Generalisation` VARCHAR(5) NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_sow_pathway_topic1_idx` (`topic_id` ASC),
  INDEX `fk_sow_pathway_year_idx` (`year_id` ASC) ,
  INDEX `fk_sow_pathway_subject_purpose_idx` (`subject_purpose_id` ASC),
  CONSTRAINT `fk_sow_pathway_subject_purpose`
    FOREIGN KEY (`subject_purpose_id`)
    REFERENCES `sow_subject_purpose` (`id`),
  CONSTRAINT `fk_sow_pathway_topic`
    FOREIGN KEY (`topic_id`)
    REFERENCES `sow_topic` (`id`),
  CONSTRAINT `fk_sow_pathway_year`
    FOREIGN KEY (`year_id`)
    REFERENCES `sow_year` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

-- ----------------------------------------------------------------------------
-- Table sow_content
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `sow_content` (
  `id` INT(11) NOT NULL,
  `description` VARCHAR(500) NOT NULL,
  `letter` CHAR(1) NOT NULL,
  `key_stage` INT(11) NOT NULL DEFAULT '4',
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

-- ----------------------------------------------------------------------------
-- Table sow_learning_objective
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `sow_learning_objective` (
  `id` INT(11) NOT NULL,
  `description` VARCHAR(1000) NOT NULL,
  `solo_taxonomy_id` INT(11) NULL DEFAULT NULL,
  `topic_id` INT(11) NOT NULL,
  `content_id` INT(11) NOT NULL,
  `exam_board_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_sow_learning_objective_topic1_idx` (`topic_id` ASC),
  INDEX `fk_sow_learning_objective_content_idx` (`content_id` ASC),
  INDEX `fk_sow_learning_objective_solo_taxonomy1_idx` (`solo_taxonomy_id` ASC),
  INDEX `fk_sow_learning_objective_exam_board1_idx` (`exam_board_id` ASC),
  CONSTRAINT `fk_sow_learning_objective_exam_board`
    FOREIGN KEY (`exam_board_id`)
    REFERENCES `sow_exam_board` (`id`),
  CONSTRAINT `fk_sow_learning_objective_content`
    FOREIGN KEY (`content_id`)
    REFERENCES `sow_content` (`id`),
  CONSTRAINT `fk_sow_learning_objective_solo_taxonomy`
    FOREIGN KEY (`solo_taxonomy_id`)
    REFERENCES `sow_solo_taxonomy` (`id`),
  CONSTRAINT `fk_sow_learning_objective_topic`
    FOREIGN KEY (`topic_id`)
    REFERENCES `sow_topic` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

-- ----------------------------------------------------------------------------
-- Table sow_learning_objective_has_ks123_pathway
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `sow_learning_objective_has_ks123_pathway` (
  `learning_objective_id` INT(11) NOT NULL,
  `ks123_pathway_id` INT(11) NOT NULL,
  PRIMARY KEY (`learning_objective_id`, `ks123_pathway_id`),
  INDEX `fk_sow_learning_objective_has_ks123_pathway_ks123_pathway_idx` (`ks123_pathway_id` ASC),
  INDEX `fk_learning_objective_has_ks123_pathway_learning_objective_idx` (`learning_objective_id` ASC),
  CONSTRAINT `fk_sow_learning_objective_has_ks123_pathway_ks123_pathway1`
    FOREIGN KEY (`ks123_pathway_id`)
    REFERENCES `sow_ks123_pathway` (`id`),
  CONSTRAINT `fk_sow_learning_objective_has_ks123_pathway_learning_objective1`
    FOREIGN KEY (`learning_objective_id`)
    REFERENCES `sow_learning_objective` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

-- ----------------------------------------------------------------------------
-- Table sow_play_based
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `sow_play_based` (
  `id` INT(11) NOT NULL,
  `name` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

-- ----------------------------------------------------------------------------
-- Table sow_solo_taxonomy
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `sow_solo_taxonomy` (
  `id` INT(11) NOT NULL,
  `name` VARCHAR(100) NOT NULL,
  `level` CHAR(1) NOT NULL DEFAULT 'A',
  PRIMARY KEY (`id`),
  UNIQUE INDEX `name_UNIQUE` (`name` ASC) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

-- ----------------------------------------------------------------------------
-- Table sow_subject_purpose
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `sow_subject_purpose` (
  `id` INT(11) NOT NULL,
  `name` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

-- ----------------------------------------------------------------------------
-- Table sow_topic
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `sow_topic` (
  `id` INT(11) NOT NULL,
  `name` VARCHAR(45) NOT NULL,
  `parent_id` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_sow_topic_topic1_idx` (`parent_id` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

-- ----------------------------------------------------------------------------
-- Table sow_year
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `sow_year` (
  `id` INT(11) NOT NULL,
  `name` VARCHAR(3) NOT NULL,
  `keystage_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`, `keystage_id`),
  INDEX `fk_sow_year_keystage_idx` (`keystage_id` ASC),
  CONSTRAINT `fk_sow_year_keystage`
    FOREIGN KEY (`keystage_id`)
    REFERENCES `sow_key_stage` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

-- ----------------------------------------------------------------------------
-- View sow_learning_objectives_by_ks123_pathway_topic
-- ----------------------------------------------------------------------------

CREATE OR REPLACE 
	VIEW `sow_learning_objectives_by_ks123_pathway_topic` 
AS 
	SELECT 
    `lo`.`id` AS `learning_objective_id`,
    `lo`.`description` AS `learning_objective_description`,
    `sow_solo_taxonomy`.`level` AS `solo_level`,
    `lo`.`topic_id` AS `topic_id`,
    `sow_topic`.`name` AS `topic_name`,
    `parent_topic`.`id` AS `parent_topic_id`,
    `parent_topic`.`name` AS `parent_topic_name`,
    `path`.`id` AS `path_objective_id`,
    `path`.`objective` AS `path_objective_description`,
    `sow_year`.`id` AS `year_id`,
    `sow_year`.`name` AS `year_name`
FROM
    (((((`sow_learning_objective` `lo`
    JOIN `sow_topic` ON ((`lo`.`topic_id` = `sow_topic`.`id`)))
    JOIN `sow_topic` `parent_topic` ON ((`sow_topic`.`parent_id` = `parent_topic`.`id`)))
    JOIN `sow_ks123_pathway` `path` ON ((`parent_topic`.`id` = `path`.`topic_id`)))
    JOIN `sow_year` ON ((`path`.`year_id` = `sow_year`.`id`)))
    JOIN `sow_solo_taxonomy` ON ((`lo`.`solo_taxonomy_id` = `sow_solo_taxonomy`.`id`)));
SET FOREIGN_KEY_CHECKS = 1;


-- ----------------------------------------------------------------------------
-- Table #__schemeofwork
-- ----------------------------------------------------------------------------
DROP TABLE IF EXISTS `#__schemeofwork`;

CREATE TABLE `#__schemeofwork` (
	`id`       INT(11)     NOT NULL AUTO_INCREMENT,
	`greeting` VARCHAR(25) NOT NULL,
	`published` tinyint(4) NOT NULL DEFAULT '1',
	PRIMARY KEY (`id`)
)
	ENGINE =MyISAM
	AUTO_INCREMENT =0
	DEFAULT CHARSET =utf8;

INSERT INTO `#__schemeofwork` (`greeting`) VALUES
('Message from db!!!!'),
('Good bye from db!!!!');


-- ----------------------------------------------------------------------------
-- Table sow_year
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS sow_schemeofwork (
	`id`       INT(11)     NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(25) NOT NULL,
	`published` tinyint(4) NOT NULL DEFAULT '1',
	`catid`	    int(11)    NOT NULL DEFAULT '0',
        PRIMARY KEY (`id`)
)
	ENGINE =MyISAM
	AUTO_INCREMENT =0
	DEFAULT CHARSET =utf8;

INSERT INTO sow_subject (`name`) VALUES
('GCSE Computer Science'),
('KS3 Computing'),
('KS2 IT Computing');