-- ----------------------------------------------------------------------------
-- MySQL Workbench Migration
-- Migrated Schemata: cssow
-- Source Schemata: cssow
-- Created: Mon Nov 12 15:39:29 2018
-- Workbench Version: 8.0.13
-- ----------------------------------------------------------------------------
USE `cssow`;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------------------------------------------------------
-- Table cssow.cs_cs_concept
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `cssow`.`cs_cs_concept` (
  `id` INT(11) NOT NULL,
  `name` VARCHAR(20) NOT NULL,
  `abbr` CHAR(2) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

-- ----------------------------------------------------------------------------
-- Table cssow.cs_exam_board
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `cssow`.`cs_exam_board` (
  `id` INT(11) NOT NULL,
  `name` VARCHAR(15) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

-- ----------------------------------------------------------------------------
-- Table cssow.cs_key_stage
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `cssow`.`cs_key_stage` (
  `id` INT(11) NOT NULL,
  `name` VARCHAR(3) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

-- ----------------------------------------------------------------------------
-- Table cssow.cs_ks123_pathway
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `cssow`.`cs_ks123_pathway` (
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
  INDEX `fk_pathway_topic1_idx` (`topic_id` ASC),
  INDEX `fk_pathway_year_idx` (`year_id` ASC) ,
  INDEX `fk_pathway_subject_purpose_idx` (`subject_purpose_id` ASC),
  CONSTRAINT `fk_pathway_subject_purpose`
    FOREIGN KEY (`subject_purpose_id`)
    REFERENCES `cssow`.`cs_subject_purpose` (`id`),
  CONSTRAINT `fk_pathway_topic`
    FOREIGN KEY (`topic_id`)
    REFERENCES `cssow`.`cs_topic` (`id`),
  CONSTRAINT `fk_pathway_year`
    FOREIGN KEY (`year_id`)
    REFERENCES `cssow`.`cs_year` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

-- ----------------------------------------------------------------------------
-- Table cssow.cs_ks4_content
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `cssow`.`cs_ks4_content` (
  `id` INT(11) NOT NULL,
  `description` VARCHAR(500) NOT NULL,
  `letter` CHAR(1) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

-- ----------------------------------------------------------------------------
-- Table cssow.cs_learning_objective
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `cssow`.`cs_learning_objective` (
  `id` INT(11) NOT NULL,
  `description` VARCHAR(1000) NOT NULL,
  `solo_taxonomy_id` INT(11) NULL DEFAULT NULL,
  `topic_id` INT(11) NOT NULL,
  `ks4_content_id` INT(11) NOT NULL,
  `exam_board_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_learning_objective_topic1_idx` (`topic_id` ASC),
  INDEX `fk_learning_objective_ks4_content1_idx` (`ks4_content_id` ASC),
  INDEX `fk_learning_objective_solo_taxonomy1_idx` (`solo_taxonomy_id` ASC),
  INDEX `fk_learning_objective_exam_board1_idx` (`exam_board_id` ASC),
  CONSTRAINT `fk_learning_objective_exam_board`
    FOREIGN KEY (`exam_board_id`)
    REFERENCES `cssow`.`cs_exam_board` (`id`),
  CONSTRAINT `fk_learning_objective_ks4_content`
    FOREIGN KEY (`ks4_content_id`)
    REFERENCES `cssow`.`cs_ks4_content` (`id`),
  CONSTRAINT `fk_learning_objective_solo_taxonomy`
    FOREIGN KEY (`solo_taxonomy_id`)
    REFERENCES `cssow`.`cs_solo_taxonomy` (`id`),
  CONSTRAINT `fk_learning_objective_topic`
    FOREIGN KEY (`topic_id`)
    REFERENCES `cssow`.`cs_topic` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

-- ----------------------------------------------------------------------------
-- Table cssow.cs_learning_objective_has_ks123_pathway
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `cssow`.`cs_learning_objective_has_ks123_pathway` (
  `learning_objective_id` INT(11) NOT NULL,
  `ks123_pathway_id` INT(11) NOT NULL,
  PRIMARY KEY (`learning_objective_id`, `ks123_pathway_id`),
  INDEX `fk_learning_objective_has_ks123_pathway_ks123_pathway1_idx` (`ks123_pathway_id` ASC),
  INDEX `fk_learning_objective_has_ks123_pathway_learning_objective1_idx` (`learning_objective_id` ASC),
  CONSTRAINT `fk_learning_objective_has_ks123_pathway_ks123_pathway1`
    FOREIGN KEY (`ks123_pathway_id`)
    REFERENCES `cssow`.`cs_ks123_pathway` (`id`),
  CONSTRAINT `fk_learning_objective_has_ks123_pathway_learning_objective1`
    FOREIGN KEY (`learning_objective_id`)
    REFERENCES `cssow`.`cs_learning_objective` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

-- ----------------------------------------------------------------------------
-- Table cssow.cs_play_based
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `cssow`.`cs_play_based` (
  `id` INT(11) NOT NULL,
  `name` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

-- ----------------------------------------------------------------------------
-- Table cssow.cs_solo_taxonomy
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `cssow`.`cs_solo_taxonomy` (
  `id` INT(11) NOT NULL,
  `name` VARCHAR(100) NOT NULL,
  `level` CHAR(1) NOT NULL DEFAULT 'A',
  PRIMARY KEY (`id`),
  UNIQUE INDEX `name_UNIQUE` (`name` ASC) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

-- ----------------------------------------------------------------------------
-- Table cssow.cs_subject_purpose
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `cssow`.`cs_subject_purpose` (
  `id` INT(11) NOT NULL,
  `name` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

-- ----------------------------------------------------------------------------
-- Table cssow.cs_topic
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `cssow`.`cs_topic` (
  `id` INT(11) NOT NULL,
  `name` VARCHAR(45) NOT NULL,
  `parent_id` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_topic_topic1_idx` (`parent_id` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

-- ----------------------------------------------------------------------------
-- Table cssow.cs_year
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `cssow`.`cs_year` (
  `id` INT(11) NOT NULL,
  `name` VARCHAR(3) NOT NULL,
  `keystage_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`, `keystage_id`),
  INDEX `fk_year_keystage_idx` (`keystage_id` ASC),
  CONSTRAINT `fk_year_keystage`
    FOREIGN KEY (`keystage_id`)
    REFERENCES `cssow`.`cs_key_stage` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

-- ----------------------------------------------------------------------------
-- View cssow.cs_learning_objectives_by_ks123_pathway_topic
-- ----------------------------------------------------------------------------
USE `cssow`;
CREATE OR REPLACE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `cssow`.`cs_learning_objectives_by_ks123_pathway_topic` AS select `lo`.`id` AS `learning_objective_id`,`lo`.`description` AS `learning_objective_description`,`cssow`.`cs_solo_taxonomy`.`level` AS `solo_level`,`lo`.`topic_id` AS `topic_id`,`cssow`.`cs_topic`.`name` AS `topic_name`,`parent_topic`.`id` AS `parent_topic_id`,`parent_topic`.`name` AS `parent_topic_name`,`path`.`id` AS `path_objective_id`,`path`.`objective` AS `path_objective_description`,`cssow`.`cs_year`.`id` AS `year_id`,`cssow`.`cs_year`.`name` AS `year_name` from (((((`cssow`.`cs_learning_objective` `lo` join `cssow`.`cs_topic` on((`lo`.`topic_id` = `cssow`.`cs_topic`.`id`))) join `cssow`.`cs_topic` `parent_topic` on((`cssow`.`cs_topic`.`parent_id` = `parent_topic`.`id`))) join `cssow`.`cs_ks123_pathway` `path` on((`parent_topic`.`id` = `path`.`topic_id`))) join `cssow`.`cs_year` on((`path`.`year_id` = `cssow`.`cs_year`.`id`))) join `cssow`.`cs_solo_taxonomy` on((`lo`.`solo_taxonomy_id` = `cssow`.`cs_solo_taxonomy`.`id`)));
SET FOREIGN_KEY_CHECKS = 1;
