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
 * LearningObjectiveHasPathways Model
 *
 * @since  0.0.1
 */
class SchemeOfWorkModelLearningObjectiveHasPathways extends JModelList {

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
                'learning_objective_id',
                'ks123_pathway_id',
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
        $query->select('lob_pw.id as id, lob_pw.learning_objective_id, lob_pw.ks123_pathway_id, lob_pw.published as published, lob_pw.created as created')
                ->from($db->quoteName('sow_learning_objective_has_ks123_pathway', 'lob_pw'));
        
        // Join over the learning objective.
        $query->select('lob.description as learning_objective_description')
                ->join('LEFT', 'sow_learning_objective as lob' . ' ON lob.id = lob_pw.learning_objective_id ');
        
        // Join over the pathway.
        $query->select('pw.objective as pathway_objective')
                ->join('LEFT', 'sow_ks123_pathway as pw' . ' ON pw.id = lob_pw.ks123_pathway_id ');

        // Join with users table to get the username of the author
        $query->select($db->quoteName('u.username', 'author'))
                ->join('LEFT', $db->quoteName('#__users', 'u') . ' ON u.id = lob_pw.created_by');

        // Filter: like / search
        $search = $this->getState('filter.search');

        if (!empty($search)) {
            $like = $db->quote('%' . $search . '%');
            $query->where('lob_pw.name LIKE ' . $like);
        }

        // Filter by published state
        $published = $this->getState('filter.published');

        if (is_numeric($published)) {
            $query->where('lob_pw.published = ' . (int) $published);
        } elseif ($published === '') {
            $query->where('(lob_pw.published IN (0, 1))');
        }

        // Add the list ordering clause.
        $orderCol = $this->state->get('list.ordering', 'name');
        $orderDirn = $this->state->get('list.direction', 'asc');

        $query->order($db->escape($orderCol) . ' ' . $db->escape($orderDirn));

        \JLog::add("SchemeOfWorkModelLearningObjectiveHasPathway.getListQuery=" . $query, \JLog::DEBUG, \JText::_('LOG_CATEGORY'));

        return $query;
    }

}
