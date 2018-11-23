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
<table class="table table-striped table-hover">
    <thead>
    <tr>
        <th width="90%">
                <?php echo JText::_('COM_SCHEMEOFWORK_ADMINISTRATION'); ?>
        </th>
    </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <a href="<?php JRoute::_('index.php?option=com_schemeofwork&view=keystages'); ?>" title="<?php echo JText::_('COM_SCHEMEOFWORK_MANAGER_KEYSTAGES'); ?>">
                    <?php echo JText::_('COM_SCHEMEOFWORK_MANAGER_KEYSTAGES'); ?>
                </a>
            </td>
        </tr>
    </tbody>
</table>
<?php echo JHtml::_('form.token'); ?>