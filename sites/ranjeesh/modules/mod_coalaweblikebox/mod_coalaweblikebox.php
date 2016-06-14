<?php

defined('_JEXEC') or die('Restricted access');

/**
 * @package             Joomla
 * @subpackage          CoalaWeb Like Box Module
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

require_once dirname(__FILE__) . '/helper.php';
$comParams = JComponentHelper::getParams('com_coalawebsociallinks');
$lang = JFactory::getLanguage();
$app = JFactory::getApplication();

//Load the module language strings
if ($lang->getTag() != 'en-GB') {
    $lang->load('mod_coalaweblikebox', JPATH_SITE, 'en-GB');
}
$lang->load('mod_coalaweblikebox', JPATH_SITE, null, 1);

//Load the component language strings
if ($lang->getTag() != 'en-GB') {
    $lang->load('com_coalawebsociallinks', JPATH_ADMINISTRATOR, 'en-GB');
}
$lang->load('com_coalawebsociallinks', JPATH_ADMINISTRATOR, null, 1);

// Detect language
$lang = JFactory::getLanguage();
$fbLocale = $lang->getTag();
$fbLocale = str_replace("-", "_", $fbLocale);

// Facebook and Google only seem to support es_ES and es_LA for all of LATAM
$fbLocale = (substr($fbLocale, 0, 3) == 'es_' && $fbLocale != 'es_ES') ? 'es_LA' : $fbLocale;

$doc = JFactory::getDocument();

$fbPageLink = $params->get("fb_page_link");
$fbWidth = $params->get("fb_width");
$fbHeight = $params->get("fb_height");
$fbColor = $params->get("fb_color");

// True or False 
$fbFaces = $params->get("fb_faces") ? "true" : "false";
$fbBorder = $params->get("fb_border") ? "true" : "false";
$fbStream = $params->get("fb_stream") ? "true" : "false";
$fbHeader = $params->get("fb_header") ? "true" : "false";
$fbForceWall = $params->get("fb_force_wall") ? "true" : "false";

//Get App ID from the Component options
$fbAppId = $comParams->get("fb_app_id");

/* Module Settings */
$moduleClassSfx = htmlspecialchars($params->get('moduleclass_sfx'));
$module_unique_id = htmlspecialchars($params->get('module_unique_id'));
$module_width = $params->get('module_width');

/* Load css */
$loadCss = $params->get('load_layout_css');
$urlModMedia = JURI::base(true) . '/media/coalawebsocial/modules/likebox/css/';
if ($loadCss) {
    $doc->addStyleSheet($urlModMedia . 'cwl-default.css');
}

//Lets load the Facebook JS
$callcount = $app->get('CWFacebookJSCount', 0);
$app->set('CWFacebookJSCount', $callcount + 1);

$css = '      
    #likebox-wrapper * {min-width: ' . $fbWidth . 'px;}

    .fb-comments, .fb-comments span, .fb-comments iframe[style], 
    .fb-comments iframe span[style], .fb-like-box, .fb-like-box span, 
    .fb-like-box iframe[style], .fb-like-box iframe span[style] {
      min-width: ' . $fbWidth . 'px;
    }';

$doc->addStyleDeclaration($css);

require JModuleHelper::getLayoutPath('mod_coalaweblikebox', $params->get('layout', 'default'));