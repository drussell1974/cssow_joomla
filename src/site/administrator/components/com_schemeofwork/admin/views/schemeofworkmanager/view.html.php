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

/**
 * SchemeOfWorks View
 *
 * @since  0.0.1
 */
class SchemeOfWorkViewSchemeOfWorkManager extends JViewLegacy
{
	/**
	 * Display the Scheme of Works view
	 *
	 * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
	 *
	 * @return  void
	 */
	function display($tpl = null)
	{
            // Display the template
            parent::display($tpl);

            // Set the document
            $this->setDocument();
	}

	/**
	 * Add the page title and toolbar.
	 *
	 * @return  void
	 *
	 * @since   1.6
	 */
	protected function addToolBar()
	{
            $title = JText::_('COM_SCHEMEOFWORK_SCHEMEOFWORKS_MANAGER');

            if ($this->pagination->total)
            {
                    $title .= "<span style='font-size: 0.5em; vertical-align: middle;'>(" . $this->pagination->total . ")</span>";
            }

            JToolBarHelper::title($title, 'schemeofwork');
            if ($this->canDo->get('core.create')) 
            {
                JToolbarHelper::addNew('schemeofwork.add');
            }
            if ($this->canDo->get('core.edit')) 
            {
                JToolbarHelper::editList('schemeofwork.edit');
            }
            if ($this->canDo->get('core.delete')) 
            {
               JToolbarHelper::deleteList('', 'schemeofworks.delete');
            }
            if ($this->canDo->get('core.admin')) 
            {
                JToolBarHelper::divider();
                JToolBarHelper::preferences('com_schemeofwork');
            }
	}
	/**
	 * Method to set up the document properties
	 *
	 * @return void
	 */
	protected function setDocument() 
	{
            $document = JFactory::getDocument();
            $document->setTitle(JText::_('COM_SCHEMEOFWORK_ADMINISTRATION'));
	}
}