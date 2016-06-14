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

/**
 *  component helper.
 */
abstract class CoalawebsociallinksHelper {

    /**
     * Configure the Linkbar.
     */
    public static function addSubmenu($vName = 'controlpanel') {
        JHtmlSidebar::addEntry(
                JText::_('COM_CWSOCIALLINKS_TITLE_CPANEL'), 'index.php?option=com_coalawebsociallinks&view=controlpanel', $vName == 'controlpanel');
    }

    /**
     * Get the actions
     */
    public static function getActions() {
        $user = JFactory::getUser();
        $result = new JObject;
        $assetName = 'com_coalawebsociallinks';

        $actions = array(
            'core.admin', 'core.manage', 'core.create', 'core.edit', 'core.delete'
        );

        foreach ($actions as $action) {
            $result->set($action, $user->authorise($action, $assetName));
        }

        return $result;
    }

}