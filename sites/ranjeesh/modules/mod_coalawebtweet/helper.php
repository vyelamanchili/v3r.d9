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
 * along with this program.  If not, see <https://www.gnu.org/licenses/>.
 */

jimport('joomla.filesystem.file');

class ModCoalawebTweetHelper {
    
 function __construct($uniqueId, $params) {
        $this->_uniqueid = $uniqueId;
        $myparams = $this->_getParams($params);
        $this->_params = $myparams;
        $this->_addAssets();

        return; 
   }

    private function _getParams($params) {
        $lang = JFactory::getLanguage();

        //Advanced
        $arr['uniqueid'] = $this->_uniqueid;
        $arr['moduleClassSfx'] = htmlspecialchars($params->get('moduleclass_sfx', ''));
        $arr['uikitPrefix'] = $params->get('uikit_prefix', 'cw');
        $arr['loadCss'] = $params->get('load_css', '1');
        
        // Detect language
        $arr['langTag'] = $lang->getTag();

        //General
        $arr['twitterUser'] = $params->get('twitter_user', '');
        $arr['panelType'] = $params->get('panel_style', '');
        $arr['panelStyle'] = $this->_getPanel($arr['uikitPrefix'], $arr['panelType']);
        $arr['maxTweets'] = $params->get('max_tweets', '3');
        
        //Title
        $arr['showTitle'] = $params->get('show_title', '1');
        $arr['title'] = $params->get('show_text', '1') ? $params->get('title', JTEXT::_('MOD_CWTWEET_TITLE')) : '';
        $arr['titleFormat'] = $params->get('title_format', 'H3');
        $arr['titleIcon'] = ''; 
        $arr['titleAlign'] = $arr['uikitPrefix'] . '-text-' . $params->get('title_align', 'left');
        $arr['titleOpen'] = '<' . $arr['titleFormat'] . ' class="' . $arr['uikitPrefix'] . '-margin-small ' . $arr['titleAlign'] . '"><a href="';
        $arr['titleClose'] = '">' . $arr['titleIcon'] . ' ' . $arr['title'] . '</a></' . $arr['titleFormat'] . '>';
        
        //Tweet
        $arr['conFormat'] = $params->get('content_format', 'p');
        $arr['conBreak'] = $params->get('content_break', '1') ? 'cwt-content' : '';
        $arr['conAlign'] = $arr['uikitPrefix'] . '-text-' . $params->get('content_align', 'left');
        $arr['conOpen'] = '<' . $arr['conFormat'] . ' class="' . $arr['conBreak'] . ' ' .$arr['uikitPrefix'] . '-margin-small ' . $arr['conAlign'] . '">';
        $arr['conClose'] = '</' . $arr['conFormat'] . '>';

        return $arr;
    }
    
    private function _getPanel($prefix, $type) {

        switch ($type) {
            case '' :
                $panelStyle = '';
                break;
            case 'd' :
                $panelStyle = $prefix . '-panel-box';
                break;
            case 'p' :
                $panelStyle = $prefix . '-panel-box ' . $prefix . '-panel-box-primary';
                break;
            case 's' :
                $panelStyle = $prefix . '-panel-box ' . $prefix . '-panel-box-secondary';
                break;
            case 'h' :
                $panelStyle = $prefix . '-panel-hover';
                break;
        }

        return $panelStyle;
    }

    private function _addAssets() {
        $myparams = $this->_params;
        $doc = JFactory::getDocument();
        JHtml::_('jquery.framework');
        
        $urlModMedia = JURI::base(true) . '/media/coalawebsocial/modules/tweet/';
        if ($myparams['loadCss']) {
            $doc->addStyleSheet($urlModMedia . 'css/cw-tweet-default.css');
        }

        $doc->addScript($urlModMedia. 'js/twitterFetcher.min.js');

        return;
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