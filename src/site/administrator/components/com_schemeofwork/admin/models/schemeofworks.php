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
 * SchemeOfWorks Model
 *
 * @since  0.0.1
 */
class SchemeOfWorkModelSchemeOfWorks extends JModelList
{
    /**
    * Constructor.
    *
    * @param   array  $config  An optional associative array of configuration settings.
    *
    * @see     JController
    * @since   1.6
    */
    public function __construct($config = array())
    {
        if (empty($config['filter_fields']))
        {
             $config['filter_fields'] = array(
                'id',
                'name',
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
    protected function getListQuery()
    {
        // Initialize variables.
        $db    = JFactory::getDbo();
        $query = $db->getQuery(true);
        
        // Create the base select statement.
        $query->select('sow.id as id, sow.name as name, sow.published as published, sow.created as created')
            ->from($db->quoteName('sow_schemeofwork', 'sow'));

        // Join over the categories.
        $query->select($db->quoteName('c.title', 'category_title'))
            ->join('LEFT', $db->quoteName('#__categories', 'c') . ' ON c.id = sow.catid');
        
        // Join with users table to get the username of the author
        $query->select($db->quoteName('u.username', 'author'))
            ->join('LEFT', $db->quoteName('#__users', 'u') . ' ON u.id = sow.created_by');
            
        // Filter: like / search
        $search = $this->getState('filter.search');
        
        if (!empty($search))
        {
            $like = $db->quote('%' . $search . '%'); 
            $query->where('sow.name LIKE ' . $like);
        }

        // Filter by published state
        $published = $this->getState('filter.published');
        
        \JLog::add("published:".$published, \JLog::DEBUG, \JText::_('LOG_CATEGORY')); 
        
        if (is_numeric($published))
        {
            $query->where('sow.published = ' . (int) $published);
        }
        elseif ($published === '')
        {
            $query->where('(sow.published IN (0, 1))');
        }
        
        // Add the list ordering clause.
        $orderCol	= $this->state->get('list.ordering', 'name');
        $orderDirn 	= $this->state->get('list.direction', 'asc');

        $query->order($db->escape($orderCol) . ' ' . $db->escape($orderDirn));

        return $query;
    }
}