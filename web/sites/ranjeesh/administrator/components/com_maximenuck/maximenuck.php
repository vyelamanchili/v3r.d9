<?php
/**
 * @name		Maximenu CK
 * @package		com_maximenuck
 * @copyright	Copyright (C). Since 2014, Update V9 2020. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 * @author		Cedric Keiflin - https://www.template-creator.com - https://www.joomlack.fr
 */

// no direct access
defined('_JEXEC') or die;
if (! defined('CK_LOADED')) define('CK_LOADED', 1);

include_once JPATH_ADMINISTRATOR . '/components/com_maximenuck/helpers/defines.php';

// Access check.
if (!JFactory::getUser()->authorise('core.edit', 'com_maximenuck')) {
	return JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
}

// loads the language files from the frontend
$lang	= JFactory::getLanguage();
$lang->load('com_maximenuck', JPATH_SITE . '/components/com_maximenuck', $lang->getTag(), false);
$lang->load('com_maximenuck', JPATH_SITE, $lang->getTag(), false);

// loads the helper in any case
require_once MAXIMENUCK_PATH . '/helpers/cktext.php';
require_once MAXIMENUCK_PATH . '/helpers/ckpath.php';
require_once MAXIMENUCK_PATH . '/helpers/ckfile.php';
require_once MAXIMENUCK_PATH . '/helpers/ckfolder.php';
require_once MAXIMENUCK_PATH . '/helpers/ckuri.php';
require_once MAXIMENUCK_PATH . '/helpers/ckfof.php';
require_once MAXIMENUCK_PATH . '/helpers/helper.php';
require_once MAXIMENUCK_PATH . '/helpers/ckframework.php';
require_once MAXIMENUCK_PATH . '/helpers/ckcontroller.php';
require_once MAXIMENUCK_PATH . '/helpers/ckmodel.php';
require_once MAXIMENUCK_PATH . '/helpers/ckview.php';

\Maximenuck\CKFramework::load();

// Include dependancies
require_once MAXIMENUCK_PATH . '/controller.php';

$controller	= \Maximenuck\CKController::getInstance('Maximenuck');
$controller->execute(JFactory::getApplication()->input->get('task'));
//$controller->redirect();
