<?php

/**
 * @package             Joomla
 * @subpackage          CoalaWeb JSColor Field
 * @author              Steven Palmer
 * @author url          https://coalaweb.com
 * @author email        support@coalaweb.com
 * @license             GNU/GPL V3 or later; https://www.gnu.org/licenses/gpl-3.0.html
 * @copyright           Copyright (c) 2020 Steven Palmer All rights reserved.
 *
 * CoalaWeb Social Links is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.

 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 */
defined('JPATH_BASE') or die;

jimport('joomla.form.formfield');

/**
 * Form Field class for the Joomla Framework.
 *
 * @package		Joomla.Framework
 * @subpackage          Form
 * @since		1.6
 */
class JFormFieldJSColor extends JFormField {

    /**
     * The form field type.
     *
     * @var		string
     * @since	1.6
     */
    protected $type = 'JSColor';

    /**
     * Method to get the field input markup.
     *
     * @return	string	The field input markup.
     * @since	1.6
     */
    protected function getInput() {
        $baseurl = JURI::base(true);
        $baseurl = str_replace('administrator', '', $baseurl);
        $scriptname = $this->element['scriptpath'] ? (string) $this->element['scriptpath'] : $baseurl . 'media/coalaweb/modules/generic/js/jscolor/jscolor.js';

        //try to find the script
        if ($scriptname == 'self') {
            $filedir = str_replace(JPATH_SITE . '/', '', dirname(__FILE__));
            $filedir = str_replace('\\', '/', $filedir);
            $scriptname = $baseurl . $filedir . '/jscolor.js';
        }


        $doc = JFactory::getDocument();
        $doc->addScript($scriptname);

        // Initialize JavaScript field attributes.
        $onchange = $this->element['onchange'] ? ' onchange="' . (string) $this->element['onchange'] . '"' : '';

        $class = ' class="color {required:false}"';

        return
                '<input type="text" name="' . $this->name . '" id="' . $this->id . '"' .
                ' value="' . htmlspecialchars($this->value, ENT_COMPAT, 'UTF-8') . '"' .
                $class . $onchange . '/>';
    }

}
