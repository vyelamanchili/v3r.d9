<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_contact
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;

HTMLHelper::addIncludePath(JPATH_COMPONENT . '/helpers');
HTMLHelper::_('behavior.caption');
HTMLHelper::_('behavior.core');
?>
<div class="contact-categories categories-list<?php echo $this->pageclass_sfx;?>">

	<?php if ($this->params->get('show_page_heading')) : ?>
	<h1>
		<?php echo $this->escape($this->params->get('page_heading')); ?>
	</h1>
	<?php endif; ?>

	<?php if ($this->params->get('show_base_description')) : ?>
		<?php //If there is a description in the menu parameters use that; ?>
		<?php if($this->params->get('categories_description')) : ?>
		<div class="category-desc base-desc">
			<?php echo  HTMLHelper::_('content.prepare', $this->params->get('categories_description'), '', 'com_contact.categories'); ?>
		</div>
		<?php  else: ?>
			<?php //Otherwise get one from the database if it exists. ?>
			<?php  if ($this->parent->description) : ?>
				<div class="category-desc base-desc">
					<?php  echo HTMLHelper::_('content.prepare', $this->parent->description, '', 'com_contact.categories'); ?>
				</div>
			<?php  endif; ?>
		<?php  endif; ?>
	<?php endif; ?>

	<?php echo $this->loadTemplate('items'); ?>
</div>
