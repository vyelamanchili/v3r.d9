<?php
/**
 * @package     redMIGRATOR.Backend
 * @subpackage  Controller
 *
 * @copyright   Copyright (C) 2005 - 2013 redCOMPONENT.com. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 *
 *  redMIGRATOR is based on JUpgradePRO made by Matias Aguirre
 */

// No direct access.
defined('_JEXEC') or die;

jimport( 'joomla.application.component.view' );

/**
 * @package		MatWare
 * @subpackage	com_jupgrade
 */
class redMigratorViewCpanel extends RView
{
	protected $componentTitle = 'red<strong>MIGRATOR</strong>';

	protected $displayTopBar = true;

	protected $topBarLayout = 'topbar';

	/**
	 * Display the view.
	 *
	 * @param	string	$tpl	The subtemplate to display.
	 *
	 * @return	void
	 */
	function display($tpl = null)
	{
		// Get params
		JLoader::import('helpers.redmigrator', JPATH_COMPONENT_ADMINISTRATOR);
		$params = redMigratorHelper::getParams();

		//
		// Joomla bug: JInstaller not save the defaults params reading config.xml
		//
		$db = JFactory::getDBO();

		if (!$params->method) {
			$default_params = '{"method":"rest","rest_hostname":"http:\/\/www.example.org\/","rest_username":"","rest_password":"","rest_key":"","path":"","driver":"mysql","hostname":"localhost","username":"","password":"","database":"","prefix":"jos_","skip_checks":"0","skip_files":"1","skip_templates":"1","skip_extensions":"1","skip_core_users":"0","skip_core_categories":"0","skip_core_sections":"0","skip_core_contents":"0","skip_core_contents_frontpage":"0","skip_core_menus":"0","skip_core_menus_types":"0","skip_core_modules":"0","skip_core_modules_menu":"0","skip_core_banners":"0","skip_core_banners_clients":"0","skip_core_banners_tracks":"0","skip_core_contacts":"0","skip_core_newsfeeds":"0","skip_core_weblinks":"0","positions":"0","debug":"0"}';

			$query = "UPDATE #__extensions SET `params` = '{$default_params}' WHERE `element` = 'com_redmigrator'";
			$db->setQuery( $query );
			$db->query();

			// Get params.. again
			$params	= redMigratorHelper::getParams();
		}

		// Load mooTools
		JHtml::_('behavior.framework', true);

		$xmlfile = JPATH_COMPONENT_ADMINISTRATOR.'/redmigrator.xml';

		$xml = JFactory::getXML($xmlfile);

		$this->params =	$params;
		$this->version = $xml->version[0];

		parent::display($tpl);
	}

	/**
	 * Get the toolbar to render.
	 *
	 * @return  RToolbar
	 */
	public function getToolbar()
	{
		$user  = JFactory::getUser();

		$firstGroup = new RToolbarButtonGroup;

		if ($user->authorise('core.admin', 'com_redmigrator.panel'))
		{
			$options = RToolbarBuilder::createRedcoreOptionsButton('com_redmigrator');
			$firstGroup->addButton($options);
		}

		$toolbar = new RToolbar;
		$toolbar->addGroup($firstGroup);

		return $toolbar;
	}
}
