<?php

defined('_JEXEC') or die('Restricted access');

/**
 * @package             Joomla
 * @subpackage          CoalaWeb Header Element
 * @author              Steven Palmer
 * @author url          https://coalaweb.com
 * @author email        support@coalaweb.com
 * @license             GNU/GPL, see /assets/en-GB.license.txt
 * @copyright           Copyright (c) 2017 Steven Palmer All rights reserved.
 *
 * CoalaWeb Gears is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.

 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.

 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <https://www.gnu.org/licenses/gpl.html>.
 */
require_once (JPATH_SITE . '/plugins/system/cwgears/fields/base.php');

class CWElementCsscom extends CWElement {

    public function fetchElement($name, $value, &$node, $control_name) {

        $doc = JFactory::getDocument();

        if (version_compare(JVERSION, '3.0', '>')) {
            $doc->addStyleSheet(JURI::root(true) . '/media/coalaweb/components/generic/css/com-coalaweb-base-j3.css');
            $doc->addStyleSheet(JURI::root(true) . '/media/coalaweb/components/generic/css/com-coalaweb-base-v2.css');
        } else {
            $doc->addStyleSheet(JURI::root(true) . '/media/coalaweb/components/generic/css/com-coalaweb-base.css');
        }

        // Fix help being displayed
        if(JFactory::getApplication()->input->getCmd('option', '') == 'com_config')
        {
            $doc->addScriptDeclaration('
				jQuery(document).ready(function($) {
					$("button[rel=\'help\']").hide();
					
				});
			');
        }
    }

    public function fetchTooltip($label, $description, &$node, $control_name, $name) {
        return NULL;
    }

}

class JFormFieldCsscom extends CWElementCsscom {

    var $type = 'csscom';

}
