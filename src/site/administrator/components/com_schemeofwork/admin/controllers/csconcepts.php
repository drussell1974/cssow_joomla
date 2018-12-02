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
 * SchemeOfWork Controller
 *
 * @since  0.0.1
 */
class SchemeOfWorkControllerCSConcepts extends JControllerAdmin
{
    /**
     * Proxy for getModel.
     *
     * @param   string  $name    The model name. Optional.
     * @param   string  $prefix  The class prefix. Optional.
     * @param   array   $config  Configuration array for model. Optional.
     *
     * @return  object  The model.
     *
     * @since   1.6
     */
    public function getModel($name = 'CSConcepts', $prefix = 'SchemeOfWorkModel', $config = array('ignore_request' => true))
    {
        $model = parent::getModel($name, $prefix, $config);

        return $model;
    }

    public function delete(){
        $input = JFactory::getApplication()->input;
        $recs = $input->get('cid', array(), 'array');
        $nrecs = $input->get('boxchecked', 0 , 'int');
        $model = $this->getModel('CSConcept', 'SchemeOfWorkModel');
        $model->delete($recs);
        $msg = JText::sprintf('COM_SCHEMEOFWORK_CSCONCEPT_N_ITEMS_DELETED' ,$nrecs);
        //... then redirect to the same page
        
        $this->setRedirect(JRoute::_('index.php?option=com_schemeofwork&view=csconcepts', false), $msg);
    }
}
