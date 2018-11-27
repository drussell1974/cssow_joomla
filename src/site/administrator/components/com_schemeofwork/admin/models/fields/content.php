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
 * SchemeOfWork Form Field class for the SchemeOfWork Admin component
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
        $query->select('cnt.id, cnt.description, cnt.letter, ks.name as key_stage_name, cnt.key_stage_id as key_stage_id');
        $query->from('sow_content cnt');
        $query->leftJoin('sow_key_stage ks on sow_content.key_stage_id = sow_key_stage.id');
        // Retrieve only published items
	$query->where('sow_content.published = 1');
        $db->setQuery((string) $query);
        $items = $db->loadObjectList();
        $options = array();

        if ($items) {
            foreach ($items as $item) {
                $options[] = JHtml::_('select.option', $item->id, $item->description .
                        ($item->key_stage_id ? ' (' . $item->name . ')' : ''));
            }
        }

        $options = array_merge(parent::getOptions(), $options);

        return $options;
    }

}
