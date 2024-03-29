<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
use Joomla\CMS\Factory;
use Joomla\CMS\Uri\Uri;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Language\Text;
use Joomla\Registry\Registry;
use Joomla\CMS\HTML\HTMLHelper;

/**
 * Content Component HTML Helper
 *
 * @package     Joomla.Site
 * @subpackage  com_content
 * @since       1.5
 */
abstract class JHtmlIcon
{
	/**
	 * Method to generate a link to the create item page for the given category
	 *
	 * @param   object    $category  The category information
	 * @param   Registry  $params    The item parameters
	 * @param   array     $attribs   Optional attributes for the link
	 * @param   boolean   $legacy    True to use legacy images, false to use icomoon based graphic
	 *
	 * @return  string  The HTML markup for the create item link
	 */
	public static function create($category, $params, $attribs = array(), $legacy = false)
	{
		HTMLHelper::_('bootstrap.tooltip');

		$uri = Uri::getInstance();

		$url = 'index.php?option=com_content&task=article.add&return=' . base64_encode($uri) . '&a_id=0&catid=' . $category->id;

		if ($params->get('show_icons'))
		{
			if ($legacy)
			{
				$text = HTMLHelper::_('image', 'system/new.png', Text::_('JNEW'), null, true);
			}
			else
			{
				$text = '<span class="fa fa-plus"></span>&#160;' . Text::_('JNEW') . '&#160;';
			}
		}
		else
		{
			$text = Text::_('JNEW') . '&#160;';
		}

		// Add the button classes to the attribs array
		if (isset($attribs['class']))
		{
			$attribs['class'] = $attribs['class'] . ' btn btn-primary';
		}
		else
		{
			$attribs['class'] = 'btn btn-primary';
		}

		$button = HTMLHelper::_('link', Route::_($url), $text, $attribs);

		$output = '<span class="hasTooltip" title="' . T3J::tooltipText('COM_CONTENT_CREATE_ARTICLE') . '">' . $button . '</span>';

		return $output;
	}

	/**
	 * Method to generate a link to the email item page for the given article
	 *
	 * @param   object     $article  The article information
	 * @param   JRegistry  $params   The item parameters
	 * @param   array      $attribs  Optional attributes for the link
	 * @param   boolean    $legacy   True to use legacy images, false to use icomoon based graphic
	 *
	 * @return  string  The HTML markup for the email item link
	 */
	public static function email($article, $params, $attribs = array(), $legacy = false)
	{
		require_once JPATH_SITE . '/components/com_mailto/helpers/mailto.php';

		$uri      = Uri::getInstance();
		$base     = $uri->toString(array('scheme', 'host', 'port'));
		$template = Factory::getApplication()->getTemplate();
		$link     = $base . Route::_(ContentHelperRoute::getArticleRoute($article->slug, $article->catid, $article->language), false);
		$url      = 'index.php?option=com_mailto&tmpl=component&template=' . $template . '&link=' . MailToHelper::addLink($link);

		$status = 'width=400,height=350,menubar=yes,resizable=yes';

		if ($params->get('show_icons'))
		{
			if ($legacy)
			{
				$text = HTMLHelper::_('image', 'system/emailButton.png', Text::_('JGLOBAL_EMAIL'), null, true);
			}
			else
			{
				$text = '<span class="fa fa-envelope"></span> ' . Text::_('JGLOBAL_EMAIL');
			}
		}
		else
		{
			$text = Text::_('JGLOBAL_EMAIL');
		}

		$attribs['title']   = Text::_('JGLOBAL_EMAIL');
		$attribs['onclick'] = "window.open(this.href,'win2','" . $status . "'); return false;";

		$output = HTMLHelper::_('link', Route::_($url), $text, $attribs);

		return $output;
	}

	/**
	 * Display an edit icon for the article.
	 *
	 * This icon will not display in a popup window, nor if the article is trashed.
	 * Edit access checks must be performed in the calling code.
	 *
	 * @param   object     $article  The article information
	 * @param   JRegistry  $params   The item parameters
	 * @param   array      $attribs  Optional attributes for the link
	 * @param   boolean    $legacy   True to use legacy images, false to use icomoon based graphic
	 *
	 * @return  string	The HTML for the article edit icon.
	 * @since   1.6
	 */
	public static function edit($article, $params, $attribs = array(), $legacy = false)
	{
		$user = Factory::getUser();
		$uri  = Uri::getInstance();

		// Ignore if in a popup window.
		if ($params && $params->get('popup'))
		{
			return;
		}

		// Ignore if the state is negative (trashed).
		if ($article->state < 0)
		{
			return;
		}

		HTMLHelper::_('bootstrap.tooltip');

		// Show checked_out icon if the article is checked out by a different user
		if (property_exists($article, 'checked_out') && property_exists($article, 'checked_out_time') && $article->checked_out > 0 && $article->checked_out != $user->get('id'))
		{
			$checkoutUser = Factory::getUser($article->checked_out);

			$date         = HTMLHelper::_('date', $article->checked_out_time);
			$tooltip      = Text::_('JLIB_HTML_CHECKED_OUT') . ' :: ' . Text::sprintf('COM_CONTENT_CHECKED_OUT_BY', $checkoutUser->name)
				. ' <br /> ' . $date;

			if ($legacy)
			{
				$button = HTMLHelper::_('image', 'system/checked_out.png', null, null, true);
				$text   = '<span class="hasTooltip" title="' . HTMLHelper::tooltipText($tooltip . '', 0) . '">'
					. $button . '</span> ' . Text::_('JLIB_HTML_CHECKED_OUT');
			}
			else
			{
				$text = '<span class="hasTooltip icon-lock" title="' . T3J::tooltipText($tooltip . '', 0) . '"></span> ' . Text::_('JLIB_HTML_CHECKED_OUT');
			}

			$output = HTMLHelper::_('link', '#', $text, $attribs);

			return $output;
		}

		$url = 'index.php?option=com_content&task=article.edit&a_id=' . $article->id . '&return=' . base64_encode($uri);

		if ($article->state == 0)
		{
			$overlib = Text::_('JUNPUBLISHED');
		}
		else
		{
			$overlib = Text::_('JPUBLISHED');
		}

		$date   = HTMLHelper::_('date', $article->created);
		$author = $article->created_by_alias ? $article->created_by_alias : $article->author;

		$overlib .= '&lt;br /&gt;';
		$overlib .= $date;
		$overlib .= '&lt;br /&gt;';
		$overlib .= Text::sprintf('COM_CONTENT_WRITTEN_BY', htmlspecialchars($author, ENT_COMPAT, 'UTF-8'));
		$publishUp = $article->publish_up != null ? $article->publish_up : '';
		$publishDown = $article->publish_down != null ? $article->publish_down : '';
		if ($legacy)
		{
			$icon = $article->state ? 'edit.png' : 'edit_unpublished.png';
			if (strtotime($publishUp) > strtotime(Factory::getDate())
				|| ((strtotime($publishDown) < strtotime(Factory::getDate())) && $article->publish_down != Factory::getDbo()->getNullDate()))
			{
				$icon = 'edit_unpublished.png';
			}
			$text = HTMLHelper::_('image', 'system/' . $icon, Text::_('JGLOBAL_EDIT'), null, true);
		}
		else
		{
			$icon = $article->state ? 'edit' : 'eye-close';
			if (strtotime($publishUp) > strtotime(Factory::getDate())
				|| ((strtotime($publishDown) < strtotime(Factory::getDate())) && $article->publish_down != Factory::getDbo()->getNullDate()))
			{
				$icon = 'eye-close';
			}
			$text = '<span class="hasTooltip fa fa-' . $icon . ' tip" title="' . T3J::tooltipText(Text::_('COM_CONTENT_EDIT_ITEM'), $overlib, 0) . '"></span>&#160;' . Text::_('JGLOBAL_EDIT') . '&#160;';
		}

		$output = HTMLHelper::_('link', Route::_($url), $text, $attribs);

		return $output;
	}

	/**
	 * Method to generate a popup link to print an article
	 *
	 * @param   object     $article  The article information
	 * @param   JRegistry  $params   The item parameters
	 * @param   array      $attribs  Optional attributes for the link
	 * @param   boolean    $legacy   True to use legacy images, false to use icomoon based graphic
	 *
	 * @return  string  The HTML markup for the popup link
	 */
	public static function print_popup($article, $params, $attribs = array(), $legacy = false)
	{
		$app = Factory::getApplication();
		$input = $app->input;
		$request = $input->request;

		$url  = ContentHelperRoute::getArticleRoute($article->slug, $article->catid, $article->language);
		$url .= '&tmpl=component&print=1&layout=default&page=' . @ $request->limitstart;

		$status = 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=480,directories=no,location=no';

		// checks template image directory for image, if non found default are loaded
		if ($params->get('show_icons'))
		{
			if ($legacy)
			{
				$text = HTMLHelper::_('image', 'system/printButton.png', Text::_('JGLOBAL_PRINT'), null, true);
			}
			else
			{
				$text = '<span class="fa fa-print"></span>&#160;' . Text::_('JGLOBAL_PRINT') . '&#160;';
			}
		}
		else
		{
			$text = Text::_('JGLOBAL_PRINT');
		}

		$attribs['title']   = Text::_('JGLOBAL_PRINT');
		$attribs['onclick'] = "window.open(this.href,'win2','" . $status . "'); return false;";
		$attribs['rel']     = 'nofollow';

		return HTMLHelper::_('link', Route::_($url), $text, $attribs);
	}

	/**
	 * Method to generate a link to print an article
	 *
	 * @param   object     $article  Not used, @deprecated for 4.0
	 * @param   JRegistry  $params   The item parameters
	 * @param   array      $attribs  Not used, @deprecated for 4.0
	 * @param   boolean    $legacy   True to use legacy images, false to use icomoon based graphic
	 *
	 * @return  string  The HTML markup for the popup link
	 */
	public static function print_screen($article, $params, $attribs = array(), $legacy = false)
	{
		// Checks template image directory for image, if none found default are loaded
		if ($params->get('show_icons'))
		{
			if ($legacy)
			{
				$text = HTMLHelper::_('image', 'system/printButton.png', Text::_('JGLOBAL_PRINT'), null, true);
			}
			else
			{
				$text = '<span class="fa fa-print"></span>&#160;' . Text::_('JGLOBAL_PRINT') . '&#160;';
			}
		}
		else
		{
			$text = Text::_('JGLOBAL_PRINT');
		}

		return '<a href="#" onclick="window.print();return false;">' . $text . '</a>';
	}

}
