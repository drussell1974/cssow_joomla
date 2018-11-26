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

$listOrder = $this->escape($this->state->get('list.ordering'));
$listDirn = $this->escape($this->state->get('list.direction'));
?>
<form action="index.php?option=com_schemeofwork&view=contents" method="post" id="adminForm" name="adminForm">
    <div id="j-sidebar-container" class="span2">
        <?php echo JHtmlSidebar::render(); ?>
    </div>
    <div id="j-main-container" class="span10">   
        <div class="row-fluid">
            <div class="span6">
                <?php echo JText::_('COM_SCHEMEOFWORK_CONTENT_FILTER'); ?>
                <?php
                echo JLayoutHelper::render(
                        'joomla.searchtools.default', array('view' => $this)
                );
                ?>
            </div>
        </div>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th width="1%"><?php echo JText::_('COM_SCHEMEOFWORK_SCHEMEOFWORK_NUM'); ?></th>
                    <th width="2%">
<?php echo JHtml::_('grid.checkall'); ?>
                    </th>
                    <th width="30%">
<?php echo JHtml::_('searchtools.sort', 'COM_SCHEMEOFWORK_CONTENT_DESCRIPTION', 'description', $listDirn, $listOrder); ?>
                    </th>
                    <th width="30%">
<?php echo JHtml::_('searchtools.sort', 'COM_SCHEMEOFWORK_CONTENT_LETTER', 'letter', $listDirn, $listOrder); ?>
                    </th>
                    <th width="30%">
<?php echo JHtml::_('searchtools.sort', 'COM_SCHEMEOFWORK_CONTENT_AUTHOR', 'author', $listDirn, $listOrder); ?>
                    </th>
                    <th width="30%">
<?php echo JHtml::_('searchtools.sort', 'COM_SCHEMEOFWORK_CONTENT_CREATED_DATE', 'created', $listDirn, $listOrder); ?>
                    </th>
                    <th width="5%">
<?php echo JHtml::_('searchtools.sort', 'COM_SCHEMEOFWORK_CONTENT_PUBLISHED', 'published', $listDirn, $listOrder); ?>
                    </th>
                    <th width="2%">
<?php echo JHtml::_('searchtools.sort', 'COM_SCHEMEOFWORK_CONTENT_ID', 'id', $listDirn, $listOrder); ?>
                    </th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <td colspan="6">
<?php echo $this->pagination->getListFooter(); ?>
                    </td>
                </tr>
            </tfoot>
            <tbody>
<?php if (!empty($this->items)) : ?>
                    <?php
                    foreach ($this->items as $i => $row) :
                        $link = JRoute::_('index.php?option=com_schemeofwork&task=content.edit&id=' . $row->id);
                        ?>
                        <tr>
                            <td><?php echo $this->pagination->getRowOffset($i); ?></td>
                            <td>
                                <?php echo JHtml::_('grid.id', $i, $row->id); ?>
                            </td>
                            <td>
                                <a href="<?php echo $link; ?>" title="<?php echo JText::_('COM_SCHEMEOFWORK_CONTENT_EDIT'); ?>">
                                    <?php echo $row->description; ?>
                                </a>
                            </td>
                            <td align="center">
                                <?php echo $row->letter; ?>
                            </td>
                            <td align="center">
                                <?php echo $row->author; ?>
                            </td>
                            <td align="center">
                                <?php echo substr($row->created, 0, 10); ?>
                            </td>
                            <td align="center">
                                <?php echo JHtml::_('jgrid.published', $row->published, $i, 'contents.', true, 'cb'); ?>
                            </td>
                            <td align="center">
                                <?php echo $row->id; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
        <input type="hidden" name="task" value=""/>
        <input type="hidden" name="boxchecked" value="0"/>
        <?php echo JHtml::_('form.token'); ?>
    </div>
</form>