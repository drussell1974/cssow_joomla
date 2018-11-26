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
 * Year View
 *
 * @since  0.0.1
 */
class SchemeOfWorkViewYears extends JViewLegacy {

    /**
     * Display the SchemeOfWorks view
     *
     * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
     *
     * @return  void
     */
    function display($tpl = null) {
        // Get application
        $app = JFactory::getApplication();
        $context = "schemeofwork.list.admin.schemeofwork";
        // Get data from the model
        $this->items = $this->get('Items');
        $this->pagination = $this->get('Pagination');
        $this->state = $this->get('State');
        $this->filter_order = $app->getUserStateFromRequest($context . 'filter_order', 'filter_order', 'name', 'cmd');
        $this->filter_order_Dir = $app->getUserStateFromRequest($context . 'filter_order_Dir', 'filter_order_Dir', 'asc', 'cmd');
        $this->filterForm = $this->get('FilterForm');
        $this->activeFilters = $this->get('ActiveFilters');
        // What Access Permissions does this user have? What can (s)he do?
        //$this->canDo = JHelperContent::getActions('com_schemeofwork');
        // Check for errors.
        $errors = $this->get('Errors');

        if (empty($errors) === 1) {
            \JLog::add("Errors:" . $errors, \JLog::DEBUG, \JText::_('LOG_CATEGORY'));
            throw new Exception(implode("\n", $errors), 500);

            return false;
        }

        // Set the submenu
        SchemeOfWorkHelper::addSubmenu('schemeofworks');

        // Set the toolbar and number of found items
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
    protected function addToolBar() {
        $title = JText::_('COM_SCHEMEOFWORK_YEAR_MANAGER');

        if ($this->pagination->total) {
            $title .= "<span style='font-size: 0.5em; vertical-align: middle;'>(" . $this->pagination->total . ")</span>";
        }

        JToolBarHelper::title($title, 'schemeofwork');
        //if ($this->canDo->get('core.create')) 
        //{
        JToolbarHelper::addNew('year.add');
        //}
        //if ($this->canDo->get('core.edit')) 
        //{
        JToolbarHelper::editList('year.edit');
        //}
        //if ($this->canDo->get('core.delete')) 
        //{
        JToolbarHelper::deleteList('', 'years.delete');
        //}
        //if ($this->canDo->get('core.admin')) 
        //{
        JToolBarHelper::divider();
        JToolBarHelper::preferences('com_schemeofwork');
        //}
    }

    /**
     * Method to set up the document properties
     *
     * @return void
     */
    protected function setDocument() {
        $document = JFactory::getDocument();
        $document->setTitle(JText::_('COM_SCHEMEOFWORK_ADMINISTRATION'));
    }

}
