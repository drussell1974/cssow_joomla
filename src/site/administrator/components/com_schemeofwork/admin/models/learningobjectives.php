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
 * LearningObjectives Model
 *
 * @since  0.0.1
 */
class SchemeOfWorkModelLearningObjectives extends JModelList {

    /**
     * Constructor.
     *
     * @param   array  $config  An optional associative array of configuration settings.
     *
     * @see     JController
     * @since   1.6
     */
    public function __construct($config = array()) {
        if (empty($config['filter_fields'])) {
            /* Add db table fields here to be filtered */

            $config['filter_fields'] = array(
                'id',
                'description',
                'solo_taxonomy_name',
                'solo_taxonomy_level',
                'parent_topic_name',
                'topic_name',
                'key_stage_name',
                'published'
            );
        }

        parent::__construct($config);
    }

    /**
     * Method to build an SQL query to load the list data.
     *
     * @return      string  An SQL query
     */
    protected function getListQuery() {
        // Initialize variables.
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);

        // Create the base select statement.
        $query->select('lob.id as id, lob.description as description, lob.published as published, lob.created as created ')
                ->from('sow_learning_objective as lob');

        // Join over the topics.
        $query->select('top.name as topic_name')
                ->join('LEFT', 'sow_topic as top' . ' ON top.id = lob.topic_id ');
        
        // Join over the topics.
        $query->select('pnt_top.name as parent_topic_name')
                ->join('LEFT', 'sow_topic as pnt_top' . ' ON pnt_top.id = top.parent_id ');
        
        // Join over the solo taxonomies.
        $query->select('solo.name as solo_taxonomy_name, solo.level as solo_taxonomy_level ')
                ->join('LEFT', 'sow_solo_taxonomy as solo' . ' ON solo.id = lob.solo_taxonomy_id');
        
        // Join over the content.
        $query->select('cnt.description as content_description ')
                ->join('LEFT', 'sow_content as cnt' . ' ON cnt.id = lob.content_id');
        
        // Join over the content.
        $query->select('ks.name as key_stage_name ')
                ->join('LEFT', 'sow_key_stage as ks' . ' ON ks.id = cnt.key_stage_id');

        // Join over the exam board.
        $query->select('exam.name as exam_board_name ')
                ->join('LEFT', 'sow_exam_board as exam' . ' ON exam.id = lob.exam_board_id');

        // Join with users table to get the username of the author
        $query->select('u.username as author')
                ->join('LEFT', $db->quoteName('#__users', 'u') . ' ON u.id = lob.created_by ');

        // Filter: like / search
        $search = $this->getState('filter.search');

        if (!empty($search)) {
            $like = $db->quote('%' . $search . '%');
            $query->where('lob.description LIKE ' . $like);
        }

        // Filter by published state
        $published = $this->getState('filter.published');

        if (is_numeric($published)) {
            $query->where('lob.published = ' . (int) $published);
        } elseif ($published === '') {
            $query->where('(lob.published IN (0, 1))');
        }

        // Add the list ordering clause.
        $orderCol = $this->state->get('list.ordering', 'lob.description');
        $orderDirn = $this->state->get('list.direction', 'asc');

        $query->order($db->escape($orderCol) . ' ' . $db->escape($orderDirn));

        \JLog::add("SchemeOfWorkModelLearningObjectives.getListQuery=" . $query, \JLog::DEBUG, \JText::_('LOG_CATEGORY'));

        return $query;
    }

}
