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
 * Contents Model
 *
 * @since  0.0.1
 */
class SchemeOfWorkModelContents extends JModelList {

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
                'letter',
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
        $query->select('cnt.id as id, cnt.description as description, cnt.letter as letter, cnt.published as published, cnt.created as created')
                ->from($db->quoteName('sow_content', 'cnt'));

        // Join over the keystages.
        $query->select($db->quoteName('ks.name', 'key_stage_name'))
                ->join('LEFT', $db->quoteName('sow_key_stage', 'ks') . ' ON ks.id = cnt.key_stage_id');

        // Join with users table to get the username of the author
        $query->select($db->quoteName('u.username', 'author'))
                ->join('LEFT', $db->quoteName('#__users', 'u') . ' ON u.id = cnt.created_by');

        // Filter: like / search
        $search = $this->getState('filter.search');

        if (!empty($search)) {
            $like = $db->quote('%' . $search . '%');
            $query->where('cnt.description LIKE ' . $like);
        }

        // Filter by published state
        $published = $this->getState('filter.published');

        if (is_numeric($published)) {
            $query->where('cnt.published = ' . (int) $published);
        } elseif ($published === '') {
            $query->where('(cnt.published IN (0, 1))');
        }

        // Add the list ordering clause.
        $orderCol = $this->state->get('list.ordering', 'description');
        $orderDirn = $this->state->get('list.direction', 'asc');

        $query->order($db->escape($orderCol) . ' ' . $db->escape($orderDirn));

        \JLog::add("SchemeOfWorkModelContent.getListQuery=" . $query, \JLog::DEBUG, \JText::_('LOG_CATEGORY'));

        return $query;
    }

}
