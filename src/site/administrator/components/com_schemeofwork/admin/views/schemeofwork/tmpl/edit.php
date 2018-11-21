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
JHtml::_('behavior.formvalidator');

// The following is to enable setting the permission's Calculated Setting 
// when you change the permission's Setting. 
// The core javascript code for initiating the Ajax request looks for a field
// with id="jform_title" and sets its value as the 'title' parameter to send in the Ajax request
JFactory::getDocument()->addScriptDeclaration('
	jQuery(document).ready(function() {
        schemeofwork = jQuery("#jform_schemeofwork").val();
		jQuery("#jform_title").val(schemeofwork);
	});
');

?>
<form action="<?php echo JRoute::_('index.php?option=com_schemeofwork&layout=edit&id=' . (int) $this->item->id); ?>"
    method="post" name="adminForm" id="adminForm" class="form-validate">
    <input id="jform_title" type="hidden" name="schemeofwork-message-title"/>
    
    <div class="form-horizontal">
        <?php echo JHtml::_('bootstrap.startTabSet', 'myTab', array('active' => 'details')); ?>
        <?php echo JHtml::_('bootstrap.addTab', 'myTab', 'details', 
            empty($this->item->id) ? JText::_('COM_SCHEMEOFWORK_TAB_NEW_MESSAGE') : JText::_('COM_SCHEMEOFWORK_TAB_EDIT_MESSAGE')); ?>
            <fieldset class="adminform">
                <legend><?php echo JText::_('COM_SCHEMEOFWORK_LEGEND_DETAILS') ?></legend>
                <div class="row-fluid">
                    <div class="span6">
                        <?php echo $this->form->renderFieldset('details');  ?>
                    </div>
                </div>
            </fieldset>
        <?php echo JHtml::_('bootstrap.endTab'); ?>

        <?php echo JHtml::_('bootstrap.addTab', 'myTab', 'params', JText::_('COM_SCHEMEOFWORK_TAB_PARAMS')); ?>
            <fieldset class="adminform">
                <legend><?php echo JText::_('COM_SCHEMEOFWORK_LEGEND_PARAMS') ?></legend>
                <div class="row-fluid">
                    <div class="span6">
                        <?php echo $this->form->renderFieldset('params');  ?>
                    </div>
                </div>
            </fieldset>
        <?php echo JHtml::_('bootstrap.endTab'); ?>

        <?php echo JHtml::_('bootstrap.addTab', 'myTab', 'permissions', JText::_('COM_SCHEMEOFWORK_TAB_PERMISSIONS')); ?>
            <fieldset class="adminform">
                <legend><?php echo JText::_('COM_SCHEMEOFWORK_LEGEND_PERMISSIONS') ?></legend>
                <div class="row-fluid">
                    <div class="span12">
                        <?php echo $this->form->renderFieldset('accesscontrol');  ?>
                    </div>
                </div>
            </fieldset>
        <?php echo JHtml::_('bootstrap.endTab'); ?>
        <?php echo JHtml::_('bootstrap.endTabSet'); ?>
    </div>
    <input type="hidden" name="task" value="schemeofwork.edit" />
    <?php echo JHtml::_('form.token'); ?>
</form>