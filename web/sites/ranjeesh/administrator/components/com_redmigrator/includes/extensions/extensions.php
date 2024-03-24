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
/**
 * Upgrade class for 3rd party extensions
 *
 * This class search for extensions to be migrated
 *
 * @since	0.4.5
 */
class redMigratorCheckExtensions extends redMigratorExtensions
{
	/**
	 * count adapters
	 * @var int
	 * @since	1.1.0
	 */
	public $count = 0;
	protected $extensions = array();

	public function upgrade()
	{
		if (!$this->upgradeComponents()) {
			return false;
		}

		if (!$this->upgradeModules()) {
			return false;
		}

		if (!$this->upgradePlugins()) {
			return false;
		}

		return ($this->_processExtensions() == 0) ? false : true;
	}

	/**
	 * Upgrade the components
	 *
	 * @return	
	 * @since	1.1.0
	 * @throws	Exception
	 */
	protected function upgradeComponents()
	{
		// Getting the step
		$step = redMigratorStep::getInstance('ext_components', true);

		// Get redMigratorExtensionsComponents instance
		$components = redMigrator::getInstance($step);
		$rows = $components->dataSwitch();

		$this->_addExtensions ( $rows, 'com' );

		$step->status = 2;
		$step->_updateStep(true);

		return true;
	}

	/**
	 * Upgrade the modules
	 *
	 * @return	
	 * @since	1.1.0
	 * @throws	Exception
	 */
	protected function upgradeModules()
	{
		// Getting the step
		$step = redMigratorStep::getInstance('ext_modules', true);

		// Get redMigratorExtensionsModules instance
		$modules = redMigrator::getInstance($step);
		$rows = $modules->dataSwitch();

		$this->_addExtensions ( $rows, 'mod' );

		$step->status = 2;
		$step->_updateStep(true);

		return true;
	}

	/**
	 * Upgrade the plugins
	 *
	 * @return
	 * @since	1.1.0
	 * @throws	Exception
	 */
	protected function upgradePlugins()
	{
		// Getting the step
		$step = redMigratorStep::getInstance('ext_plugins', true);

		// Get redMigratorExtensionsPlugins instance
		$plugins = redMigrator::getInstance($step);
		$rows = $plugins->dataSwitch();

		$this->_addExtensions ( $rows, 'plg' );

		$step->status = 2;
		$step->_updateStep(true);

		return true;
	}

	/**
	 * Get the raw data for this part of the upgrade.
	 *
	 * @return	array	Returns a reference to the source data array.
	 * @since	0.4.5
	 * @throws	Exception
	 *
	protected function upgradeTemplates()
	{
		$this->destination = "#__extensions";

		$folders = JFolder::folders(JPATH_ROOT.DS.'templates');
		$folders = array_diff($folders, array("system", "beez"));
		sort($folders);
		//print_r($folders);

		$rows = array();
		// Do some custom post processing on the list.
		foreach($folders as $folder) {

			$row = array();
			$row['name'] = $folder;
			$row['type'] = 'template';
			$row['element'] = $folder;
			$row['params'] = '';
			$rows[] = $row;
		}

		$this->_addExtensions ( $rows, 'tpl' );
		return true;
	}*/

	protected function _addExtensions( $rows, $prefix )
	{
		// Create new indexed array
		foreach ($rows as &$row)
		{
			// Convert the array into an object.
			$row = (object) $row;
			$row->id = null;
			$row->element = strtolower($row->element);

			// Ensure that name is always using form: xxx_folder_name
			$name = preg_replace('/^'.$prefix.'_/', '', $row->element);
			if (!empty($row->folder)) {
				$element = preg_replace('/^'.$row->folder.'_/', '', $row->element);
				$row->name = ucfirst($row->folder).' - '.ucfirst($element);
				$name = $row->folder.'_'.$element;
			}
			$name = $prefix .'_'. $name;
			$this->extensions[$name] = $row;
		}
	}

	/**
	 * Get the raw data for this part of the upgrade.
	 *
	 * @return	array	Returns a reference to the source data array.
	 * @since 1.1.0
	 * @throws	Exception
	 */
	protected function _processExtensions()
	{
		jimport('joomla.filesystem.folder');

		$types = array(
			'/^com_(.+)$/e',									// com_componentname
			'/^mod_(.+)$/e',									// mod_modulename
			'/^plg_(.+)_(.+)$/e',								// plg_folder_pluginname
			'/^tpl_(.+)$/e');									// tpl_templatename

		$classes = array(
			"'redMigratorComponent'.ucfirst('\\1')",				// redMigratorComponentComponentname
			"'redMigratorModule'.ucfirst('\\1')",					// redMigratorModuleModulename
			"'redMigratorPlugin'.ucfirst('\\1').ucfirst('\\2')",	// redMigratorPluginPluginname
			"'redMigratorTemplate'.ucfirst('\\1')");				// redMigratorTemplateTemplatename

		// Getting the plugins list
		$query = $this->_db->getQuery(true);
		$query->select('*');
		$query->from('#__extensions');
		$query->where("type = 'plugin'");
		$query->where("folder = 'redmigrator'");
		$query->where("enabled = 1");

		// Setting the query and getting the result
		$this->_db->setQuery($query);
		$plugins = $this->_db->loadObjectList();

		// Do some custom post processing on the list.
		foreach ($plugins as $plugin)
		{
			// Looking for xml files
			$files = (array) JFolder::files(JPATH_PLUGINS."/redmigrator/{$plugin->element}/extensions", '\.xml$', true, true);

			foreach ($files as $xmlfile)
			{
				if (!empty($xmlfile)) {

					$element = JFile::stripExt(basename($xmlfile));

					if (array_key_exists($element, $this->extensions)) {

						$extension = $this->extensions[$element];

						// Read xml definition file
						$xml = simplexml_load_file($xmlfile);

						// Getting the php file
						if (!empty($xml->installer->file[0])) {
							$phpfile = JPATH_ROOT.'/'.trim($xml->installer->file[0]);
						}
						if (empty($phpfile)) {
							$default_phpfile = JPATH_PLUGINS."/redmigrator/{$plugin->element}/extensions/{$element}.php";
							$phpfile = file_exists($default_phpfile) ? $default_phpfile : null;
						}

						// Getting the class
						if (!empty($xml->installer->class[0])) {
							$class = trim($xml->installer->class[0]);
						}
						if (empty($class)) {
							$class = preg_replace($types, $classes, $element);
						}

						// Saving the extensions and migrating the tables
						if ( !empty($phpfile) || !empty($xmlfile) ) {

							// Adding +1 to count
							$this->count = $this->count+1;

							// Reset the $query object
							$query->clear();

							$xmlpath = "{$plugin->element}/extensions/{$element}.xml";

							// Inserting the step to #__redMigrator_extensions table
							$query->insert('#__redmigrator_extensions')->columns('`name`, `title`, `class`, `xmlpath`')->values("'{$element}', '{$xml->name}', '{$class}', '{$xmlpath}'");
							$this->_db->setQuery($query);
							$this->_db->execute();

							// Inserting the collection if exists
							if (isset($xml->name) && isset($xml->collection)) {
								$query->insert('#__update_sites')->columns('name, type, location, enabled')
									->values("'{$xml->name}', 'collection',  '{$xml->collection}, 1");
								$this->_db->setQuery($query);
								$this->_db->execute();
							}

							// Converting the params
							$extension->params = $this->convertParams($extension->params);

							// Saving the extension to #__extensions table
							if (!$this->_db->insertObject('#__extensions', $extension)) {
								throw new Exception($this->_db->getErrorMsg());
							}

							// Getting the extension id
							$extension->id = $this->_db->insertid();

							// Adding tables to migrate
							if (!empty($xml->tables[0])) {

								// Check if tables must to be replaced
								$main_replace = (string) $xml->tables->attributes()->replace;

								$count = count($xml->tables[0]->table);

								for($i=0;$i<$count;$i++) {
									//
									$table = new StdClass();
									$table->name = $table->source = $table->destination = (string) $xml->tables->table[$i];
									$table->eid = $extension->id;
									$table->element = $element;
									$table->class = $class;
									$table->replace = (string) $xml->tables->table[$i]->attributes()->replace;
									$table->replace = !empty($table->replace) ? $table->replace : $main_replace;

									$exists = $this->_driver->tableExists($table->name);

									if ($exists == 'YES'){
										if (!$this->_db->insertObject('#__redmigrator_extensions_tables', $table)) {
											throw new Exception($this->_db->getErrorMsg());
										}
									}
								}
							}

							// Add other extensions from the package
							if (!empty($xml->package[0])) {
								foreach ($xml->package[0]->extension as $xml_ext) {
									if (isset($this->extensions[(string) $xml_ext->name])) {
										$extension = $this->extensions[(string) $xml_ext->name];
										$state->extensions[] = (string) $xml_ext->name;

										$extension->params = $this->convertParams($extension->params);
										if (!$this->_db->insertObject('#__extensions', $extension)) {
											throw new Exception($this->_db->getErrorMsg());
										}
										unset ($this->extensions[(string) $xml_ext->name]);
									}
								}
							}

						} //end if

					} // end if

				} // end if

				unset($class);
				unset($phpfile);
				unset($xmlfile);

			} // end foreach
		} // end foreach

		return $this->count;
	}
} // end class
