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
 * Form Rule class for the Joomla Framework.
 */
class JFormRuleLearningObjectiveHasPathwayName extends JFormRule {

    /**
     * The regular expression.
     *
     * @access	protected
     * @var		string
     * @since	2.5
     */
    // 1 - 3 alphanumeric characters
    protected $regex = '^[a-zA-Z0-9 ,.]{1,1000}$';

}
