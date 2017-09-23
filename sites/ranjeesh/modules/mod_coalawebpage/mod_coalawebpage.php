<?php

defined('_JEXEC') or die('Restricted access');

/**
 * @package             Joomla
 * @subpackage          CoalaWeb Page Module
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

require_once dirname(__FILE__) . '/helper.php';

$app = JFactory::getApplication();
$doc = JFactory::getDocument();

// Load the language files
$jlang = JFactory::getLanguage();

// Module
$jlang->load('mod_coalawebpage', JPATH_SITE, 'en-GB', true);
$jlang->load('mod_coalawebpage', JPATH_SITE, $jlang->getDefault(), true);
$jlang->load('mod_coalawebpage', JPATH_SITE, null, true);

// Component
$jlang->load('com_coalawebsociallinks', JPATH_ADMINISTRATOR, 'en-GB', true);
$jlang->load('com_coalawebsociallinks', JPATH_ADMINISTRATOR, $jlang->getDefault(), true);
$jlang->load('com_coalawebsociallinks', JPATH_ADMINISTRATOR, null, true);

//Check dependencies
$checkOk = CoalawebPageHelper::checkDependencies();

// Detect language
$fbLocale = $lang->getTag();
$fbLocale = str_replace('-', '_', $fbLocale);

// Facebook and Google only seem to support es_ES and es_LA for all of LATAM
$fbLocale = (substr($fbLocale, 0, 3) == 'es_' && $fbLocale != 'es_ES') ? 'es_LA' : $fbLocale;


//Page parameters
$fbPageLink = $params->get('fb_page_link');
$fbWidth = $params->get('fb_width', '300');
$fbHeight = $params->get('fb_height', '400');
$fbAlign = $params->get('fb_align', 'center');
$moduleAlign = 'text-align: ' . $fbAlign . ';';
$setHeight = $params->get('module_height', 0);
$moduleHeight = $setHeight? 'height: ' . $fbHeight . 'px;': '';
$fbFacepile = $params->get('fb_facepile') ? 'true' : 'false';
$fbPosts = $params->get('fb_posts') ? 'true' : 'false';
$fbCover = $params->get('fb_cover') ? 'false' : 'true';

/* Module Settings */
$moduleClassSfx = htmlspecialchars($params->get('moduleclass_sfx'));
$module_unique_id = 'cw-page-' . $module->id;
$module_width = $params->get('module_width', '100');

/* Load css */
$loadCss = $params->get('load_layout_css');
$urlModMedia = JURI::base(true) . '/media/coalawebsocial/modules/page/css/';
if ($loadCss) {
    $doc->addStyleSheet($urlModMedia . 'cwp-default.css');
}

if ($checkOk === true) {
    $helpFunc = new CwGearsHelperLoadcount();
    $url = JURI::getInstance()->toString();
    $helpFunc::setFacebookJSCount($url);
}

require JModuleHelper::getLayoutPath('mod_coalawebpage', $params->get('layout', 'default'));