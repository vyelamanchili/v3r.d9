<?php
defined('_JEXEC') or die('Restricted access');
/**
 * @package             Joomla
 * @subpackage          CoalaWeb Page Module
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

}