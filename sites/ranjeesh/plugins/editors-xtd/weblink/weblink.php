<?php
/**
 * @package     Joomla.Plugin
 * @subpackage  Editors-xtd.weblink
 *
 * @copyright   Copyright (C) 2005 - 2017 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * Editor Web Link button
 *
 * @since  __DEPLOY_VERSION__
 */
class PlgButtonWeblink extends JPlugin
{
	/**
	 * Load the language file on instantiation.
	 *
	 * @var    boolean
	 * @since  __DEPLOY_VERSION__
	 */
	protected $autoloadLanguage = true;

	/**
	 * Display the button
	 *
	 * @param   string  $name  The name of the button to add
	 *
	 * @return  JObject  The button options as JObject
	 *
	 * @since  __DEPLOY_VERSION__
	 */
	public function onDisplay($name)
	{
		$user = JFactory::getUser();

		if ($user->authorise('core.create', 'com_weblinks')
			|| $user->authorise('core.edit', 'com_weblinks')
			|| $user->authorise('core.edit.own', 'com_weblinks'))
		{
			// The URL for the weblinks list
			$link = 'index.php?option=com_weblinks&amp;view=weblinks&amp;layout=modal&amp;tmpl=component&amp;'
				. JSession::getFormToken() . '=1&amp;editor=' . $name;

			$button          = new JObject;
			$button->modal   = true;
			$button->class   = 'btn';
			$button->link    = $link;
			$button->text    = JText::_('PLG_EDITORS-XTD_WEBLINK_BUTTON_WEBLINK');
			$button->name    = 'link';
			$button->options = "{handler: 'iframe', size: {x: 800, y: 500}}";

			return $button;
		}
	}
}
