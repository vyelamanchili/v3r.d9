<?php
// No direct access
defined('_JEXEC') or die('Restricted access');

use Maximenuck\CKFof;
use Maximenuck\Helper;

// load the lightbox
Helper::loadCkbox();

// vars
$modal = $this->input->get('layout', '') == 'modal' ? true : false;
$user = JFactory::getUser();
$userId = $user->get('id');
$isModal = $this->input->get('layout', '', 'string') == 'modal';
$function = $this->input->get('returnFunc', 'ckSelectStyle', 'string');
$appendUrl = $isModal ? '&layout=modal&tmpl=component' : '';

// for ordering
$listOrder = $this->state->get('filter_order', 'a.id');
$listDirn = $this->state->get('filter_order_Dir', 'ASC');
$filter_search = $this->state->get('filter_search', '');
$limitstart = $this->state->get('limitstart', 0);
$limit = $this->state->get('limit', 20);
?>
<style>
	body.contentpane {
		padding: 125px 10px;
	}
<?php
// load styles for joomla 3 for frontend edition
if (version_compare(JVERSION, '4', '<')) {
?>
	#toolbar .btn {
		display: inline-block;
		*display: inline;
		*zoom: 1;
		padding: 4px 12px;
		margin-bottom: 0;
		font-size: 12px;
		line-height: 18px;
		text-align: center;
		vertical-align: middle;
		cursor: pointer;
		background: #f3f3f3;
		color: #333;
		border: 1px solid #b3b3b3;
		-webkit-border-radius: 3px;
		-moz-border-radius: 3px;
		border-radius: 3px;
		box-shadow: 0 1px 2px rgba(0,0,0,0.05);
	}
	#toolbar .btn:hover, #toolbar .btn:focus {
		background: #e6e6e6;
		text-decoration: none;
		text-shadow: none;
	}
	#toolbar .btn-wrapper {
		display: inline-block;
		margin: 0 0 8px 5px;
	}
	#toolbar .btn-small {
		padding: 2px 10px;
		font-size: 12px;
		-webkit-border-radius: 3px;
		-moz-border-radius: 3px;
		border-radius: 3px;
	}
	#toolbar .btn {
		line-height: 24px;
		margin-right: 4px;
		padding: 0 10px;
	}
	#toolbar .btn-success {
		min-width: 148px;
	}
	#toolbar .btn-success {
		border: 1px solid #378137;
		border: 1px solid rgba(0,0,0,0.2);
		color: #fff;
		background: #46a546;
	}
	#toolbar [class^="icon-"], #toolbar [class*=" icon-"] {
		display: inline-block;
		width: 14px;
		height: 14px;
		margin-right: .25em;
		line-height: 14px;
	}
	#toolbar [class^="icon-"], #toolbar [class*=" icon-"] {
		background-color: #e6e6e6;
		border-radius: 3px 0 0 3px;
		border-right: 1px solid #b3b3b3;
		height: auto;
		line-height: inherit;
		margin: 0 6px 0 -10px;
		opacity: 1;
		text-shadow: none;
		width: 28px;
		z-index: -1;
	}
	#toolbar .btn-success [class^="icon-"] {
		background-color: transparent;
		border-right: 0;
		border-left: 0;
		width: 16px;
		margin-left: 0;
		margin-right: 0;
	}
<?php
}
?>
</style>
<form action="<?php echo JRoute::_('index.php?option=com_maximenuck&view=styles'.$appendUrl); ?>" method="post" name="adminForm" id="adminForm">
	<?php if ($isModal) { ?>
	<div id="ckheader">
		<div class="ckheaderlogo"><a href="https://www.joomlack.fr" target="_blank"><img title="JoomlaCK" src="https://media.joomlack.fr/images/logo_ck_white.png" width="35" height="35"></a></div>
		<div class="ckheadermenu">
			<div class="ckheadertitle">MAXIMENUCK CK - <?php echo JText::_('CK_STYLES'); ?></div>
		</div>
	</div>
	<div id="cktoolbar-fixed">
		<?php echo $this->toolbar->render(); ?>
	</div>
	<?php }  else {
		Helper::addSidebar();
	} ?>
	<div class="ckadminarea">
	<div id="filter-bar" class="btn-toolbar">
		<div class="filter-search ckbutton-group">
			<label for="filter_search" class="element-invisible"><?php echo JText::_('JSEARCH_FILTER_LABEL'); ?></label>
			<input type="text" name="filter_search" id="filter_search" placeholder="<?php echo JText::_('JSEARCH_FILTER'); ?>" value="<?php echo $this->state->get('filter_search'); ?>" class="hasTooltip" title="" />
			<button type="submit" class="ckbutton hasTooltip" title="<?php echo JText::_('JSEARCH_FILTER_SUBMIT'); ?>"><i class="icon-search"></i></button>
			<button type="button" class="ckbutton hasTooltip" title="<?php echo JText::_('JSEARCH_FILTER_CLEAR'); ?>" onclick="this.form.filter_search.value = '';
					this.form.submit();"><i class="icon-remove"></i></button>
		</div>
			<div class="ckbutton-group pull-right hidden-phone">
				<label for="limit" class="element-invisible"><?php echo JText::_('JFIELD_PLG_SEARCH_SEARCHLIMIT_DESC'); ?></label>
			<?php echo $this->pagination->getLimitBox(); ?>
			</div>
	</div>
	<table class="table table-striped" id="itemsList">
		<thead>
			<tr>
				<?php if (CKFof::userCan('create') || CKFof::userCan('edit')) { ?>
				<th width="1%">
					<input type="checkbox" name="checkall-toggle" title="<?php echo JText::_('JGLOBAL_CHECK_ALL'); ?>" value="" onclick="Joomla.checkAll(this)" />
				</th>
				<?php } ?>
				<th class='left'>
					<?php echo JHtml::_('grid.sort', 'JGLOBAL_TITLE', 'a.name', $listDirn, $listOrder); ?>
				</th>
				<th width="1%" class="nowrap">
					<?php echo JHtml::_('grid.sort', 'JGRID_HEADING_ID', 'a.id', $listDirn, $listOrder); ?>
				</th>
			</tr>
		</thead>
		<tbody>
			<?php
			foreach ($this->items as $i => $item) :
				$link = 'index.php?option=com_maximenuck&view=style&layout=edit&tmpl=component&id=' . $item->id;
				$name = $item->name ? $item->name : 'style' . $item->id;
				?>
				<tr class="row<?php echo $i % 2; ?>">
					<?php if (CKFof::userCan('create') || CKFof::userCan('edit')) { ?>
					<td class="center">
						<?php echo JHtml::_('grid.id', $i, $item->id); ?>
					</td>
					<?php } ?>
					<td>
						<?php if ($modal) { ?>
						<a href="javascript:void(0)" onclick="window.parent.<?php echo $function ?>('<?php echo $item->id; ?>', '<?php echo $name; ?>')"><?php echo $name; ?></a>
						<?php /*<a href="<?php echo JUri::root(true) . '/administrator/' . $link ?>" class="ckbutton"><?php echo JText::_('CK_EDIT'); ?></a>*/ ?>
						<?php } else { ?>
						<a onclick="CKBox.open({handler:'iframe', fullscreen: true, url:'<?php echo JUri::root(true) . '/administrator/' . $link ?>'})" href="#"><?php echo $name; ?></a>
						<?php } ?>
					</td>
					<td class="center">
					<?php echo (int) $item->id; ?>
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
	<?php echo $this->pagination->getListFooter() ?>
	<div>
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>" />
		<input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>" />
		<?php CKFof::renderToken() ?>
	</div>
	</div>
</form>