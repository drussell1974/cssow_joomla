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
 * KeyStages Form Field class for the Scheme of Work Admin component
 *
 * @since  0.0.1
 */
class JFormFieldKeyStages extends JFormFieldList
{
	/**
	 * The field type.
	 *
	 * @var         string
	 */
	protected $type = 'KeyStages';

	/**
	 * Method to get a list of options for a list input.
	 *
	 * @return  array  An array of JHtml options.
	 */
	protected function getOptions()
	{
            $db    = JFactory::getDBO();
            $query = $db->getQuery(true);
            $query->select('ks.id as id, ks.name as name, cat.title as category, ks.catid as catid');
            $query->from('sow_key_stage as ks');
            $query->leftJoin('#__categories as cat on ks.catid=cat.id');
            $db->setQuery((string) $query);
            $messages = $db->loadObjectList();
            $options  = array();

            if ($messages)
            {
                foreach ($messages as $message)
                {
                    $options[] = JHtml::_('select.option', $message->id, $message->name . 
                            ($message->catid ? ' (' . $message->category . ')' : ''));
                }
            }

            $options = array_merge(parent::getOptions(), $options);

            return $options;
	}
}