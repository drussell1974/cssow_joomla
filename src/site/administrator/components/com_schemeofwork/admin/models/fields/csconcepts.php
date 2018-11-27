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
 * CSConcepts Form Field class for the Scheme of Work Admin component
 *
 * @since  0.0.1
 */
class JFormFieldCSConcepts extends JFormFieldList
{
	/**
	 * The field type.
	 *
	 * @var         string
	 */
	protected $type = 'CSConcepts';

	/**
	 * Method to get a list of options for a list input.
	 *
	 * @return  array  An array of JHtml options.
	 */
	protected function getOptions()
	{
            $db    = JFactory::getDBO();
            $query = $db->getQuery(true);
            $query->select('con.id as id, con.name as name, con.abbr as abbreviation');
            $query->from('sow_cs_concept as con');
            //$query->leftJoin('#__categories as cat on cs.catid=cat.id');
        
            \JLog::add("query:".$query, \JLog::DEBUG, \JText::_('LOG_CATEGORY')); 
            $db->setQuery((string) $query);
            $items = $db->loadObjectList();
            $options  = array();

            if ($items)
            {
                foreach ($items as $item)
                {
                    $options[] = JHtml::_('select.option', $item->id, $item->name);
                }
            }

            $options = array_merge(parent::getOptions(), $options);

            return $options;
	}
}