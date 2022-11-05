<?php
Namespace Maximenuck;

// No direct access
defined('_JEXEC') or die;

require_once JPATH_ADMINISTRATOR . '/components/com_maximenuck/helpers/defines.php';
require_once JPATH_ADMINISTRATOR . '/components/com_maximenuck/helpers/style.php';

use Maximenuck\CKInput;
use Maximenuck\CKFof;
use Maximenuck\CKText;
use Maximenuck\Style;

/**
 * Helper Class.
 */
class Helper {

	static $cssreplacements;

	public static function addSidebar($vName = '') {
		$input = CKFof::getInput();
		if (!$vName) $vName = $input->get('view', 'modules', 'cmd');

		\JHtmlSidebar::addEntry(
				CKText::_('CK_MODULES'), MAXIMENUCK_ADMIN_URL . '&view=modules', $vName == 'modules'
		);
		\JHtmlSidebar::addEntry(
				CKText::_('CK_JOOMLA_MENUS'), MAXIMENUCK_ADMIN_URL . '&view=joomlamenus', $vName == 'joomlamenus'
		);
		// \JHtmlSidebar::addEntry(
				// CKText::_('CK_MAXI_MENUS'), MAXIMENUCK_ADMIN_URL . '&view=maximenus', $vName == 'maximenus'
		// );
		\JHtmlSidebar::addEntry(
				CKText::_('CK_STYLES'), MAXIMENUCK_ADMIN_URL . '&view=styles', $vName == 'styles'
		);
		\JHtmlSidebar::addEntry(
				CKText::_('CK_ABOUT'), MAXIMENUCK_ADMIN_URL . '&view=about', $vName == 'about'
		);
		echo '<style>.ckadminarea {
	float: left;
	width: calc(100% - 230px);

}
.ckadminsidebar {
	float: left;
	width: 220px;
	margin-right: 10px;
}
@media only screen and (max-width:640px) {
	.ckadminsidebar, .ckadminarea {
		float: none; width: inherit;
	}
}
</style>
<div class="ckadminsidebar">' . \JHtmlSidebar::render() . '</div>';
	}

	/*
	 * Load the JS and CSS files needed to use CKBox
	 *
	 * Return void
	 */
	public static function loadCkbox() {
		\JHtml::_('jquery.framework', true);
		CKFof::addStyleSheet(MAXIMENUCK_MEDIA_URI . '/assets/ckbox.css');
		CKFof::addScript(MAXIMENUCK_MEDIA_URI . '/assets/ckbox.js');
	}

	public static function loadCkboxInline() {
		CKFof::addStyleSheetInline(MAXIMENUCK_MEDIA_URI . '/assets/ckbox.css');
		CKFof::addScriptInline(MAXIMENUCK_MEDIA_URI . '/assets/ckbox.js');
	}

	public static function htmlTemplateItem($item) {
		if (is_array($item)) $item = CKFof::convertArrayToObject ($item);

		if (stristr($item->settings, '|qq|thirdparty|qq|:|qq|1|qq|')) {
			$item->titleClass = ' ckbadge ckbadge-success';
		} else {
			$item->titleClass = '';
		}
		echo '<div class="ck-menu-item" data-type="' . $item->type . '" data-level="' . $item->level . '" data-id="' . $item->id . '"  data-settings="' . self::encodeChars($item->settings) . '">';
			echo '<div class="ck-menu-item-row">'
					. '<span class="ck-menu-item-title' . $item->titleClass . '">' . $item->title . '</span>'
					. '<span class="ck-menu-item-desc">' . $item->desc . '</span>'
				. '</div>';

			echo '<div class="ck-submenu" data-type="submenu">';
				echo '<div class="ck-columns">';

				if (! empty($item->submenu->columns)) {
					foreach ($item->submenu->columns as $column) {
						if ($column->break == 1) {
							echo '<div class="ck-column-break"></div>';
						} else {
							echo '<div class="ck-column">';
							if (! empty($column->children)) {
								foreach ($column->children as $child) {
									self::htmlTemplateItem($child);
								}
							}
							echo '</div>';
						}
					}
				} else {
					echo '<div class="ck-column"></div>';
				}
				echo '</div>';
			echo '</div>'; // close submenu
		echo '</div>'; // close item
	}

	public static function decodeChars($a) {
		$search = array('|quot|'
			, '|qq|'
			, '|ob|'
			, '|cb|'
			, '|tt|'
			, '|rr|'
			);
		$replace = array('"'
			, '"'
			, '{'
			, '}'
			, "\t"
			, "\n"
			);
		return str_replace($search, $replace, $a);
	}

	public static function encodeChars($a) {
		$search = array('"'
			, '"'
			, '{'
			, '}'
			, "\t"
			, "\n"
			);
		$replace = array('|quot|'
			, '|qq|'
			, '|ob|'
			, '|cb|'
			, '|tt|'
			, '|rr|'
			);
		return str_replace($search, $replace, $a);
	}

	/*
	 * Make empty slide object
	 */
	public static function initItem() {
		$item = new \stdClass();
		$item->image = null;
		$item->link = null;
		$item->title = null;
		$item->text = null;
		$item->desc = null;
		$item->more = array();
		$item->settings = null;
		$item->type = 'menuitem';
		$item->target = 'default';
		$item->level = null;
		$item->id = null;

		return $item;
	}

	/**
	 * Get the name of the style
	 */
	public static function getStyleNameById($id) {
		if (! $id) return '';

		$result = CKFof::dbLoadResult('SELECT name from #__maximenuck_styles WHERE id = "' . $id . '" AND (state IN (0, 1))');

		return $result;
	}

	/**
	 * Get the name of the menu
	 */
	public static function getJoomlaMenuNameById($menutype) {
		if (! $menutype) return '';

		$result = CKFof::dbLoadResult('SELECT title from #__menu_types WHERE menutype = "' . $menutype . '"');

		return $result;
	}

	/**
	 * Get the list of the menus
	 */
	public static function getJoomlaMenus() {
		$result = CKFof::dbLoadObjectList('SELECT id,title,menutype from #__menu_types');

		return $result;
	}

	public static function checkDbIntegrity() {
//		self::searchColumn('stylecode', 'longtext');
		self::searchTable('maximenuck_menus');
		self::searchTable('maximenuck_styles');
	}

	private static function searchColumn($name, $type = 'text', $table = 'maximenuck_styles') {
		$db = JFactory::getDbo();
		// test if the widget columns not exists
		$query = "SHOW COLUMNS FROM #__" . $table . " LIKE '" . $name . "'";
		$db->setQuery($query);
		if ($db->execute()) {
			if ( $db->loadResult()) {
				//echo 'existe deja!';return;
			} else {
				// add the SQL field to the main table
				$db->setQuery('ALTER TABLE `#__' . $table . '` ADD `' . $name . '` ' . $type . ' NOT NULL;');
				if (!$db->execute()) {
					echo '<p class="alert alert-danger">Error during table column ' . $name . ' update process !</p>';
				} else {
					echo '<p class="alert alert-success">Table column ' . $name . ' updated !</p>';
				}
			}
		} else {
			echo 'SQL error - Check existing ' . $name . ' column';
			return false;
		}
	}

	/**
	 * Look if the table exists, if not then create it
	 * 
	 * @param type $tableName
	 */
	private static function searchTable($tableName) {
		$db = CKFof::getDbo();
		$tablesList = $db->getTableList();
		$tableExists = in_array($db->getPrefix() . $tableName, $tablesList);
		// test if the table not exists

		if (! $tableExists) {
			self::createTable($tableName);
		}
	}

	private static function createTable($tableName) {
		switch ($tableName) {
			case 'maximenuck_styles' :
				$query = "CREATE TABLE IF NOT EXISTS `#__maximenuck_styles` (
	  `id` int(10) NOT NULL AUTO_INCREMENT,
	  `name` text NOT NULL,
	  `state` int(10) NOT NULL DEFAULT '1',
	  `params` longtext NOT NULL,
	  `layoutcss` text NOT NULL,
	  `customcss` text NOT NULL,
	  `checked_out` varchar(10) NOT NULL,
	  PRIMARY KEY (`id`)
	) DEFAULT CHARSET=utf8;";
				break;
			case 'maximenuck_menus' :
				$query = "CREATE TABLE IF NOT EXISTS `#__maximenuck_menus` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `state` int(10) NOT NULL DEFAULT '1',
  `params` longtext NOT NULL,
  `layouthtml` text NOT NULL,
  `layoutcss` text NOT NULL,
  PRIMARY KEY (`id`)
) DEFAULT CHARSET=utf8;";
				break;
			default :
				break;
		} 

		$db = CKFof::getDbo();
		$db->setQuery($query);
		if (! $db->execute($query)) {
			echo '<p class="alert alert-danger">Error during table ' . $tableName . ' creation process !</p>';
		} else {
			echo '<p class="alert alert-success">Table ' . $tableName . ' created with success !</p>';
		}
	}

	/**
	 * Get the CSS of the style
	 * @id - the style ID
	 */
	public static function getStyleLayoutcss($id) {
		if (! $id) return '';

		// Create a new query object.
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);

		// Select the required fields from the table.
		$query->select('a.layoutcss');
		$query->from($db->quoteName('#__maximenuck_styles') . ' AS a');
		$query->where('(a.state IN (0, 1))');
		$query->where('a.id = ' . (int)$id);

		// Reset the query using our newly populated query object.
		$db->setQuery($query);

		// Load the results as a list of stdClass objects (see later for more options on retrieving data).
		$result = $db->loadResult();

		self::makeCssReplacement($result);

		return $result;
	}

	public static function makeCssReplacement(&$css) {
		$cssreplacements = Style::getCssReplacement();
		foreach ($cssreplacements as $tag => $rep) {
			$css = str_replace($tag, $rep, $css);
		}
//		return $css;
	}

	/** 
	* Custom function loaded from the module options to check the version compatibility
	*/
	public static function isV9($value = '0', $moduleId = 0) {
		// module already exists ?
		$moduleId = \JFactory::getApplication()->input->get('id', $moduleId, 'int');

		if ($moduleId > 0) {
			$module = CKFof::dbLoad('#__modules', $moduleId);
			$moduleParams = new \JRegistry;
			$moduleParams->loadString($module->params);
			$value = $moduleParams->get('isv9', '1');
		}

		// module saved with V9
		$isV9 = $value == '1' ? '1' : ($moduleId > 0 ? '0' : '1'); 

		return $isV9;
	}

	/**
	 * Test if there is already a unit, else add the px
	 *
	 * @param string $value
	 * @return string
	 */
	public static function testUnit($value) {
		if (
			(stristr($value, 'px')) 
			OR (stristr($value, 'em')) 
			OR (stristr($value, 'rem')) 
			OR (stristr($value, '%')) 
			OR (stristr($value, 'vh')) 
			OR (stristr($value, 'vw')) 
			OR (stristr($value, 'vmin')) 
			OR (stristr($value, 'vmax')) 
			OR (stristr($value, 'mm')) 
			OR (stristr($value, 'in')) 
			OR (stristr($value, 'pt')) 
			OR (stristr($value, 'pc')) 
			OR $value == 'auto'
			)
			return $value;

		if ($value == '') {
			$value = 0;
		}

		return $value . 'px';
	}

	/**
	 * Convert a hexa decimal color code to its RGB equivalent
	 *
	 * @param string $hexStr (hexadecimal color value)
	 * @param boolean $returnAsString (if set true, returns the value separated by the separator character. Otherwise returns associative array)
	 * @param string $seperator (to separate RGB values. Applicable only if second parameter is true.)
	 * @return array or string (depending on second parameter. Returns False if invalid hex color value)
	 */
	static function hex2RGB($hexStr, $opacity) {
		if ($opacity > 1) $opacity = $opacity/100;
		$hexStr = preg_replace("/[^0-9A-Fa-f]/", '', $hexStr); // Gets a proper hex string
		$rgbArray = array();
		if (strlen($hexStr) == 6) { //If a proper hex code, convert using bitwise operation. No overhead... faster
			$colorVal = hexdec($hexStr);
			$rgbArray['red'] = 0xFF & ($colorVal >> 0x10);
			$rgbArray['green'] = 0xFF & ($colorVal >> 0x8);
			$rgbArray['blue'] = 0xFF & $colorVal;
		} elseif (strlen($hexStr) == 3) { //if shorthand notation, need some string manipulations
			$rgbArray['red'] = hexdec(str_repeat(substr($hexStr, 0, 1), 2));
			$rgbArray['green'] = hexdec(str_repeat(substr($hexStr, 1, 1), 2));
			$rgbArray['blue'] = hexdec(str_repeat(substr($hexStr, 2, 1), 2));
		} else {
			return false; //Invalid hex color code
		}
		$rgbacolor = "rgba(" . $rgbArray['red'] . "," . $rgbArray['green'] . "," . $rgbArray['blue'] . "," . $opacity . ")";

		return $rgbacolor;
	}

	public static function getProMessage() {
		$html = '<div class="ckinfo"><i class="fas fa-info"></i><a href="https://www.joomlack.fr/en/joomla-extensions/maximenu-ck" target="_blank">' . CKText::_('MAXIMENUCK_ONLY_PRO') . '</a></div>';
	
		return $html;
	}
}
