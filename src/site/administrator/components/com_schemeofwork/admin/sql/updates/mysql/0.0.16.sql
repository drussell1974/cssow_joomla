CREATE OR REPLACE 
	VIEW `sow_learning_objectives_by_ks123_pathway_topic` 
AS 
	SELECT 
    `lo`.`id` AS `learning_objective_id`,
    `lo`.`description` AS `learning_objective_description`,
    `cssow`.`sow_solo_taxonomy`.`level` AS `solo_level`,
    `lo`.`topic_id` AS `topic_id`,
    `cssow`.`sow_topic`.`name` AS `topic_name`,
    `parent_topic`.`id` AS `parent_topic_id`,
    `parent_topic`.`name` AS `parent_topic_name`,
    `path`.`id` AS `path_objective_id`,
    `path`.`objective` AS `path_objective_description`,
    `cssow`.`sow_year`.`id` AS `year_id`,
    `cssow`.`sow_year`.`name` AS `year_name`
FROM
    (((((`cssow`.`sow_learning_objective` `lo`
    JOIN `cssow`.`sow_topic` ON ((`lo`.`topic_id` = `cssow`.`sow_topic`.`id`)))
    JOIN `cssow`.`sow_topic` `parent_topic` ON ((`cssow`.`sow_topic`.`parent_id` = `parent_topic`.`id`)))
    JOIN `cssow`.`sow_ks123_pathway` `path` ON ((`parent_topic`.`id` = `path`.`topic_id`)))
    JOIN `cssow`.`sow_year` ON ((`path`.`year_id` = `cssow`.`sow_year`.`id`)))
    JOIN `cssow`.`sow_solo_taxonomy` ON ((`lo`.`solo_taxonomy_id` = `cssow`.`sow_solo_taxonomy`.`id`)));
SET FOREIGN_KEY_CHECKS = 1;
