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
 * LearningObjective Controller
 *
 * @package     Joomla.Administrator
 * @subpackage  com_schemeofwork
 * @since       0.0.9
 */
class SchemeOfWorkControllerLearningObjective extends JControllerForm {
    public function refresh(){
        // Get the selected topic
        $data = $this->input->get('jform', array(), 'array');

        // Store the topic_id, year_id and solo_taxonomy_id ready for the previous step
        FormOptionsHelper::SaveSelectedOption("learningobjective", "keystage", $data['key_stage_id']);

        // get the data from the HTTP POST request
        $app = JFactory::getApplication();
        // set up context for saving form data
        $context = "$this->option.edit.$this->context";
        // Save the form data in the session.
        $app->setUserState($context . '.data', $data);

        //... then redirect to the same page
        $this->setRedirect(JRoute::_('index.php?option=com_schemeofwork&view=learningobjective&layout=edit&id='.$id, false));
    }
   
    public function cancel($key = null)
    {
        parent::cancel($key);

        // Reset for next step
        FormOptionsHelper::SaveSelectedOption("learningobjective", "keystage", null);
    }
}
