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

JLoader::register('redMigrator', JPATH_COMPONENT_ADMINISTRATOR.'/includes/redmigrator.class.php');
JLoader::register('redMigratorDriver', JPATH_COMPONENT_ADMINISTRATOR.'/includes/redmigrator.driver.class.php');
JLoader::register('redMigratorStep', JPATH_COMPONENT_ADMINISTRATOR.'/includes/redmigrator.step.class.php');

/**
 * redMigrator Model
 *
 * @package		redMigrator
 */
class redMigratorModelChecks extends RModelAdmin
{
	/**
	 * Initial checks in redMigrator
	 *
	 * @return	none
	 * @since	1.2.0
	 */
	function checks()
	{
		// Loading the helper
		JLoader::import('helpers.redmigrator', JPATH_COMPONENT_ADMINISTRATOR);

		// Getting the component parameter with global settings
		$params = redMigratorHelper::getParams();

		// Checking tables
		$tables = $this->_db->getTableList();

		// Check if the tables exists if not populate install.sql
		$tablesComp = array();
		$tablesComp[] = 'categories';
		$tablesComp[] = 'default_categories';
		$tablesComp[] = 'default_menus';
		$tablesComp[] = 'errors';
		$tablesComp[] = 'extensions';
		$tablesComp[] = 'extensions_tables';
		$tablesComp[] = 'files_images';
		$tablesComp[] = 'files_media';
		$tablesComp[] = 'files_templates';
		$tablesComp[] = 'menus';
		$tablesComp[] = 'modules';
		$tablesComp[] = 'steps';

		foreach ($tablesComp as $table) {
			if (!in_array($this->_db->getPrefix() . 'redmigrator_' . $table, $tables)) {
				if (redMigratorHelper::isCli()) {
					print("\n\033[1;37m-------------------------------------------------------------------------------------------------\n");
					print("\033[1;37m|  \033[0;34m	Installing redMigrator tables\n");
				}

				redMigratorHelper::populateDatabase($this->_db, JPATH_COMPONENT_ADMINISTRATOR.'/sql/install.sql');
				break;
			}
		}

		// Define the message array
		$message = array();
		$message['status'] = "ERROR";

		// Getting the data
		$query = $this->_db->getQuery(true);
		$query->select('COUNT(id)');
		$query->from("`#__redmigrator_steps`");
		$this->_db->setQuery($query);
		$nine = $this->_db->loadResult();

		if ($nine < 10) {
			throw new Exception('COM_REDMIGRATOR_ERROR_TABLE_STEPS_NOT_VALID');
		}

		// Check safe_mode_gid
		if (@ini_get('safe_mode_gid') && @ini_get('safe_mode')) {
			throw new Exception('COM_REDMIGRATOR_ERROR_DISABLE_SAFE_GID');
		}

		// Check for bad configurations
		if ($params->method == "rest") {

			if (!isset($params->rest_hostname) || !isset($params->rest_username) || !isset($params->rest_password) || !isset($params->rest_key) ) {
				throw new Exception('COM_REDMIGRATOR_ERROR_REST_CONFIG');
			}

			if ($params->rest_hostname == 'http://www.example.org/' || $params->rest_hostname == '' || 
					$params->rest_username == '' || $params->rest_password == '' || $params->rest_key == '') {
				throw new Exception('COM_REDMIGRATOR_ERROR_REST_CONFIG');
			}

			// Checking the RESTful connection
			$driver = redMigratorDriver::getInstance();
			$code = $driver->requestRest('check');

			switch ($code) {
				case 401:
					throw new Exception('COM_REDMIGRATOR_ERROR_REST_501');
				case 402:
					throw new Exception('COM_REDMIGRATOR_ERROR_REST_502');
				case 403:
					throw new Exception('COM_REDMIGRATOR_ERROR_REST_503');
				case 405:
					throw new Exception('COM_REDMIGRATOR_ERROR_REST_505');
				case 406:
					throw new Exception('COM_REDMIGRATOR_ERROR_REST_506');
			}
		}

		// Check for bad configurations
		if ($params->method == "database") {
			if ($params->old_hostname == '' || $params->old_username == '' || $params->old_db == '' || $params->old_dbprefix == '' ) {
				throw new Exception('COM_REDMIGRATOR_ERROR_DATABASE_CONFIG');
			}
		}

		// Convert the params to array
		$core_skips = (array) $params;
		$flag = false;

		// Check is all skips is set
		foreach ($core_skips as $k => $v) {
			$core = substr($k, 0, 9);
			$name = substr($k, 10, 18);

			if ($core == "skip_core") {
				if ($v == 0) {
					$flag = true;
				}
			}
		}

		if ($flag === false) {
			throw new Exception('COM_REDMIGRATOR_ERROR_SKIPS_ALL');				
		}		

		// Checking tables
		if ($params->skip_core_contents != 1) {
			$query->clear();
			$query->select('COUNT(id)');
			$query->from("`#__content`");
			$this->_db->setQuery($query);
			$content_count = $this->_db->loadResult();

			if ($content_count > 0) {
				throw new Exception('COM_REDMIGRATOR_ERROR_DATABASE_CONTENT');
			}
		}

		// Checking tables
		if ($params->skip_core_users != 1) {
			$query->clear();
			$query->select('COUNT(id)');
			$query->from("`#__users`");
			$this->_db->setQuery($query);
			$users_count = $this->_db->loadResult();

			if ($users_count > 1) {
				throw new Exception('COM_REDMIGRATOR_ERROR_DATABASE_USERS');
			}
		}

		// Done checks
		if (!redMigratorHelper::isCli())
			$this->returnError (100, 'DONE');
	}

	/**
	 * returnError
	 *
	 * @return	none
	 * @since	2.5.0
	 */
	public function returnError ($number, $text)
	{
		$message['number'] = $number;
		$message['text'] = JText::_($text);
		print(json_encode($message));
		exit;
	}

} // end class
