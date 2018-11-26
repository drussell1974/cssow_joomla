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
 * Pathways Model
 *
 * @since  0.0.1
 */
class SchemeOfWorkModelPathways extends JModelList {

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
                'objective',
                'year_id',
                'topic_id',
                'subject_purpose_id',
                'Abstraction',
                'Decomposition',
                'Algorithmic Thinking',
                'Evaluation',
                'Generalisation',
                'author',
                'created',
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
        $query->select('path.id as id, path.objective as objective, path.published as published, path.created as created')
                ->from($db->quoteName('sow_ks123_pathway', 'path'));

        // Join over the year.
        $query->select($db->quoteName('yr.name', 'year_name'))
                ->join('LEFT', $db->quoteName('sow_year', 'yr') . ' ON yr.id = path.year_id');
        
        // Join over the topic.
        $query->select($db->quoteName('top.name', 'topic_name'))
                ->join('LEFT', $db->quoteName('sow_topic', 'top') . ' ON top.id = path.topic_id');
        
        // Join over the subject purpose
        $query->select($db->quoteName('sub.name', 'subject_purpose_name'))
                ->join('LEFT', $db->quoteName('sow_subject_purpose', 'sub') . ' ON sub.id = path.subject_purpose_id');
        
        // Join with users table to get the username of the author
        $query->select($db->quoteName('u.username', 'author'))
                ->join('LEFT', $db->quoteName('#__users', 'u') . ' ON u.id = path.created_by');

        // Filter: like / search
        $search = $this->getState('filter.search');

        if (!empty($search)) {
            $like = $db->quote('%' . $search . '%');
            $query->where('path.objective LIKE ' . $like);
        }

        // Filter by published state
        $published = $this->getState('filter.published');

        if (is_numeric($published)) {
            $query->where('path.published = ' . (int) $published);
        } elseif ($published === '') {
            $query->where('(path.published IN (0, 1))');
        }

        // Add the list ordering clause.
        $orderCol = $this->state->get('list.ordering', 'yr.name');
        $orderDirn = $this->state->get('list.direction', 'asc');

        $query->order($db->escape($orderCol) . ' ' . $db->escape($orderDirn));

        \JLog::add("SchemeOfWorkModelPathway.getListQuery=" . $query, \JLog::DEBUG, \JText::_('LOG_CATEGORY'));

        return $query;
    }

}
