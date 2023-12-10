<?php
/**
 * @package     Joomla.Site
 * @subpackage  Layout
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('JPATH_BASE') or die;
use Joomla\CMS\Factory;
use Joomla\CMS\Router\Route;
use Joomla\Registry\Registry;
use Joomla\CMS\Access\Access;

JLoader::register('TagsHelperRoute', JPATH_BASE . '/components/com_tags/helpers/route.php');

?>
<?php if (!empty($displayData)) : ?>
	<div class="tags">
		<?php foreach ($displayData as $i => $tag) : ?>
			<?php if (in_array($tag->access, Access::getAuthorisedViewLevels(Factory::getUser()->get('id')))) : ?>
				<?php $tagParams = new Registry($tag->params); ?>
				<?php $link_class = $tagParams->get('tag_link_class', 'label label-info'); ?>
				<span class="tag-<?php echo $tag->tag_id; ?> tag-list<?php echo $i ?>" itemprop="keywords">
					<a href="<?php echo Route::_(TagsHelperRoute::getTagRoute($tag->tag_id . '-' . $tag->alias)) ?>" class="<?php echo $link_class; ?>">
						<?php echo $this->escape($tag->title); ?>
					</a>
				</span>
			<?php endif; ?>
		<?php endforeach; ?>
	</div>
<?php endif; ?>
