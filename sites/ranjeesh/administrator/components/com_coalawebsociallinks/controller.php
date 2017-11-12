
<?php

defined('_JEXEC') or die('Restricted access');

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
 * along with this program.  If not, see <https://www.gnu.org/licenses/gpl.html/>.
 */
// import Joomla controller library
jimport('joomla.application.component.controller');

/**
 * General Controller for coalawebsociallinks component
 */
class CoalawebsociallinksController extends JControllerLegacy {

    protected $default_view = 'Controlpanel';

    /**
     * Method to display a view.
     *
     * @param	boolean
     * @param	array
     *
     * @return	JController
     * @since	1.5
     */
    public function display($cachable = false, $urlparams = false) {
        require_once JPATH_COMPONENT . '/helpers/coalawebsociallinks.php';

        $view = JFactory::getApplication()->input->get('view', 'Controlpanel');
        $layout = JFactory::getApplication()->input->get('layout', 'default');

        parent::display();
        return $this;
    }

}
