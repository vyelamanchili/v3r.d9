<?php

defined('_JEXEC') or die('Restricted access');

/**
 * @package             Joomla
 * @subpackage          CoalaWeb Social Links Component
 * @author              Steven Palmer
 * @author url          http://coalaweb.com
 * @author email        support@coalaweb.com
 * @license             GNU/GPL, see /assets/en-GB.license.txt
 * @copyright           Copyright (c) 2015 Steven Palmer All rights reserved.
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
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */
jimport('joomla.application.component.view');

class CoalawebsociallinksViewControlpanel extends JViewLegacy {

    function display($tpl = null) {

        $canDo = CoalawebsociallinksHelper::getActions();
        $model = $this->getModel();
        CoalawebsociallinksHelper::addSubmenu('controlpanel');

        // Is this the Professional release?
        jimport('joomla.filesystem.file');
        $isPro = (COM_CWSOCIALLINKS_PRO == 1);
        $this->assign('isPro', $isPro);

        $version = (COM_CWSOCIALLINKS_VERSION);
        $this->assign('version', $version);

        $releaseDate = (COM_CWSOCIALLINKS_DATE);
        $this->assign('release_date', $releaseDate);

        if (COM_CWSOCIALLINKS_PRO == 1) {
            JToolBarHelper::title(JText::_('COM_CWSOCIALLINKS_TITLE_PRO') . ' [ ' . JText::_('COM_CWSOCIALLINKS_TITLE_CPANEL') . ' ]', 'cogs');
        } else {
            JToolBarHelper::title(JText::_('COM_CWSOCIALLINKS_TITLE_CORE') . ' [ ' . JText::_('COM_CWSOCIALLINKS_TITLE_CPANEL') . ' ]', 'cogs');
        }
        if ($canDo->get('core.admin')) {
            JToolBarHelper::preferences('com_coalawebsociallinks');
        }

        $help_url = 'http://coalaweb.com/support/documentation/item/coalaweb-social-links-guide';
        JToolBarHelper::help('COM_CWSOCIALLINKS_TITLE_HELP', false, $help_url);

        parent::display($tpl);
    }

}
