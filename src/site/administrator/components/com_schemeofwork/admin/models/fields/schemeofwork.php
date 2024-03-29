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
 * SchemeOfWork Form Field class for the Scheme of Work Admin component
 *
 * @since  0.0.1
 */
class JFormFieldSchemeOfWorks extends JFormFieldList
{
	/**
	 * The field type.
	 *
	 * @var         string
	 */
	protected $type = 'SchemeOfWorks';

	/**
	 * Method to get a list of options for a list input.
	 *
	 * @return  array  An array of JHtml options.
	 */
	protected function getOptions()
	{
            $db    = JFactory::getDBO();
            $query = $db->getQuery(true);
            $query->select('sow.id as id, sow.name as name, cat.title as category, sow.catid as catid');
            $query->from('sow_schemeofwork as sow');
            $query->leftJoin('#__categories as cat on sow.catid=cat.id');
            $db->setQuery((string) $query);
            $items = $db->loadObjectList();
            $options  = array();

            if ($items)
            {
                foreach ($schemeofworks as $item)
                {
                    $options[] = JHtml::_('select.option', $item->id, $item->name . 
                            ($item->catid ? ' (' . $item->category . ')' : ''));
                }
            }

            $options = array_merge(parent::getOptions(), $options);

            return $options;
	}
}