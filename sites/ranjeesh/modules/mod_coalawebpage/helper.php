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
 * along with this program.  If not, see <https://www.gnu.org/licenses/gpl.html/>.
 */

jimport('joomla.filesystem.file');

class CoalawebPageHelper extends JObject
{

    public static function getPageHtml5($pageParams)
    {

        $output[] = '<div class="fb-page"'
            . ' data-href="' . $pageParams['fbPageLink'] . '"'
            . ' data-tabs="' . $pageParams['fbTabsList'] . '"'
            . ' data-small-header="' . $pageParams['fbSmallHeader'] . '"'
            . ' data-adapt-container-width="true"'
            . ' data-width="' . $pageParams['fbWidth'] . '"'
            . ' data-height="' . $pageParams['fbHeight'] . '"'
            . ' data-show-facepile="' . $pageParams['fbFacepile'] . '"'
            . ' data-hide-cover="' . $pageParams['fbCover'] . '">'
            . ' </div>';

        return implode("\n", $output);
    }

    /**
     * Clean and minimize code
     *
     * @param type $code
     * @return string
     */
    private function cleanCode($code)
    {

        // Remove comments.
        $pass1 = preg_replace('~//<!\[CDATA\[\s*|\s*//\]\]>~', '', $code);
        $pass2 = preg_replace('/(?:(?:\/\*(?:[^*]|(?:\*+[^*\/]))*\*+\/)|(?:(?<!\:|\\\)\/\/[^"\'].*))/', '', $pass1);

        // Minimize.
        $pass3 = str_replace(array("\r\n", "\r", "\n", "\t"), '', $pass2);
        $pass4 = preg_replace('/ +/', ' ', $pass3); // Replace multiple spaces with single space.
        $codeClean = trim($pass4);  // Trim the string of leading and trailing space.

        return $codeClean;
    }


    /**
     * Check extension dependencies are available
     *
     * @return boolean
     */
    public static function checkDependencies()
    {
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
            JFile::exists($loadcount_php)
        ) {

            if (!class_exists('CwGearsHelperLoadcount')) {
                JLoader::register('CwGearsHelperLoadcount', $loadcount_php);
            }

            $checkOk = true;

        }

        return $checkOk;
    }

}