<?php
defined('_JEXEC') or die('Restricted access');

/**
 * @package             Joomla
 * @subpackage          CoalaWeb Social Links Component
 * @author              Steven Palmer
 * @author url          http://coalaweb.com
 * @author email        support@coalaweb.com
 * @license             GNU/GPL, see /assets/en-GB.license.txt
 * @copyright           Copyright (c) 2017 Steven Palmer All rights reserved.
 *
 * CoalaWeb Social Links is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.

 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.

 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */
JHtml::_('jquery.framework');
$user = JFactory::getUser();
$lang = JFactory::getLanguage();

$doc= JFactory::getDocument();
$doc->addScript(JURI::root(true) . '/media/coalawebsocial/components/sociallinks/js/sweetalert.min.js');
$doc->addStyleSheet(JURI::root(true) . '/media/coalawebsocial/components/sociallinks/css/sweetalert.css')
?>

<?php if ($this->needsdlid): ?>
    <div id="dlid" class="well">
        <div class="row-fluid">
            <?php echo JText::_('COM_CWSOCIALLINKS_NODOWNLOADID_GENERAL_MESSAGE'); ?>

            <form name="dlidform" action="index.php" method="post" class="form-inline">
                <input type="text" name="dlid" placeholder="<?php echo JText::_('COM_CWSOCIALLINKS_DLID') ?>" class="input-xlarge">
                <button type="submit" class="btn btn-info">
                    <span class="icon icon-unlock"></span>
                    <?php echo JText::_('COM_CWSOCIALLINKS_DLID_BTN') ?>
                </button>
                <input type="hidden" name="option" value="com_coalawebsociallinks" />
                <input type="hidden" name="view" value="controlpanel" />
                <input type="hidden" name="task" value="controlpanel.applydlid" />
                <input type="hidden" name="<?php echo JFactory::getSession()->getFormToken() ?>" value="1" />
            </form>
        </div>
    </div>
<?php endif; ?>
<div id="cpanel-v2" class="span8 well">
    <div class="row-fluid">

    <?php if ($this->isPro): ?>
        <div style="float:<?php echo ($lang->isRTL()) ? 'right' : 'left'; ?>;">
        <div class="icon">
            <a class="green-light" href="index.php?option=com_coalawebsociallinks&view=counts">
                <img alt="<?php echo JText::_('COM_CWSOCIALLINKS_TITLE_COUNTS'); ?>" src="<?php echo JURI::root() ?>/media/coalaweb/components/generic/images/icons/icon-48-cw-count-v2.png" />
                <span><?php echo JText::_('COM_CWSOCIALLINKS_TITLE_COUNTS'); ?></span>
            </a>
        </div>
    </div>
    <?php endif; ?>
        
    <?php if ($this->isPro): ?>
        <div style="float:<?php echo ($lang->isRTL()) ? 'right' : 'left'; ?>;">
            <div class="icon">
                <a class="red-dark purge-sociallinks" href="index.php?option=com_coalawebsociallinks&task=controlpanel.purge">
                    <img alt="<?php echo JText::_('COM_CWSOCIALLINKS_TITLE_PURGE'); ?>" src="<?php echo JURI::root() ?>/media/coalaweb/components/generic/images/icons/icon-48-cw-trash-v2.png" />
                    <span><?php echo JText::_('COM_CWSOCIALLINKS_TITLE_PURGE'); ?></span>
                </a>
            </div>
        </div>
    <?php endif; ?>
        
    <?php if ($this->isPro): ?>
        <div style="float:<?php echo ($lang->isRTL()) ? 'right' : 'left'; ?>;">
            <div class="icon">
                <a class="orange-dark optimize" href="index.php?option=com_coalawebsociallinks&task=controlpanel.optimize">
                    <img alt="<?php echo JText::_('COM_CWSOCIALLINKS_TITLE_OPTIMIZE'); ?>" src="<?php echo JURI::root() ?>/media/coalaweb/components/generic/images/icons/icon-48-cw-speed-v2.png" />
                    <span><?php echo JText::_('COM_CWSOCIALLINKS_TITLE_OPTIMIZE'); ?></span>
                </a>
            </div>
        </div>
    <?php endif; ?>
        
    <div style="float:<?php echo ($lang->isRTL()) ? 'right' : 'left'; ?>;">
        <div class="icon">
            <a class="red-light" onclick="Joomla.popupWindow('http://coalaweb.com/support/documentation/item/coalaweb-social-links-guide', 'Help', 700, 500, 1)" href="#">
                <img alt="<?php echo JText::_('COM_CWSOCIALLINKS_TITLE_HELP'); ?>" src="<?php echo JURI::root() ?>/media/coalaweb/components/generic/images/icons/icon-48-cw-support-v2.png" />
                <span><?php echo JText::_('COM_CWSOCIALLINKS_TITLE_HELP'); ?></span>
            </a>
        </div>
    </div>

    <div style="float:<?php echo ($lang->isRTL()) ? 'right' : 'left'; ?>;">
        <div class="icon">
                <a class="blue-light" href="index.php?option=com_config&view=component&component=com_coalawebsociallinks">
                    <img alt="<?php echo JText::_('COM_CWSOCIALLINKS_TITLE_OPTIONS'); ?>" src="<?php echo JURI::root() ?>/media/coalaweb/components/generic/images/icons/icon-48-cw-options-v2.png" />
                    <span><?php echo JText::_('COM_CWSOCIALLINKS_TITLE_OPTIONS'); ?></span>
                </a>
        </div>
    </div>
    
    <?php if (!$this->isPro): ?>
        <div style="float:<?php echo ($lang->isRTL()) ? 'right' : 'left'; ?>;">
            <div class="icon">
                <a class="pink-light" href="http://coalaweb.com/extensions/joomla-extensions/coalaweb-social-links/feature-comparison" target="_blank">
                    <img alt="<?php echo JText::_('COM_CWSOCIALLINKS_TITLE_UPGRADE'); ?>" src="<?php echo JURI::root() ?>/media/coalaweb/components/generic/images/icons/icon-48-cw-upgrade-v2.png" />
                    <span><?php echo JText::_('COM_CWSOCIALLINKS_TITLE_UPGRADE'); ?></span>
                </a>
            </div>
        </div>
    <?php endif; ?>

</div>
</div>

<div id="tabs" class="span4">
    <div class="row-fluid">

    <?php
    $options = array(
        'onActive' => 'function(title, description){
        description.setStyle("display", "block");
        title.addClass("open").removeClass("closed");
    }',
        'onBackground' => 'function(title, description){
        description.setStyle("display", "none");
        title.addClass("closed").removeClass("open");
    }',
        'startOffset' => 0, // 0 starts on the first tab, 1 starts the second, etc...
        'useCookie' => true, // this must not be a string. Don't use quotes.
        'startTransition' => 1,
    );
    ?>

    <?php echo JHtml::_('sliders.start', 'slider_group_id', $options); ?>

    <?php echo JHtml::_('sliders.panel', JText::_('COM_CWSOCIALLINKS_SLIDER_TITLE_ABOUT'), 'slider_1_id'); ?>
    <div class="cw-slider well well-small">
        <?php if ($this->isPro): ?>
            <h3><?php echo JText::_('COM_CWSOCIALLINKS_TITLE_PRO'); ?></h3>
            <?php echo JText::_('COM_CWSOCIALLINKS_ABOUT_DESCRIPTION'); ?>
        <?php else : ?>
            <h3><?php echo JText::_('COM_CWSOCIALLINKS_TITLE_CORE'); ?></h3>
            <?php echo JText::_('COM_CWSOCIALLINKS_ABOUT_DESCRIPTION'); ?>
        <?php endif; ?>
    </div>

    <?php echo JHtml::_('sliders.panel', JText::_('COM_CWSOCIALLINKS_SLIDER_TITLE_SUPPORT'), 'slider_2_id'); ?>
    <div class="cw-slider well well-small">
        <?php echo JText::_('COM_CWSOCIALLINKS_SUPPORT_DESCRIPTION'); ?>
    </div>

    <?php echo JHtml::_('sliders.panel', JText::_('COM_CWSOCIALLINKS_SLIDER_TITLE_VERSION'), 'slider_3_id'); ?>
    <div class="cw-slider well well-small">
        <div class="cw-slider">
            <h3> <?php echo JText::_('COM_CWSOCIALLINKS_RELEASE_TITLE'); ?> </h3>
            <ul class="cw_module">
                <?php $type = $this->isPro === 1 ? JText::_('COM_CWSOCIALLINKS_RELEASE_TYPE_PRO') : JText::_('COM_CWSOCIALLINKS_RELEASE_TYPE_CORE'); ?>
                <li>  <?php echo JText::_('COM_CWSOCIALLINKS_FIELD_RELEASE_TYPE_LABEL'); ?>  <strong><?php echo $type; ?> </strong></li>
                <li>   <?php echo JText::_('COM_CWSOCIALLINKS_FIELD_RELEASE_VERSION_LABEL'); ?> <strong> <?php echo $this->version?> </strong></li>
                <li>  <?php echo JText::_('COM_CWSOCIALLINKS_FIELD_RELEASE_DATE_LABEL'); ?>  <strong> <?php echo $this->release_date; ?>  </strong></li>
            </ul>
        </div>
    </div>
        
    <?php if (!$this->isPro): ?>
        <?php echo JHtml::_('sliders.panel', JText::_('COM_CWSOCIALLINKS_SLIDER_TITLE_UPGRADE'), 'slider_4_id'); ?>
         <div class="cw-slider well well-small">
            <div class="cw-message-block">
                <div class="cw-message">
                    <p class="upgrade"><?php echo JText::_('COM_CWSOCIALLINKS_MSG_UPGRADE'); ?></p>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <?php echo JHtml::_('sliders.end'); ?>       
</div>
</div>
<script>
  jQuery.noConflict();
  
  jQuery('a.purge-sociallinks').click(function(e) {
    e.preventDefault(); // Prevent the href from redirecting directly
    var linkURL = jQuery(this).attr("href");
    warnBeforePurge(linkURL);
  });
  
  jQuery('a.optimize').click(function(e) {
    e.preventDefault(); // Prevent the href from redirecting directly
    var linkURL = jQuery(this).attr("href");
    warnBeforeOptimize(linkURL);
  });

  function warnBeforePurge(linkURL) {
    swal({
      title: "<?php echo JText::_('COM_CWSOCIALLINKS_PURGE_POPUP_TITLE'); ?>", 
      text: "<?php echo JText::_('COM_CWSOCIALLINKS_PURGE_POPUP_MSG'); ?>", 
      type: "warning",
      html: true,
      showCancelButton: true
    }, function() {
      // Redirect the user
      window.location.href = linkURL;
    });
  }
  
 function warnBeforeOptimize(linkURL) {
    swal({
      title: "<?php echo JText::_('COM_CWSOCIALLINKS_OPTIMIZE_POPUP_TITLE'); ?>", 
      text: "<?php echo JText::_('COM_CWSOCIALLINKS_OPTIMIZE_POPUP_MSG'); ?>", 
      type: "warning",
      html: true,
      showCancelButton: true
    }, function() {
      // Redirect the user
      window.location.href = linkURL;
    });
  }
  
  </script>









