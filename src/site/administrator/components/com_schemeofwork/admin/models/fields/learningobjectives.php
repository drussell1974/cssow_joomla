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
 * LearningObjectives Form Field class for the SchemeOfWork Admin component
 *
 * @since  0.0.1
 */
class JFormFieldLearningObjectives extends JFormFieldList {

    /**
     * The field type.
     *
     * @var         string
     */
    protected $type = 'LearningObjectives';

    /**
     * Method to get a list of options for a list input.
     *
     * @return  array  An array of JHtml options.
     */
    protected function getOptions() {
        $db = JFactory::getDBO();
        $query = $db->getQuery(true);
        
        
        $query->select('lob.id as id, CONCAT(lob.description, \' (\', SUBSTRING_INDEX(solo.name, \':\', 1), \')\') as description');
        $query->from('sow_learning_objective as lob');
        $query->LeftJoin('sow_solo_taxonomy as solo on solo.id = lob.solo_taxonomy_id');
        // filter as neccesary
        $selected_topic_id = LearningObjectiveHasPathwayHelper::wizardGetStep()[1];
        if(!empty($selected_topic_id)){
            $query->LeftJoin('sow_topic as pnt on pnt.id = lob.topic_id');
            $query->where('pnt.parent_id = '. $selected_topic_id . ' OR lob.topic_id = ' . $selected_topic_id);
        }
        $query->order('solo.level ASC');
            
        \JLog::add("JFormFieldLearningObjectives.getOptions.query = ". $query, \JLog::DEBUG, \JText::_('LOG_CATEGORY')); 
        
        $db->setQuery((string) $query);
        
        $items = $db->loadObjectList();
        $options = array();

        if ($items) {
            foreach ($items as $item) {
                $options[] = JHtml::_('select.option', $item->id, $item->description);
            }
        }

        $options = array_merge(parent::getOptions(), $options);

        return $options;
    }

}
