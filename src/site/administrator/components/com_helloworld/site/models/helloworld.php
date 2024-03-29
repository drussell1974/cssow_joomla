<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_helloworld
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

/**
 * HelloWorld Model
 *
 * @since  0.0.1
 */
class HelloWorldModelHelloWorld extends JModelItem
{
    /**
     * @var string message
     */
    private $messages;
    
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
    public function getTable($type = 'HelloWorld', $prefix = 'HelloWorldTable', $config = array())
    {
        return JTable::getInstance($type, $prefix, $config);
    }

    /**
     * Get the message
     *
     * @return  string  The message to be displayed to the user
     */
    public function getMsg()
    {
        $id = 0;
    
        if (!is_array($this->messages))
        {
            $this->messages = array();
        }

        if (!isset($this->messages[$id]))
        {
            // Request the selected id
            $jinput = JFactory::getApplication()->input;
            $id     = $jinput->get('id', 1, 'INT');

            // Get a TableHelloWorld instance
            $table = $this->getTable();

            // Load the message
            $table->load($id);

            // Assign the message
            $this->messages[$id] = $table->greeting;
        }

        return $this->messages[$id];
    }
}