<?php

defined("_JEXEC") or die("Restricted access");
/**
 * @package             Joomla
 * @subpackage          CoalaWeb Facebook JS Plugin
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
jimport('joomla.plugin.plugin');

class plgSystemCwfacebookjs extends JPlugin {

    public function __construct($subject, $config) {

        parent::__construct($subject, $config);
        // load the CoalaWeb Facebook JS language file
        $lang = JFactory::getLanguage();

        if ($lang->getTag() != 'en-GB') {
            // Loads English language file as fallback (for undefined stuff in other language file)
            $lang->load('plg_system_cwfacebookjs', JPATH_ADMINISTRATOR, 'en-GB');
        }
        $lang->load('plg_system_cwfacebookjs', JPATH_ADMINISTRATOR, null, 1);

        //Load the component language strings
        if ($lang->getTag() != 'en-GB') {
            $lang->load('com_coalawebsociallinks', JPATH_ADMINISTRATOR, 'en-GB');
        }
        $lang->load('com_coalawebsociallinks', JPATH_ADMINISTRATOR, null, 1);
    }

    function onAfterRender() {
        $app = JFactory::getApplication();
        $doc = JFactory::getDocument();
        $comParams = JComponentHelper::getParams('com_coalawebsociallinks');
        $appId = $comParams->get('fb_app_id');
        $loadJs = $comParams->get('load_fb_js', 1);

        // Lets do a few checks first
        if (!$loadJs || $app->getName() !== 'site' || $doc->getType() !== 'html') {
            return;
        }

        // Detect language
        $lang = JFactory::getLanguage();
        $locale = $lang->getTag();
        $locale = str_replace("-", "_", $locale);

        // Facebook and Google only seem to support es_ES and es_LA for all of LATAM
        $locale = (substr($locale, 0, 3) == 'es_' && $locale != 'es_ES') ? 'es_LA' : $locale;

        $html = "\n" . '<!-- CoalaWeb Facebook JS -->'
        . "\n" . '<div id="fb-root"></div>
        <script>      
            window.fbAsyncInit = function() {
            FB.init({
              appId      : "' . $appId . '",
              xfbml      : true,
              version    : "v2.3"
            });
          };

          (function(d, s, id){
             var js, fjs = d.getElementsByTagName(s)[0];
             if (d.getElementById(id)) {return;}
             js = d.createElement(s); js.id = id;
             js.src = "//connect.facebook.net/' . $locale . '/sdk.js";
             fjs.parentNode.insertBefore(js, fjs);
           }(document, "script", "facebook-jssdk"));
        </script>';

        $body = JResponse::getBody();

        $callcount = $app->get('CWFacebookJSCount', 0);

        if ($callcount > 0) {
            $matches = preg_split('/(<body.*?>)/i', $body, -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);

            /* assemble the HTML output back with the code in it */
            $injectedHTML = $matches[0] . $matches[1] . $html . $matches[2];

            JResponse::setBody($injectedHTML);
        }

        return;
    }

}
