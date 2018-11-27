<?php

/**
 * @package     Joomla.Administrator
 * @subpackage  com_${package_name__lower_case}
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
// No direct access
defined('_JEXEC') or die('Restricted access');

/**
 * ${component_name__camel_case} Table class
 *
 * @since  0.0.1
 */
class SchemeOfWorkTableLearningObjective extends JTable {

    /**
     * Constructor
     *
     * @param   JDatabaseDriver  &$db  A database connector object
     */
    function __construct(&$db) {
        parent::__construct('sow_learning_objective', 'id', $db);
    }

}
