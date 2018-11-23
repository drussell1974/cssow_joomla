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
 * SchemeOfWork View
 *
 * @since  0.0.1
 */
class SchemeOfWorkViewSchemeOfWork extends JViewLegacy
{
	/**
	 * View form
	 *
	 * @var         form
	 */
	protected $form;
	protected $item;
	protected $script;
	protected $canDo;
        
	/**
	 * Display the Scheme of Work  view
	 *
	 * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
	 *
	 * @return  void
	 */
	public function display($tpl = null)
	{
            // Get the Data
            $this->form = $this->get('Form');
            $this->item = $this->get('Item');
            $this->script = $this->get('Script');
                
            // What Access Permissions does this user have? What can (s)he do?
            $this->canDo = JHelperContent::getActions('com_schemeofwork', 'schemeofwork', $this->item->id);

            // Check for errors.
            if (count($errors = $this->get('Errors')))
            {
                throw new Exception(implode("\n", $errors), 500);
            }

            // Set the toolbar
            $this->addToolBar();

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
            $input = JFactory::getApplication()->input;

            // Hide Joomla Administrator Main menu
            $input->set('hidemainmenu', true);

            $isNew = ($this->item->id == 0);
            
            JToolBarHelper::title($isNew ? JText::_('COM_SCHEMEOFWORK_SCHEMEOFWORK_MANAGER_NEW')
		                             : JText::_('COM_SCHEMEOFWORK_SCHEMEOFWORK_MANAGER_EDIT'), 'schemeofwork');
            
            // Build the actions for new and existing records.
            if ($isNew)
            {
                // For new records, check the create permission.
                if ($this->canDo->get('core.create')) 
                {
                    JToolBarHelper::apply('schemeofwork.apply', 'JTOOLBAR_APPLY');
                    JToolBarHelper::save('schemeofwork.save', 'JTOOLBAR_SAVE');
                    JToolBarHelper::custom('schemeofwork.save2new', 'save-new.png', 'save-new_f2.png',
                                           'JTOOLBAR_SAVE_AND_NEW', false);
                }
                JToolBarHelper::cancel('schemeofwork.cancel', 'JTOOLBAR_CANCEL');
            }
            else
            {
                if ($this->canDo->get('core.edit'))
                {
                    // We can save the new record
                    JToolBarHelper::apply('schemeofwork.apply', 'JTOOLBAR_APPLY');
                    JToolBarHelper::save('schemeofwork.save', 'JTOOLBAR_SAVE');

                    // We can save this record, but check the create permission to see
                    // if we can return to make a new one.
                    if ($this->canDo->get('core.create')) 
                    {
                        JToolBarHelper::custom('schemeofwork.save2new', 'save-new.png', 'save-new_f2.png',
                                                'JTOOLBAR_SAVE_AND_NEW', false);
                    }
                }
                if ($this->canDo->get('core.create')) 
                {
                        JToolBarHelper::custom('schemeofwork.save2copy', 'save-copy.png', 'save-copy_f2.png',
                                               'JTOOLBAR_SAVE_AS_COPY', false);
                }
                JToolBarHelper::cancel('schemeofwork.cancel', 'JTOOLBAR_CLOSE');
            }
	}
        
        /**
	 * Method to set up the document properties
	 *
	 * @return void
	 */
	protected function setDocument() 
	{
            $isNew = ($this->item->id < 1);
            $document = JFactory::getDocument();
            $document->setTitle($isNew ? JText::_('COM_SCHEMEOFWORK_SCHEMEOFWORK_CREATING') :
            JText::_('COM_SCHEMEOFWORK_SCHEMEOFWORK_EDITING'));
            $document->addScript(JURI::root() . $this->script);
            $document->addScript(JURI::root() . "/administrator/components/com_schemeofwork"
                                              . "/views/schemeofwork/submitbutton.js");
            JText::script('COM_SCHEMEOFWORK_SCHEMEOFWORK_ERROR_UNACCEPTABLE');
	}
}