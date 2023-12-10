<?php

/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2021 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Layout\LayoutHelper;

if (!class_exists('ContentHelperRoute')) {
  if (version_compare(JVERSION, '4', 'ge')) {
    abstract class ContentHelperRoute extends \Joomla\Component\Content\Site\Helper\RouteHelper
    {
    };
  } else {
    JLoader::register('ContentHelperRoute', $com_path . '/helpers/route.php');
  }
}

HTMLHelper::addIncludePath(JPATH_COMPONENT . '/helpers');
if (version_compare(JVERSION, '4', 'lt')) {
  HTMLHelper::_('behavior.caption');
}
HTMLHelper::_('behavior.core');

Factory::getDocument()->addScriptDeclaration("
jQuery(function($) {
  $('.categories-list').find('[id^=category-btn-]').each(function(index, btn) {
    var btn = $(btn);
    btn.on('click', function() {
      btn.find('span').toggleClass('icon-plus');
      btn.find('span').toggleClass('icon-minus');
    });
  });
});");
?>
<div class="categories-list<?php echo $this->pageclass_sfx; ?>">
  <?php
  echo LayoutHelper::render('joomla.content.categories_default', $this);
  echo $this->loadTemplate('items');
  ?>
</div>