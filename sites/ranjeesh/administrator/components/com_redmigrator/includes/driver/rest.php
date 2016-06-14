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
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die;

/**
 * redMigrator RESTful utility class
 *
 * @package		redMigrator
 */
class redMigratorDriverRest extends redMigratorDriver
{	

	function __construct(redMigratorStep $step = null)
	{
		parent::__construct($step);
	}

	/**
	 * Get the raw data for this part of the upgrade.
	 *
	 * @return	array	Returns a reference to the source data array.
	 * @since	0.4.4
	 * @throws	Exception
	 */
	public function &getRestData()
	{
		$data = array();
	
		// Setting the headers for REST
		$rest_username = $this->params->rest_username;
		$rest_password = $this->params->rest_password;
		$rest_key = $this->params->rest_key;

		// Setting the headers for REST
		$str = $rest_username.":".$rest_password;
		$data['Authorization'] = base64_encode($str);

		// Encoding user
		$user_encode = $rest_username.":".$rest_key;
		$data['AUTH_USER'] = base64_encode($user_encode);
		// Sending by other way, some servers not allow AUTH_ values
		$data['USER'] = base64_encode($user_encode);

		// Encoding password
		$pw_encode = $rest_password.":".$rest_key;
		$data['AUTH_PW'] = base64_encode($pw_encode);
		// Sending by other way, some servers not allow AUTH_ values
		$data['PW'] = base64_encode($pw_encode);

		// Encoding key
		$key_encode = $rest_key.":".$rest_key;
		$data['KEY'] = base64_encode($key_encode);

		return $data;
	}

	/**
	 * Get a single row
	 *
	 * @return   step object
	 */
	public function requestRest($task = 'total', $table = false) {

		$http = JHttpFactory::getHttp();
		$data = $this->getRestData();

		// Getting the total
		$data['task'] = $task;
		$data['table'] = ($table != false) ? $table : '';
		$request = $http->get($this->params->rest_hostname.'/index.php', $data);

		$code = $request->code;

		if ($code == 500) {
			throw new Exception('COM_REDMIGRATOR_REDMIGRATOR_ERROR_REST_REQUEST');
		} else {
			return ($code == 200 || $code == 301) ? $request->body : $code;
		}
	}

	/**
	 * Get the raw data for this part of the upgrade.
	 *
	 * @return	array	Returns a reference to the source data array.
	 * @since 3.0.0
	 * @throws	Exception
	 */
	public function &getSourceDataRest($table = null)
	{
		// Declare rows
		$rows = array();
		// Cleanup		
		$cleanup = $this->requestRest('cleanup', $table);
		// Total
		$total = $this->requestRest('total', $table);

		for ($i=1;$i<=$total;$i++) {		
			$response = $this->requestRest('row', $table);
			if ($response != '') {
				$rows[$i] = json_decode($response);
			}
		}

		return $rows;
	}

	/**
	 * Get the raw data for this part of the upgrade.
	 *
	 * @return	array	Returns a reference to the source data array.
	 * @since	3.0.0
	 * @throws	Exception
	 */
	public function &getSourceDataRestIndividual($table = null)
	{
		$rows = array();
		$response = $this->requestRest('row', $table);

		if ($response != '') {
			$rows[] = json_decode($response);
		}

		return $rows;
	}

	/**
	 * Get total of the rows of the table
	 *
	 * @access	public
	 * @return	int	The total of rows
	 */
	public function getTotal()
	{
		$total = $this->requestRest('total', $this->_getStepName());

		return (int)$total;
	}

	/**
 	* 
	* @param string $table The table name
	*/
	function tableExists ($table) { 
		return $this->requestRest("tableexists", $table);
	}
}
