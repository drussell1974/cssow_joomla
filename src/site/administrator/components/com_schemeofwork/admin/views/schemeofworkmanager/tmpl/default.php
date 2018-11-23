<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_schemeofwork
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted Access');

JHtml::_('formbehavior.chosen', 'select');

?>
<div id="j-sidebar-container" class="span2">
    <?php echo JHtmlSidebar::render(); ?>
</div>
<div id="j-main-container" class="span10">
    <div class="row-fluid">
        <div class="span6">

        </div>
    </div>
    <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th>
                    
                </th>
            </tr>
            </thead>
            <tfoot>
                <tr>
                    <td>

                    </td>
                </tr>
            </tfoot>
            <tbody>

                <tr>
                    <td>
                        <a href="index.php?option=com_schemeofwork&view=keystages" title="<?php echo JText::_('COM_SCHEMEOFWORK_EDIT_KEYSTAGES'); ?>">
                            <?php echo JText::_('COM_SCHEMEOFWORK_EDIT_KEYSTAGES'); ?>
                        </a>
                    </td>
                </tr>
            </tbody>
    </table>
    <input type="hidden" name="task" value=""/>
    <input type="hidden" name="boxchecked" value="0"/>
    <?php echo JHtml::_('form.token'); ?>
</div>