<?php
// No direct access
defined('_JEXEC') or die;

use Maximenuck\CKView;
use Maximenuck\CKFof;

class MaximenuckViewIcons extends CKView {

	function display($tpl = 'default') {

		$user = JFactory::getUser();
		$authorised = ($user->authorise('core.edit', 'com_maximenuck') || (count($user->getAuthorisedCategories('com_maximenuck', 'core.edit'))));

		if ($authorised !== true)
		{
			throw new Exception(JText::_('JERROR_ALERTNOAUTHOR'), 403);
			return false;
		}

		parent::display($tpl);
	}
}
