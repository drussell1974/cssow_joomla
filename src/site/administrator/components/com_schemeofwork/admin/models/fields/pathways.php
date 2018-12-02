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

JFormHelper::loadFieldClass('radio');

/**
 * Pathways Form Field class for the SchemeOfWork Admin component
 *
 * @since  0.0.1
 */
class JFormFieldPathways extends JFormFieldRadio {

    /**
     * The field type.
     *
     * @var         string
     */
    protected $type = 'Pathways';

    /**
     * Method to get a list of options for a list input.
     *
     * @return  array  An array of JHtml options.
     */
    protected function getOptions() {
        $db = JFactory::getDBO();
        $query = $db->getQuery(true);
        $query->select('DISTINCT path.id as id, path.objective as objective');
        $query->from('sow_ks123_pathway as path');
        
        // filter as neccesary
        
        
        // ... by topic
        $selected_topic_id = FormOptionsHelper::GetSelectedOption("learningobjectivehaspathway", "topic");
                
        if(!empty($selected_topic_id)){
            $query->LeftJoin('sow_topic as top on top.id = path.topic_id');
            $query->LeftJoin('sow_topic as rtop on rtop.parent_id = top.id');
            $query->where('(path.topic_id = '. $selected_topic_id . ' OR rtop.id = '. $selected_topic_id . ')');
        }
        
        //... by year
        $selected_year_id = FormOptionsHelper::GetSelectedOption("learningobjectivehaspathway", "year");
        
        if(!empty($selected_year_id)){
            $query->where('path.year_id = '. $selected_year_id);
        }
        
        \JLog::add("JFormFieldPathways.getOptions().query = ". $query, \JLog::DEBUG, \JText::_('LOG_CATEGORY')); 
        
        $db->setQuery((string) $query);
        $items = $db->loadObjectList();
        $options = array();

        if ($items) {
            foreach ($items as $item) {
                $options[] = JHtml::_('select.option', $item->id, $item->objective);
            }
        }

        $options = array_merge(parent::getOptions(), $options);

        return $options;
    }

}
