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
 * LearningObjectiveHasPathway Controller
 *
 * @package     Joomla.Administrator
 * @subpackage  com_schemeofwork
 * @since       0.0.9
 */

class SchemeOfWorkControllerLearningObjectiveHasPathway extends JControllerForm {
   
   public function wizardPrev()
   {
        // Get the selected topic
        $data = $this->input->get('jform', array(), 'array');
        $id = $date['id'];
        $topic_id = $data['topic_id'];
        
        LearningObjectiveHasPathwayHelper::wizardSetStep("step1");
       
        //... then redirect to the same page
        $this->setRedirect(JRoute::_('index.php?option=com_schemeofwork&view=learningobjectivehaspathway&layout=edit', false));
   }
   
   public function wizardNext()
   {   
        // Get the selected topic
        $data = $this->input->get('jform', array(), 'array');
        $id = $data['id'];
        $topic_id = $data['topic_id'];
        
        // get the data from the HTTP POST request
        $app = JFactory::getApplication();
        // set up context for saving form data
        $context = "$this->option.edit.$this->context";
        // Save the form data in the session.
        $app->setUserState($context . '.data', $data);
        
        // Store the topic_id ready for the next step
        LearningObjectiveHasPathwayHelper::wizardSetStep("step2", $topic_id);
        
        //... then redirect to the same page
        $this->setRedirect(JRoute::_('index.php?option=com_schemeofwork&view=learningobjectivehaspathway&layout=edit&id='.$id, false));
   }
   
   public function cancel($key = null)
    {
        parent::cancel($key);
        
        // Reset for next step
        LearningObjectiveHasPathwayHelper::wizardSetStep("step1");
    }
}
