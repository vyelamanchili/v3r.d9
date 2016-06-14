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

class CoalawebLikeboxHelper {

    public static function getLikeboxXfbml(
            $fbPageLink, $fbWidth, $fbHeight, $fbColor, $fbFaces, $fbBorder, $fbStream, $fbHeader, $fbForceWall){
            
        $output[] = '<fb:like-box'
                . ' href="' . $fbPageLink . '"'
                . ' width="' . $fbWidth . '"'
                . ' height="' . $fbHeight . '"'
                . ' colorscheme="' . $fbColor . '"'
                . ' show_faces="' . $fbFaces . '" '
                . ' show_border="' . $fbBorder . '"'
                . ' stream="' . $fbStream . '"'
                . ' header="' . $fbHeader . '"'
                . ' force_wall="' . $fbForceWall . '">'
                . '</fb:like-box >';
        
        return implode("\n", $output);

    }
    
    public static function getLikeboxHtml5(
            $fbPageLink, $fbWidth, $fbHeight, $fbColor, $fbFaces, $fbBorder, $fbStream, $fbHeader, $fbForceWall){
            
	$output[] = '<div class="fb-like-box"' 
                . ' data-href="' . $fbPageLink . '"' 
                . ' data-width="' . $fbWidth . '"'
                . ' data-height="' . $fbHeight . '"'
                . ' data-colorscheme="' . $fbColor . '"'
                . ' data-show_faces="' . $fbFaces . '"'
                . ' data-show_border="' . $fbBorder . '"'
                . ' data-stream="' . $fbStream . '"' 
                . ' data-header="' . $fbHeader . '"'
                . ' data-force_wall="' . $fbForceWall . '">'
                . ' </div>';
        
        return implode("\n", $output);
    }
        public static function getLikeboxIframe(
            $fbPageLink, $fbWidth, $fbHeight, $fbColor, $fbFaces, $fbBorder, $fbStream, $fbHeader, $fbForceWall, $fbAppId, $fbLocale){

            $output[] = '<iframe'
                    . ' src="//www.facebook.com/plugins/likebox.php?href=' . $fbPageLink . ''
                    . '&amp;locale=' . $fbLocale . ''
                    . '&amp;width=' . $fbWidth . ''
                    . '&amp;height=' . $fbHeight . ''
                    . '&amp;colorscheme=' . $fbColor . ''
                    . '&amp;show_faces=' . $fbFaces . ''
                    . '&amp;force_wall=' . $fbForceWall . ''
                    . '&amp;header=' . $fbHeader . ''
                    . '&amp;stream=' . $fbStream . ''
                    . '&amp;show_border=' . $fbBorder . ''
                    . '&amp;appid=' . $fbAppId . '"'
                    . ' scrolling="no"' 
                    . ' frameborder="0"' 
                    . ' style="border:none; overflow:hidden; width:' . $fbWidth . 'px; height:' . $fbHeight . 'px;"'
                    . ' allowTransparency="true">'
                    . '</iframe>';
            
            return implode("\n", $output);
    }
}