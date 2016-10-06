<?php

defined('_JEXEC') or die('Restricted access');

/**
 * @package             Joomla
 * @subpackage          CoalaWeb Tweet Module
 * @author              Steven Palmer
 * @author url          http://coalaweb.com
 * @author email        support@coalaweb.com
 * @license             GNU/GPL, see /assets/en-GB.license.txt
 * @copyright           Copyright (c) 2016 Steven Palmer All rights reserved.
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

require_once dirname(__FILE__) . '/helper.php';

$lang = JFactory::getLanguage();

//Load the module language strings
if ($lang->getTag() != 'en-GB') {
    $lang->load('mod_coalawebtweet', JPATH_SITE, 'en-GB');
}
$lang->load('mod_coalawebtweet', JPATH_SITE, null, 1);

//Load the component language strings
if ($lang->getTag() != 'en-GB') {
    $lang->load('com_coalawebsociallinks', JPATH_ADMINISTRATOR, 'en-GB');
}
$lang->load('com_coalawebsociallinks', JPATH_ADMINISTRATOR, null, 1);

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