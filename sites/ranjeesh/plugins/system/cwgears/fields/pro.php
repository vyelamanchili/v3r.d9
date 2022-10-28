<?php

/**
 * @package     Joomla
 * @subpackage  CoalaWeb Gears
 * @author      Steven Palmer <support@coalaweb.com>
 * @link        https://coalaweb.com/
 * @license     GNU/GPL V3 or later; https://www.gnu.org/licenses/gpl-3.0.html
 * @copyright   Copyright (c) 2020 Steven Palmer All rights reserved.
 *
 * CoalaWeb Gears is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.

 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 */

defined('_JEXEC') or die('Restricted access');

/**
 * Class JFormFieldPRO
 */
class JFormFieldPRO extends JFormField {

    protected $type = 'pro';

    /**
     * @return string
     */
    public function getInput() {
        $text = JText::_('PLG_CWGEARS_PRO_ONLY');
        
        $output[] = '<div class="cw-pro">';
        $output[] = '<code>' . $text . '</code>';
        $output[] = '</div>';

        return implode("\n", $output);
    }

}
