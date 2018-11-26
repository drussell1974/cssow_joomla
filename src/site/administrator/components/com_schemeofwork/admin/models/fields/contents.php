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
 * Contents Form Field class for the SchemeOfWork Admin component
 *
 * @since  0.0.1
 */
class JFormFieldContents extends JFormFieldList {

    /**
     * The field type.
     *
     * @var         string
     */
    protected $type = 'Contents';

    /**
     * Method to get a list of options for a list input.
     *
     * @return  array  An array of JHtml options.
     */
    protected function getOptions() {
        $db = JFactory::getDBO();
        $query = $db->getQuery(true);
        $query->select('cnt.id as id, cnt.description as description, cnt.letter as letter, cnt.key_stage_id as key_stage_id');
        $query->from('sow_content as cnt');
        //$query->leftJoin('#__categories as cat on cs.catid=cat.id');
        $db->setQuery((string) $query);
        $messages = $db->loadObjectList();
        $options = array();

        if ($items) {
            foreach ($messages as $item) {
                $options[] = JHtml::_('select.option', $item->id, $item->name);
            }
        }

        $options = array_merge(parent::getOptions(), $options);

        return $options;
    }

}
