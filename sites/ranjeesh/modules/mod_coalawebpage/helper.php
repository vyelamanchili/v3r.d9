<?php
defined('_JEXEC') or die('Restricted access');
/**
 * @package             Joomla
 * @subpackage          CoalaWeb Page Module
 * @author              Steven Palmer
 * @author url          http://coalaweb.com
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
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

jimport('joomla.filesystem.file');

class CoalawebPageHelper {
    
    public static function getPageHtml5(
            $fbPageLink, $fbWidth, $fbHeight, $fbFacepile, $fbCover, $fbPosts){
            
	$output[] = '<div class="fb-page"' 
                . ' data-href="' . $fbPageLink . '"' 
                . ' data-width="' . $fbWidth . '"'
                . ' data-height="' . $fbHeight . '"'
                . ' data-show-facepile="' . $fbFacepile . '"'
                . ' data-show-posts="' . $fbPosts . '"' 
                . ' data-hide-cover="' . $fbCover. '">'
                . ' </div>';
        
        return implode("\n", $output);
    }
    
    public static function checkDependencies() {
        $checkOk = false;
        $minVersion = '0.1.5';

        // Load the version.php file for the CW Gears plugin
        $version_php = JPATH_SITE . '/plugins/system/cwgears/version.php';
        if (!defined('PLG_CWGEARS_VERSION') && JFile::exists($version_php)) {
            require_once $version_php;
        }

        $loadcount_php = JPATH_SITE . '/plugins/system/cwgears/helpers/loadcount.php';
        if (
                JPluginHelper::isEnabled('system', 'cwgears', true) == true &&
                JFile::exists($version_php) &&
                version_compare(PLG_CWGEARS_VERSION, $minVersion, 'ge') &&
                JFile::exists($loadcount_php)) {

            if (!class_exists('CwGearsHelperLoadcount')) {
                include_once $loadcount_php;
            }

            $checkOk = true;
            
        }

        return $checkOk;
    }

}