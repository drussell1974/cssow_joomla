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
 * Years Form Field class for the SchemeOfWork Admin component
 *
 * @since  0.0.1
 */
class JFormFieldYears extends JFormFieldList {

    /**
     * The field type.
     *
     * @var         string
     */
    protected $type = 'Years';

    /**
     * Method to get a list of options for a list input.
     *
     * @return  array  An array of JHtml options.
     */
    protected function getOptions() {
        $db = JFactory::getDBO();
        $query = $db->getQuery(true);
        $query->select('yr.id as id, yr.name as name, sow_key_stage.name as key_stage_name, sow_content.key_stage_id as key_stage_id');
        $query->from('sow_year as yr');
        //$query->leftJoin('sow_key_stage as ks on yr.key_stage_id = ks.id');
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
