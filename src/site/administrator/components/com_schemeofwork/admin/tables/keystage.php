<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_schemeofwork
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
// No direct access
defined('_JEXEC') or die('Restricted access');

/**
 * Hello Table class
 *
 * @since  0.0.1
 */
class SchemeOfWorkTableKeyStage extends JTable
{
    /**
     * Constructor
     *
     * @param   JDatabaseDriver  &$db  A database connector object
     */
    function __construct(&$db)
    {
        \JLog::add("SchemeOfWorkTableKeyStage.__contruct(db)".$db, \JLog::DEBUG, \JText::_('LOG_CATEGORY')); 
        parent::__construct('com_schemeofwork', 'id', $db);
    }
}