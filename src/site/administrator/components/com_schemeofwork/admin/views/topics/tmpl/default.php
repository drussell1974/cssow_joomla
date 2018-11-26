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
<form action="index.php?option=com_schemeofwork&view=topics" method="post" id="adminForm" name="adminForm">
    <div id="j-sidebar-container" class="span2">
        <?php echo JHtmlSidebar::render(); ?>
    </div>
    <div id="j-main-container" class="span10">   
        <div class="row-fluid">
            <div class="span6">
                <?php echo JText::_('COM_SCHEMEOFWORK_TOPIC_FILTER'); ?>
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
                        <?php echo JHtml::_('searchtools.sort', 'COM_SCHEMEOFWORK_TOPIC_NAME', 'name', $listDirn, $listOrder); ?>
                    </th>
                    <th width="30%">
                        <?php echo JHtml::_('searchtools.sort', 'COM_SCHEMEOFWORK_TOPIC_AUTHOR', 'author', $listDirn, $listOrder); ?>
                    </th>
                    <th width="30%">
                        <?php echo JHtml::_('searchtools.sort', 'COM_SCHEMEOFWORK_TOPIC_CREATED_DATE', 'created', $listDirn, $listOrder); ?>
                    </th>
                    <th width="5%">
                        <?php echo JHtml::_('searchtools.sort', 'COM_SCHEMEOFWORK_TOPIC_PUBLISHED', 'published', $listDirn, $listOrder); ?>
                    </th>
                    <th width="2%">
                        <?php echo JHtml::_('searchtools.sort', 'COM_SCHEMEOFWORK_TOPIC_ID', 'id', $listDirn, $listOrder); ?>
                    </th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <td colspan="5">
                        <?php echo $this->pagination->getListFooter(); ?>
                    </td>
                </tr>
            </tfoot>
            <tbody>
<?php if (!empty($this->items)) : ?>
                    <?php
                    foreach ($this->items as $i => $row) :
                        $link = JRoute::_('index.php?option=com_schemeofwork&task=topic.edit&id=' . $row->id);
                        ?>
                        <tr>
                            <td><?php echo $this->pagination->getRowOffset($i); ?></td>
                            <td>
                                <?php echo JHtml::_('grid.id', $i, $row->id); ?>
                            </td>
                            <td>
                                <a href="<?php echo $link; ?>" title="<?php echo JText::_('COM_SCHEMEOFWORK_TOPIC_EDIT'); ?>">
                                    <?php echo $row->name; ?>
                                </a>
                                <div class="small">
                                    <?php echo JText::_('COM_SCHEMEOFWORK_TOPIC_HEADING_PARENT') . ': ' . $this->escape($row->parent_name); ?>
                                </div>
                            </td>
                            <td align="center">
                                <?php echo $row->author; ?>
                            </td>
                            <td align="center">
                                <?php echo substr($row->created, 0, 10); ?>
                            </td>
                            <td align="center">
                                <?php echo JHtml::_('jgrid.published', $row->published, $i, 'topics.', true, 'cb'); ?>
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