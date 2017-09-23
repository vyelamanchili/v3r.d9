<?php

/**
 * @package             Joomla
 * @subpackage          CoalaWeb Social Links Component
 * @author              Steven Palmer
 * @author url          https://coalaweb.com
 * @author email        support@coalaweb.com
 * @license             GNU/GPL, see /assets/en-GB.license.txt
 * @copyright           Copyright (c) 2017 Steven Palmer All rights reserved.
 *
 * CoalaWeb Social Links is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.

 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.

 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <https://www.gnu.org/licenses/>.
 */

defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.view');
jimport('joomla.filesystem.file');

/**
 * View class for control panel
 */
class CoalawebsociallinksViewControlpanel extends JViewLegacy {

        /**
     * Display the view
     *
     * @param string $tpl The name of the template file to parse; automatically searches through the template paths.
     *
     * @return void
     */
    function display($tpl = null) {

        $model = $this->getModel();

        // Check for errors.
        if (count($errors = $this->get('Errors'))) {
            throw new Exception(implode("\n", $errors), 500);
        }
        
        CoalawebsociallinksHelper::addSubmenu('controlpanel');

        // Is this the Pro release
        $isPro = (COM_CWSOCIALLINKS_PRO == 1);
        $this->isPro = $isPro;
        
        // The curent version and release date
        $version = (COM_CWSOCIALLINKS_VERSION);
        $this->version = $version;
        
        //Release date
        $releaseDate = (COM_CWSOCIALLINKS_DATE);
        $this->release_date = $releaseDate;
        
        //Need a download ID?
        $needsDlid = $model->needsDownloadID();
        $this->needsdlid = $needsDlid;
        
         // We don't need toolbar in the modal window.
        if ($this->getLayout() !== 'modal') {
            $this->addToolbar();
        }

        parent::display($tpl);
    }
    
    /**
     * Add the page title and toolbar.
     *
     * @return void
     */
    protected function addToolbar() 
    {
        $canDo = JHelperContent::getActions('com_coalawebsociallinks');

       if (COM_CWSOCIALLINKS_PRO == 1) {
            JToolBarHelper::title(JText::_('COM_CWSOCIALLINKS_TITLE_PRO') . ' [ ' . JText::_('COM_CWSOCIALLINKS_TITLE_CPANEL') . ' ]', 'cogs');
        } else {
            JToolBarHelper::title(JText::_('COM_CWSOCIALLINKS_TITLE_CORE') . ' [ ' . JText::_('COM_CWSOCIALLINKS_TITLE_CPANEL') . ' ]', 'cogs');
        }
        
        if ($canDo->get('core.admin')) {
            JToolBarHelper::preferences('com_coalawebsociallinks');
        }

        $help_url = 'https://coalaweb.com/support/documentation/item/coalaweb-social-links-guide';
        JToolBarHelper::help('COM_CWSOCIALLINKS_TITLE_HELP', false, $help_url);

    }

}
