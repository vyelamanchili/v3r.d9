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
class redMigratorModelCleanup extends RModelAdmin
{
	/**
	 * Cleanup
	 *
	 * @return	none
	 * @since	1.2.0
	 */
	function cleanup()
	{
		// Loading the helper
		JLoader::import('helpers.redmigrator', JPATH_COMPONENT_ADMINISTRATOR);
		// Importing helper tags
		jimport('cms.helper.tags');
		// Getting the component parameter with global settings
		$params = redMigratorHelper::getParams();

		// If REST is enable, cleanup the source #__redMigrator_steps table
		if ($params->method == 'rest') {
			$driver = redMigratorDriver::getInstance();
			$code = $driver->requestRest('cleanup');
		}

		// Set all cid, status and cache to 0
		$query = $this->_db->getQuery(true);
		$query->update('#__redmigrator_steps')->set('cid = 0, status = 0, cache = 0');
		$this->_db->setQuery($query)->execute();

		// Convert the params to array
		$core_skips = (array) $params;

		// Skiping the steps setted by user
		foreach ($core_skips as $k => $v) {
			$core = substr($k, 0, 9);
			$name = substr($k, 10, 18);

			if ($core == "skip_core") {
				if ($v == 1) {
					$query->clear();
					// Set all status to 0 and clear state
					$query->update('#__redmigrator_steps')->set('status = 2')->where("name = '{$name}'");

					try {
						$this->_db->setQuery($query)->execute();
					} catch (RuntimeException $e) {
						throw new RuntimeException($e->getMessage());
					}

					$query->clear();

					if ($name == 'users') {
						$query->update('#__redmigrator_steps')->set('status = 2')->where('name = \'arogroup\'');

						try {
							$this->_db->setQuery($query)->execute();
						} catch (RuntimeException $e) {
							throw new RuntimeException($e->getMessage());
						}

						$query->clear();
						$query->update('#__redmigrator_steps')->set('status = 2')->where('name = \'usergroupmap\'');

						try {
							$this->_db->setQuery($query)->execute();
						} catch (RuntimeException $e) {
							throw new RuntimeException($e->getMessage());
						}
					}

					if ($name == 'categories') {
						$query->update('#__redmigrator_steps')->set('status = 2')->where('name = \'sections\'');

						try {
							$this->_db->setQuery($query)->execute();
						} catch (RuntimeException $e) {
							throw new RuntimeException($e->getMessage());
						}
					}

				}
			}

			if ($k == 'skip_extensions') {
				if ($v == 1) {
					$query->clear();
					$query->update('#__redmigrator_steps')->set('status = 2')->where('name = \'extensions\'');

					try {
						$this->_db->setQuery($query)->execute();
					} catch (RuntimeException $e) {
						throw new RuntimeException($e->getMessage());
					}
				}
			}
		}

		// Truncate the selected tables
		$tables = array();
		$tables[] = '#__redmigrator_categories';
		$tables[] = '#__redmigrator_menus';
		$tables[] = '#__redmigrator_modules';
		$tables[] = '#__redmigrator_default_categories';
		$tables[] = '#__menu_types';
		$tables[] = '#__content';

		for ($i=0;$i<count($tables);$i++) {
			$query->clear();
			$query->delete()->from("{$tables[$i]}");

			try {
				$this->_db->setQuery($query)->execute();
			} catch (RuntimeException $e) {
				throw new RuntimeException($e->getMessage());
			}
		}

		// Cleanup the menu table
		if ($params->skip_core_menus != 1) {

			// Insert needed value
			$query->clear();
			$query->insert('#__redmigrator_menus')->columns('`old`, `new`')->values("0, 0");

			try {
				$this->_db->setQuery($query)->execute();
			} catch (RuntimeException $e) {
				throw new RuntimeException($e->getMessage());
			}

			// Clear the default database
			$query->clear();
			$query->delete()->from('#__redmigrator_default_menus')->where('id > 100');

			try {
				$this->_db->setQuery($query)->execute();
			} catch (RuntimeException $e) {
				throw new RuntimeException($e->getMessage());
			}

			// Getting the menus
			$query->clear();
			// 3.0 Changes
			if (version_compare(PHP_VERSION, '3.0', '>=')) {
				$query->select("`menutype`, `title`, `alias`, `note`, `path`, `link`, `type`, `published`, `parent_id`, `component_id`, `checked_out`, `checked_out_time`, `browserNav`, `access`, `img`, `template_style_id`, `params`, `home`, `language`, `client_id`");
			}else{
				$query->select("`menutype`, `title`, `alias`, `note`, `path`, `link`, `type`, `published`, `parent_id`, `component_id`, `ordering`, `checked_out`, `checked_out_time`, `browserNav`, `access`, `img`, `template_style_id`, `params`, `home`, `language`, `client_id`");
			}

			$query->from("#__menu");
			$query->where("id > 100");
			$query->where("alias != 'home'");
			$query->order('id ASC');
			$this->_db->setQuery($query);

			try {
				$menus = $this->_db->loadObjectList();
			} catch (RuntimeException $e) {
				throw new RuntimeException($e->getMessage());
			}

			foreach ($menus as $menu)
			{
				// Convert the array into an object.
				$menu = (object) $menu;

				try {
					$this->_db->insertObject('#__redmigrator_default_menus', $menu);
				} catch (RuntimeException $e) {
					throw new RuntimeException($e->getMessage());
				}
			}

			// Cleanup the entire menu
			$query->clear();
			$query->delete()->from('#__menu')->where('id > 1');

			try {
				$this->_db->setQuery($query)->execute();
			} catch (RuntimeException $e) {
				throw new RuntimeException($e->getMessage());
			}
		}

		// Delete uncategorised categories
		if ($params->skip_core_categories != 1) {

			// Insert uncategorized id
			$query->clear();
			$query->insert('#__redmigrator_categories')->columns('`old`, `new`')->values("0, 2");
			try {
				$this->_db->setQuery($query)->execute();
			} catch (RuntimeException $e) {
				throw new RuntimeException($e->getMessage());
			}

			// Getting the menus
			$query->clear();
			$query->select("`id`, `parent_id`, `path`, `extension`, `title`, `alias`, `note`, `description`, `published`,  `params`, `created_user_id`");
			$query->from("#__categories");
			$query->where("id > 1");
			$query->order('id ASC');
			$this->_db->setQuery($query);

			try {
				$categories = $this->_db->loadObjectList();
			} catch (RuntimeException $e) {
				throw new RuntimeException($e->getMessage());
			}


			foreach ($categories as $category)
			{
				$id = $category->id;
				unset($category->id);

				$this->_db->insertObject('#__redmigrator_default_categories', $category);

				// Getting the categories table
				$table = JTable::getInstance('Category', 'JTable');
				// Load it before delete. Joomla bug?
				$table->load($id);
				// Delete
				$table->delete($id);
			}
		}

		// Change the id of the admin user
		if ($params->skip_core_users != 1) {

			// Getting the data
			$query->clear();
			$query->select("username");
			$query->from("#__users");
			$query->where("name = 'Super User'");
			$query->order('id ASC');
			$query->limit(1);
			$this->_db->setQuery($query);

			try {
				$superuser = $this->_db->loadResult();
			} catch (RuntimeException $e) {
				throw new RuntimeException($e->getMessage());
			}

			// Updating the super user id to 10
			$query->clear();
			$query->update("#__users");
			$query->set("`id` = 10");
			$query->where("username = '{$superuser}'");
			// Execute the query
			try {
				$this->_db->setQuery($query)->execute();
			} catch (RuntimeException $e) {
				throw new RuntimeException($e->getMessage());
			}

			// Updating the user_usergroup_map
			$query->clear();
			$query->update("#__user_usergroup_map");
			$query->set("`user_id` = 10");
			$query->where("`group_id` = 8");
			// Execute the query
			try {
				$this->_db->setQuery($query)->execute();
			} catch (RuntimeException $e) {
				throw new RuntimeException($e->getMessage());
			}
		}

		// Checking if modules were added.
		if ($params->skip_core_modules != 1) {
			$query->clear();
			$query->select('id');
			$query->from("`#__modules`");
			$query->order('id DESC');
			$query->limit(1);
			$this->_db->setQuery($query);

			try {
				$modules_id = $this->_db->loadResult();
			} catch (RuntimeException $e) {
				throw new RuntimeException($e->getMessage());
			}

			if ($modules_id > 86) {
				$query->clear();
				$query->update('#__redmigrator_steps')->set('status = 2')->where('name = \'modules\'');
				try {
					$this->_db->setQuery($query)->execute();
				} catch (RuntimeException $e) {
					throw new RuntimeException($e->getMessage());
				}

				$query->clear();
				$query->update('#__redmigrator_steps')->set('status = 2')->where('name = \'modules_menu\'');
				try {
					$this->_db->setQuery($query)->execute();
				} catch (RuntimeException $e) {
					throw new RuntimeException($e->getMessage());
				}
			}

			// Cleanup the modules for 'site' unused modules
			$query->clear();
			$query->delete()->from('#__modules')->where('client_id = 0');

			try {
				$this->_db->setQuery($query)->execute();
			} catch (RuntimeException $e) {
				throw new RuntimeException($e->getMessage());
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
		echo json_encode($message);
		exit;
	}

} // end class
