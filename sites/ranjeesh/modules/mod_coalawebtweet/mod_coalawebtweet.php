<?php

defined('_JEXEC') or die('Restricted access');

/**
 * @package             Joomla
 * @subpackage          CoalaWeb Tweet Module
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

require_once dirname(__FILE__) . '/helper.php';

// Load the language files
$jlang = JFactory::getLanguage();

// Module
$jlang->load('mod_coalawebtweet', JPATH_SITE, 'en-GB', true);
$jlang->load('mod_coalawebtweet', JPATH_SITE, $jlang->getDefault(), true);
$jlang->load('mod_coalawebtweet', JPATH_SITE, null, true);

// Component
$jlang->load('com_coalawebsociallinks', JPATH_ADMINISTRATOR, 'en-GB', true);
$jlang->load('com_coalawebsociallinks', JPATH_ADMINISTRATOR, $jlang->getDefault(), true);
$jlang->load('com_coalawebsociallinks', JPATH_ADMINISTRATOR, null, true);

//Unique ID
$uniqueId = 'cwtweet' . $module->id;

//Lets get help and params from our helper
$helper = new modCoalawebTweetHelper($uniqueId, $params);
$myparams = $helper->_params;

//Check dependencies
$checkOk = $helper->checkDependencies();


if ($checkOk === true) {
    $helpFunc = new CwGearsHelperLoadcount();
    $url = JURI::getInstance()->toString();
    $helpFunc::setUikitCount($url);
}

require JModuleHelper::getLayoutPath('mod_coalawebtweet', $params->get('layout', 'default'));