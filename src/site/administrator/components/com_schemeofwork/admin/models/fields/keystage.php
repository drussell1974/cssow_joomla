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
class JFormFieldKeyStages extends JFormFieldList
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
            $query->select('id,name');
            $query->from('sow_key_stage');
            $db->setQuery((string) $query);
            $keystages = $db->loadObjectList();
            $options  = array();

            if ($keystages)
            {
                foreach ($keystages as $keystage)
                {
                    $options[] = JHtml::_('select.option', $keystage->id, $keystage->KeyStageName);
                }
            }

            $options = array_merge(parent::getOptions(), $options);

            return $options;
	}
}