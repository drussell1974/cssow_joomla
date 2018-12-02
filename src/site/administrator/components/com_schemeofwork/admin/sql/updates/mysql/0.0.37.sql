
SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE sow_learning_objective_has_ks123_pathway;

-- ----------------------------------------------------------------------------
-- Table sow_learning_objective_has_ks123_pathway
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS sow_learning_objective_has_ks123_pathway (
  id INT(11) NOT NULL AUTO_INCREMENT,
  learning_objective_id INT(11) NOT NULL,
  ks123_pathway_id INT(11) NOT NULL,
  comment VARCHAR(500) NULL,
  created      DATETIME        NOT NULL DEFAULT '0000-00-00 00:00:00',
  created_by    INT(10) UNSIGNED NOT NULL DEFAULT '0',
  published     tinyint(4)      NOT NULL DEFAULT '1',
  PRIMARY KEY (id),
  INDEX fk_sow_learning_objective_has_ks123_pathway_ks123_pathway_idx (ks123_pathway_id ASC),
  INDEX fk_learning_objective_has_ks123_pathway_learning_objective_idx (learning_objective_id ASC),
  CONSTRAINT fk_sow_learning_objective_has_ks123_pathway_ks123_pathway1
    FOREIGN KEY (ks123_pathway_id)
    REFERENCES sow_ks123_pathway (id),
  CONSTRAINT fk_sow_learning_objective_has_ks123_pathway_learning_objective1
    FOREIGN KEY (learning_objective_id)
    REFERENCES sow_learning_objective (id))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

ALTER TABLE sow_learning_objective_has_ks123_pathway ADD COLUMN IF NOT EXISTS comment VARCHAR(500) AFTER ks123_pathway_id;
ALTER TABLE sow_schemeofwork DROP COLUMN IF EXISTS comment;
ALTER TABLE sow_schemeofwork ADD COLUMN IF NOT EXISTS sow_learning_objective_has_ks123_pathway_id INT(11) AFTER asset_id;
ALTER TABLE sow_schemeofwork ADD CONSTRAINT sow_schemeofwork__sow_learning_objective_has_ks123_pathway_id
    FOREIGN KEY (sow_learning_objective_has_ks123_pathway_id)
    REFERENCES sow_learning_objective_has_ks123_pathway (id);

SET FOREIGN_KEY_CHECKS = 1;