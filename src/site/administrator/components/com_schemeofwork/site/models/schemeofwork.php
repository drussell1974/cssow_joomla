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
class SchemeOfWorkModelKeyStage extends JModelItem
{
	/**
	 * @var string keystage
	 */
	protected $keystages;

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
	public function getTable($type = 'KeyStage', $prefix = 'SchemeOfWorkTable', $config = array())
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
            
            if (!is_array($this->keystages))
            {
                $this->keystages = array();
            }

            if (!isset($this->keystages[$id]))
            {
                // Request the selected id
                $jinput = JFactory::getApplication()->input;
                $id     = $jinput->get('id', 1, 'INT');

                // Get a TableSchemeOfWork instance
                $table = $this->getTable();
                
                // Load the message
                $table->load($id);

                // Assign the message
                $this->keystages[$id] = $table->name;
            }

            return $this->keystages[$id];
	}
}