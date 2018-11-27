<?php

/**
 * @package     Joomla.Administrator
 * @subpackage  com_schemeofwork
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

JFormHelper::loadFieldClass('list');

/**
 * LearningObjectiveHasPathways Form Field class for the SchemeOfWork Admin component
 *
 * @since  0.0.1
 */
class JFormFieldLearningObjectiveHasPathways extends JFormFieldList {

    /**
     * The field type.
     *
     * @var         string
     */
    protected $type = 'LearningObjectiveHasPathways';

    /**
     * Method to get a list of options for a list input.
     *
     * @return  array  An array of JHtml options.
     */
    protected function getOptions() {
        $db = JFactory::getDBO();
        $query = $db->getQuery(true);
        $query->select('lob_pw.id as id, CONCAT_WS(lob.description, pw.objective) as learning_objective_pathway, pw lob.learning_objective_id, lob.ks123_pathway_id');
        $query->from('sow_learning_objective_has_ks123_pathway as lob_pw')
                ->leftJoin('sow_learning_objective as lob on lob.id = lob_pw.learning_objective_id')
                ->leftJoin('sow_ks123_pathway as pw on pw.id = lob_pw.ks123_pathway_id');
        $db->setQuery((string) $query);
        $items = $db->loadObjectList();
        $options = array();

        if ($items) {
            foreach ($items as $item) {
                $options[] = JHtml::_('select.option', $item->id, $item->name);
            }
        }

        $options = array_merge(parent::getOptions(), $options);

        return $options;
    }

}
