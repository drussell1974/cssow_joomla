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
 * SchemeOfWork component helper.
 *
 * @param   string  $submenu  The name of the active view.
 *
 * @return  void
 *
 * @since   1.6
 */
abstract class SchemeOfWorkHelper extends JHelperContent
{
    public static function test(){
        return "Called SchemeOfWorkHelper.test()";
    }
    /**
     * Configure the Linkbar.
     *
     * @return Bool
     */

    public static function addSubmenu($submenu) 
    {


        JHtmlSidebar::addEntry(
            JText::_('COM_SCHEMEOFWORK_CATEGORIES_SUBMENU'),
            'index.php?option=com_categories&view=categories&extension=com_schemeofwork',
            $submenu == 'categories'
        );

        JHtmlSidebar::addEntry(
            JText::_('COM_SCHEMEOFWORK_CSCONCEPT_SUBMENU'),
            'index.php?option=com_schemeofwork&view=csconcepts',
            $submenu == 'csconcepts'
        );

        JHtmlSidebar::addEntry(
            JText::_('COM_SCHEMEOFWORK_CONTENT_SUBMENU'),
            'index.php?option=com_schemeofwork&view=contents',
            $submenu == 'contents'
        );

        JHtmlSidebar::addEntry(
            JText::_('COM_SCHEMEOFWORK_EXAMBOARD_SUBMENU'),
            'index.php?option=com_schemeofwork&view=examboards',
            $submenu == 'examboards'
        );

        JHtmlSidebar::addEntry(
            JText::_('COM_SCHEMEOFWORK_KEYSTAGE_SUBMENU'),
            'index.php?option=com_schemeofwork&view=keystages',
            $submenu == 'keystages'
        );
        
        JHtmlSidebar::addEntry(
            JText::_('COM_SCHEMEOFWORK_LEARNINGOBJECTIVE_SUBMENU'),
            'index.php?option=com_schemeofwork&view=learningobjectives',
            $submenu == 'learningobjectives'
        );

        JHtmlSidebar::addEntry(
            JText::_('COM_SCHEMEOFWORK_LEARNINGOBJECTIVEHASPATHWAY_SUBMENU'),
            'index.php?option=com_schemeofwork&view=learningobjectivehaspathways',
            $submenu == 'learningobjectivehaspathways'
        );
        
        JHtmlSidebar::addEntry(
            JText::_('COM_SCHEMEOFWORK_PATHWAY_SUBMENU'),
            'index.php?option=com_schemeofwork&view=pathways',
            $submenu == 'pathways'
        );

        JHtmlSidebar::addEntry(
            JText::_('COM_SCHEMEOFWORK_PLAYBASEDOBJECTIVE_SUBMENU'),
            'index.php?option=com_schemeofwork&view=playbasedobjectives',
            $submenu == 'playbasedobjectives'
        );
        
        JHtmlSidebar::addEntry(
            JText::_('COM_SCHEMEOFWORK_SCHEMEOFWORK_SUBMENU'),
            'index.php?option=com_schemeofwork&view=schemeofworks',
            $submenu == 'schemeofworks'
        );

        JHtmlSidebar::addEntry(
            JText::_('COM_SCHEMEOFWORK_SOLOTAXONOMY_SUBMENU'),
            'index.php?option=com_schemeofwork&view=solotaxonomies',
            $submenu == 'solotaxonomies'
        );

        JHtmlSidebar::addEntry(
            JText::_('COM_SCHEMEOFWORK_SUBJECTPURPOSE_SUBMENU'),
            'index.php?option=com_schemeofwork&view=subjectpurposes',
            $submenu == 'subjectpurposes'
        );

        JHtmlSidebar::addEntry(
            JText::_('COM_SCHEMEOFWORK_TOPIC_SUBMENU'),
            'index.php?option=com_schemeofwork&view=topics',
            $submenu == 'topics'
        );

        JHtmlSidebar::addEntry(
            JText::_('COM_SCHEMEOFWORK_YEAR_SUBMENU'),
            'index.php?option=com_schemeofwork&view=years',
            $submenu == 'years'
        );

        // Set some global property
        $document = JFactory::getDocument();
        $document->addStyleDeclaration('.icon-48-schemeofwork ' .
            '{background-image: url(../media/com_schemeofwork/images/48x48.png);}');
        if ($submenu == 'categories') 
        {
            $document->setTitle(JText::_('COM_SCHEMEOFWORK_SCHEMEOFWORK_ADMINISTRATION_CATEGORIES'));
        }
    }
}

abstract class FormOptionsHelper extends JHelperContent {
    /**
     * Get formoptions.$option from getUserStateFromRequest
     * 
     * @return value
     */
   public static function GetSelectedOption($context, $option)
   {
        $app = JFactory::getApplication();
    
        return $app->getUserStateFromRequest("$context.$option", "learningobjectivehaspathway.$option", null);
        //$topic_id = $app->getUserStateFromRequest("learningobjectivehaspathway.topic", "learningobjectivehaspathway.topic", null);
        //$year_id = $app->getUserStateFromRequest("learningobjectivehaspathway.year", "learningobjectivehaspathway.year", null);
        //$solo_taxonomy_id = $app->getUserStateFromRequest("learningobjectivehaspathway.solotaxonomy", "learningobjectivehaspathway.solotaxonomy", null);

        //return array($topic_id, $year_id, $solo_taxonomy_id);
   }
   
   /**
    * Set the setUserState topic, year and solo taxonomy 
    * 
    * @param type $step
    * @param type $topic (null by default that will not change the setUserState)
    */
   public static function SaveSelectedOption($context, $option, $val){
        $app = JFactory::getApplication();
        
        $app->setUserState("$context.$option", $val);
        //$app->setUserState("learningobjectivehaspathway.year", $year_id);
        //$app->setUserState("learningobjectivehaspathway.solotaxonomy", $solo_taxonomy_id);
   }
}