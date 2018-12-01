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
 * Topics Form Field class for the SchemeOfWork Admin component
 *
 * @since  0.0.1
 */
class JFormFieldTopics extends JFormFieldList {

    /**
     * The field type.
     *
     * @var         string
     */
    protected $type = 'Topics';

    /**
     * Method to get a list of options for a list input.
     *
     * @return  array  An array of JHtml options.
     */
    protected function getOptions() {
        $db = JFactory::getDBO();
        $query = $db->getQuery(true);
        $query->select('top.id as id, CONCAT_WS(\' - \', top.name, pnt.name) as name');
        $query->from('sow_topic as top');
        $query->LeftJoin('sow_topic as pnt on pnt.id = top.parent_id');
        $query->order('top.name ASC');
        
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
