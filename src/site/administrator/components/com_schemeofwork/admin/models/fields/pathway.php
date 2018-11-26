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
class JFormFieldPathways extends JFormFieldList {

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
        $query->select('id,objective');
        $query->from('sow_ks123_pathway');
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
