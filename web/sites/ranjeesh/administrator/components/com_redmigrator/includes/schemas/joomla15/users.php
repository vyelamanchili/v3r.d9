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

JLoader::register("redMigratorUsersDefault", JPATH_COMPONENT_ADMINISTRATOR."/includes/redmigrator.users.class.php");

/**
 * Upgrade class for Users
 *
 * This class takes the users from the existing site and inserts them into the new site.
 *
 * @since	0.4.4
 */
class redMigratorUsers extends redMigratorUsersDefault
{
	/**
	 * Get the raw data for this part of the upgrade.
	 *
	 * @return	array	Returns a reference to the source data array.
	 * @since	0.4.4
	 * @throws	Exception
	 */
	public function &databaseHook($rows)
	{
		// Do some custom post processing on the list.
		foreach ($rows as &$row)
		{
			$row = (array) $row;

			$row['params'] = $this->convertParams($row['params']);

      // Chaging admin username and email
      if ($row['id'] == 62) {
        $row['username'] = $row['username'].'v15';
        $row['email'] = $row['email'].'v15';
      }

			// Remove unused fields. 
			$gid = 'gid';
			unset($row[$gid]);
		}
		
		return $rows;
	}

	/**
	 * Sets the data in the destination database.
	 *
	 * @return	void
	 * @since	0.4.
	 * @throws	Exception
	 */
	public function dataHook($rows)
	{
		// Do some custom post processing on the list.
		foreach ($rows as &$row)
		{
			$row = (array) $row;

			if (version_compare(PHP_VERSION, '3.0', '>=')) {
				unset($row['usertype']);
			}
		}

		return $rows;
	}

	/**
	 * A hook to be able to modify params prior as they are converted to JSON.
	 *
	 * @param	object	$object	A reference to the parameters as an object.
	 *
	 * @return	void
	 * @since	0.4.
	 * @throws	Exception
	 */
	protected function convertParamsHook(&$object)
	{
		$object->timezone = 'UTC';
	}
}
