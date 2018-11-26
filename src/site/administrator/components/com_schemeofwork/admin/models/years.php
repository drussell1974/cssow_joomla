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
 * Years Model
 *
 * @since  0.0.1
 */
class SchemeOfWorkModelYears extends JModelList {

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
                'name',
                'key_stage_id',
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
        $query->select('yr.id as id, yr.name as name, yr.published as published, yr.created as created')
                ->from($db->quoteName('sow_year', 'yr'));

        // Join over the keystages.
        $query->select($db->quoteName('ks.name', 'key_stage_name'))
                ->join('LEFT', $db->quoteName('sow_key_stage', 'ks') . ' ON ks.id = yr.key_stage_id');

        // Join with users table to get the username of the author
        $query->select($db->quoteName('u.username', 'author'))
                ->join('LEFT', $db->quoteName('#__users', 'u') . ' ON u.id = yr.created_by');

        // Filter: like / search
        $search = $this->getState('filter.search');

        if (!empty($search)) {
            $like = $db->quote('%' . $search . '%');
            $query->where('yr.name LIKE ' . $like);
        }

        // Filter by published state
        $published = $this->getState('filter.published');

        if (is_numeric($published)) {
            $query->where('yr.published = ' . (int) $published);
        } elseif ($published === '') {
            $query->where('(yr.published IN (0, 1))');
        }

        // Add the list ordering clause.
        $orderCol = $this->state->get('list.ordering', 'name');
        $orderDirn = $this->state->get('list.direction', 'asc');

        $query->order($db->escape($orderCol) . ' ' . $db->escape($orderDirn));

        \JLog::add("SchemeOfWorkModelYear.getListQuery=" . $query, \JLog::DEBUG, \JText::_('LOG_CATEGORY'));

        return $query;
    }

}
