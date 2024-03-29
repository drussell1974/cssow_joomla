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
 * SchemeOfWork Model
 *
 * @since  0.0.1
 */
class SchemeOfWorkModelSchemeOfWork extends JModelItem
{
    /**
     * @var string scheme of work
     */
    protected $schemeofworks;

    /**
     * @var object item
     */
    protected $item;

    /**
     * Method to auto-populate the model state.
     *
     * This method should only be called once per instantiation and is designed
     * to be called on the first call to the getState() method unless the model
     * configuration flag to ignore the request is set.
     *
     * Note. Calling getState in this method will result in recursion.
     *
     * @return	void
     * @since	2.5
     */
    protected function populateState()
    {
        // Get the scheme of work id
        $jinput = JFactory::getApplication()->input;
        $id     = $jinput->get('id', 1, 'INT');
        $this->setState('name.id', $id);

        // Load the parameters.
        $this->setState('params', JFactory::getApplication()->getParams());
        parent::populateState();
    }

    /**
     * Method to get a table object, load it if necessary.
     *
     * @param   string  $type    The table name. Optional.
     * @param   string  $prefix  The class prefix. Optional.
     * @param   array   $config  Configuration array for model. Optional.
     *
     * @return  JTable  A JTable object
     *
     * @since   1.6
     */
    public function getTable($type = 'SchemeOfWork', $prefix = 'SchemeOfWorkTable', $config = array())
    {
        return JTable::getInstance($type, $prefix, $config);
    }
    /**
     * Get the scheme of work
     * @return object The scheme of work to be displayed to the user
     */
    public function getItem()
    {
        if (!isset($this->item)) 
        {
            $id    = $this->getState('name.id');

            $db    = JFactory::getDbo();
            $query = $db->getQuery(true);
            $query->select('sow.name, sow.params, c.title as category')
                      ->from('sow_schemeofwork as sow')
                      ->leftJoin('#__categories as c ON sow.catid=c.id')
                      ->where('sow.id=' . (int)$id);

            $db->setQuery((string)$query);

            if ($this->item = $db->loadObject()) 
            {
                // Load the JSON string
                $params = new JRegistry;
                $params->loadString($this->item->params, 'JSON');
                $this->item->params = $params;

                // Merge global params with item params
                $params = clone $this->getState('params');
                $params->merge($this->item->params);
                $this->item->params = $params;
            }
        }
        return $this->item;
    }
}