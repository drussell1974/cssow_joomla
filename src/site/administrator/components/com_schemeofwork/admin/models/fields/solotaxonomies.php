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
 * SoloTaxonomies Form Field class for the SchemeOfWork Admin component
 *
 * @since  0.0.1
 */
class JFormFieldSoloTaxonomies extends JFormFieldList {

    /**
     * The field type.
     *
     * @var         string
     */
    protected $type = 'SoloTaxonomies';

    /**
     * Method to get a list of options for a list input.
     *
     * @return  array  An array of JHtml options.
     */
    protected function getOptions() {
        $db = JFactory::getDBO();
        $query = $db->getQuery(true);
        $query->select('solo.id as id, solo.name as name, solo.level as level');
        $query->from('sow_solo_taxonomy as solo');
        //$query->leftJoin('#__categories as cat on cs.catid=cat.id');
        
        \JLog::add("getOptions().query:".$query, \JLog::DEBUG, \JText::_('LOG_CATEGORY')); 
            
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
