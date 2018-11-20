-- ----------------------------------------------------------------------------
-- Table scheme_of_work
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