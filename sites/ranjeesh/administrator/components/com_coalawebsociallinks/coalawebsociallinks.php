<?php
defined('_JEXEC') or die('Restricted access');

/**
 * @package             Joomla
 * @subpackage          CoalaWeb Social Links Component
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
// Access check.
if (!JFactory::getUser()->authorise('core.manage', 'com_coalawebsociallinks')) {
    return JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
}

// Require helper file
if (!defined('DS')) {
    define('DS', DIRECTORY_SEPARATOR);
}

// Load version.php
jimport('joomla.filesystem.file');
$version_php = JPATH_COMPONENT_ADMINISTRATOR . DS . 'version.php';
if (!defined('COM_CWSOCIALLINKS_VERSION') && JFile::exists($version_php)) {
    require_once $version_php;
}

$lang = JFactory::getLanguage();
if ($lang->getTag() != 'en-GB') {
    $lang->load('com_coalawebsociallinks', JPATH_ADMINISTRATOR, 'en-GB');
}
$lang->load('com_coalawebsociallinks', JPATH_ADMINISTRATOR, null, 1);

JLoader::register('CoalawebsociallinksHelper', dirname(__FILE__) . DS . 'helpers' . DS . 'coalawebsociallinks.php');

// Check Gears plugin
if (JPluginHelper::isEnabled('system', 'cwgears', true) == false) {
    echo JText::_('COM_CWSOCIALLINKS_NOGEARSPLUGIN_GENERAL_MESSAGE');
}

$controller = JControllerLegacy::getInstance('Coalawebsociallinks');
$controller->execute(JRequest::getCmd('task'));
$controller->redirect();
?>
<div class="cw-powerby-back">
    <span class="cw-powerby-back">
        <?php echo JTEXT::_('COM_CWSOCIALLINKS_POWEREDBY_MSG'); ?> <a href="http://www.coalaweb.com" target="_blank" title="CoalaWeb">CoalaWeb</a> <?php
        echo JTEXT::_('COM_CWSOCIALLINKS_POWEREDBY_VERSION');
        if (COM_CWSOCIALLINKS_PRO == 1) {
            echo COM_CWSOCIALLINKS_VERSION . ' ' . JTEXT::_('COM_CWSOCIALLINKS_POWEREDBY_PRO');
        } else {
            echo COM_CWSOCIALLINKS_VERSION;
        }
        ?>
    </span>
</div>
