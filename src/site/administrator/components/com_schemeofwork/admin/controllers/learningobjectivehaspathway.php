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
        $this->saveFormState("step1");
       
        //... then redirect to the same page
        $this->setRedirect(JRoute::_('index.php?option=com_schemeofwork&view=learningobjectivehaspathway&layout=edit', false));
   }
   
   public function wizardNext()
   {   
        $this->saveFormState("step2");
        
        //... then redirect to the same page
        $this->setRedirect(JRoute::_('index.php?option=com_schemeofwork&view=learningobjectivehaspathway&layout=edit&id='.$id, false));
   }
   
   public function cancel($key = null)
    {
        parent::cancel($key);
        
        // Reset for next step
        LearningObjectiveHasPathwayHelper::wizardSetStep("step1");
    }
    
    private function saveFormState($step){
        // Get the selected topic
        $data = $this->input->get('jform', array(), 'array');

        // values for setting options
        $topic_id = $data['topic_id'];
        $year_id = $data['year_id'];
        $solo_taxonomy_id = $data['solo_taxonomy_id'];
        
        
        // get the data from the HTTP POST request
        $app = JFactory::getApplication();
        // set up context for saving form data
        $context = "$this->option.edit.$this->context";
        // Save the form data in the session.
        $app->setUserState($context . '.data', $data);
        
        // Store the topic_id, year_id and solo_taxonomy_id ready for the previous step
        LearningObjectiveHasPathwayHelper::wizardSetStep($step, $topic_id, $year_id, $solo_taxonomy_id);
    }
}
