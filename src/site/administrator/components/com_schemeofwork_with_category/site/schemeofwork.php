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

JLog::addLogger(
        array(
             // Sets file name
             'text_file' => JText::_('LOG_FILENAME')
        ),
            // Sets messages of all log levels to be sent to the file
        JLog::ALL,
            // The log category/categories which should be recorded in this file
            // In this case, it's just the one category from our extension, still
            // we need to put it inside an array
        array(JText::_('LOG_CATEGORY'))
    );      

// Get an instance of the controller prefixed by SchemeOfWork
$controller = JControllerLegacy::getInstance('schemeofwork');

// Perform the Request task
$input = JFactory::getApplication()->input; 

$controller->execute($input->getCmd('task'));

// Redirect if set by the controller
$controller->redirect();
