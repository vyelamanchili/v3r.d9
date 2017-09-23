<?php

defined('_JEXEC') or die('Restricted access');

/**
 * @package             Joomla
 * @subpackage          CoalaWeb Social Links Module
 * @author              Steven Palmer
 * @author url          https://coalaweb.com
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
 * along with this program.  If not, see <https://www.gnu.org/licenses/>.
 */

jimport('joomla.filesystem.file');

class ModCoalawebSocialLinksHelper {   

    /* Bookmark functions */
    function getDeliciousBookmark($title, $link, $size, $linknofollow, $popup, $linkText) {
        $linkTextOn = ($linkText ? JText::sprintf("MOD_COALAWEBSOCIALLINKS_BOOKMARK", "Delicious") : '');
        $output[] = '<li>';
        $output[] = '<a class="'.$popup.'delicious' . $size . '" href="https://del.icio.us/post?v=2&amp;url=' . $link . '&amp;title=' . $title . '" title="' . JText::sprintf("MOD_COALAWEBSOCIALLINKS_BOOKMARK", "Delicious") .'" ' . $linknofollow . ' target="_blank">' . $linkTextOn .'</a>';
        $output[] = '</li>';
        return implode("\n", $output);
    }

    function getDiggBookmark($title, $link, $size, $linknofollow, $popup, $linkText) {
        $linkTextOn = ($linkText ? JText::sprintf("MOD_COALAWEBSOCIALLINKS_BOOKMARK", "Digg") : '');
        $output[] = '<li>';
        $output[] = '<a class="' . $popup . 'digg' . $size . '" href="https://digg.com/submit?phase=2&amp;url=' . $link . '&amp;title=' . $title . '" title="' . JText::sprintf("MOD_COALAWEBSOCIALLINKS_BOOKMARK", "Digg") . '" ' . $linknofollow . ' target="_blank">' . $linkTextOn . '</a>';
        $output[] = '</li>';
        return implode("\n", $output);
    }

    function getFacebookBookmark($link, $size, $linknofollow, $popup, $appId, $linkText, $shareType) {
        $linkTextOn = ($linkText ? JText::sprintf("MOD_COALAWEBSOCIALLINKS_BOOKMARK", "Facebook") : '');
        if ($shareType == 'old'){
            $output[] =  '<li>';
            $output[] = '<a class="' . $popup . 'facebook' . $size . '" href="https://www.facebook.com/sharer/sharer.php?u=' . $link . '" title="' . JText::sprintf("MOD_COALAWEBSOCIALLINKS_BOOKMARK", "Facebook") . '" ' . $linknofollow . ' target="_blank">' . $linkTextOn . '</a>';
            $output[] = '</li>';
        }else{
            $redirect = JURI::base() . 'media/coalaweb/modules/generic/html/popup-close.html';
            $output[] = '<li>';
            $output[] = '<a class="' . $popup . 'facebook' . $size . '" href="https://www.facebook.com/dialog/share?app_id=' . $appId . '&amp;display=popup&amp;href=' . $link . '&amp;redirect_uri=' . $redirect . '" title="' . JText::sprintf("MOD_COALAWEBSOCIALLINKS_BOOKMARK", "Facebook") . '" ' . $linknofollow . ' target="_blank">' . $linkTextOn . '</a>';
            $output[] = '</li>';
        }
        return implode("\n", $output);
    }

    function getGoogleBookmark($title, $link, $size, $linknofollow, $googleIcon, $popup, $linkText) {
        $linkTextOn = ($linkText ? JText::sprintf("MOD_COALAWEBSOCIALLINKS_BOOKMARK", "Google") : '');
        $output[] = '<li>';
        $output[] = '<a class="' . $popup . $googleIcon . $size . '" href="https://plus.google.com/share?url=' . $link . '&amp;title=' . $title . '" title="' . JText::sprintf("MOD_COALAWEBSOCIALLINKS_BOOKMARK", "Google") . '" ' . $linknofollow . ' target="_blank">' . $linkTextOn . '</a>';
        $output[] = '</li>';
        return implode("\n", $output);
    }

    function getStumbleuponBookmark($title, $link, $size, $linknofollow, $popup, $linkText) {
        $linkTextOn = ($linkText ? JText::sprintf("MOD_COALAWEBSOCIALLINKS_BOOKMARK", "Stumbleupon") : '');
        $output[] = '<li>';
        $output[] = '<a class="' . $popup . 'stumbleupon' . $size . '"  href="https://www.stumbleupon.com/submit?url=' . $link . '&amp;title=' . $title . '" title="' . JText::sprintf("MOD_COALAWEBSOCIALLINKS_BOOKMARK", "Stumbleupon") . '" ' . $linknofollow . ' target="_blank">' . $linkTextOn . '</a>';
        $output[] = '</li>';
        return implode("\n", $output);
    }

    function getTwitterBookmark($title, $link, $size, $linknofollow, $via, $popup, $linkText) {
        $linkTextOn = ($linkText ? JText::sprintf("MOD_COALAWEBSOCIALLINKS_BOOKMARK", "Twitter") : '');
        $output[] = '<li>';
        $output[] = '<a class="' . $popup . 'twitter' . $size . '" href="https://twitter.com/intent/tweet?text=' . $title . '&amp;url=' . $link . '' . $via .'" title="' . JText::sprintf("MOD_COALAWEBSOCIALLINKS_BOOKMARK", "Twitter") . '" ' . $linknofollow . ' target="_blank">' . $linkTextOn . '</a>';
        $output[] = '</li>';
        return implode("\n", $output);
    }

    function getLinkedInBookmark($title, $link, $size, $linknofollow, $popup, $linkText) {
        $linkTextOn = ($linkText ? JText::sprintf("MOD_COALAWEBSOCIALLINKS_BOOKMARK", "LinkedIn") : '');
        $output[] = '<li>';
        $output[] = '<a class="' . $popup . 'linkedin' . $size . '" href="https://www.linkedin.com/shareArticle?mini=true&amp;url=' . $link . '&amp;title=' . $title . '" title="' . JText::sprintf("MOD_COALAWEBSOCIALLINKS_BOOKMARK", "LinkedIn") . '" ' . $linknofollow . ' target="_blank">' . $linkTextOn . '</a>';
        $output[] = '</li>';
        return implode("\n", $output);
    }

    function getNewsvineBookmark($title, $link, $size, $linknofollow, $popup, $linkText) {
        $linkTextOn = ($linkText ? JText::sprintf("MOD_COALAWEBSOCIALLINKS_BOOKMARK", "Newsvine") : '');
        $output[] = '<li>';
        $output[] = '<a class="' . $popup . 'newsvine' . $size . '" href="https://www.newsvine.com/_tools/seed?popoff=0&amp;u=' . $link . '&amp;title=' . $title . '" title="' . JText::sprintf("MOD_COALAWEBSOCIALLINKS_BOOKMARK", "Newsvine") . '" ' . $linknofollow . ' target="_blank">' . $linkTextOn . '</a>';
        $output[] = '</li>';
        return implode("\n", $output);
    }

    function getRedditBookmark($title, $link, $size, $linknofollow, $popup, $linkText) {
        $linkTextOn = ($linkText ? JText::sprintf("MOD_COALAWEBSOCIALLINKS_BOOKMARK", "Reddit") : '');
        $output[] = '<li>';
        $output[] = '<a class="' . $popup . 'reddit' . $size . '" href="https://reddit.com/submit?url=' . $link . '&amp;title=' . $title . '" title="' . JText::sprintf("MOD_COALAWEBSOCIALLINKS_BOOKMARK", "Reddit") . '" ' . $linknofollow . ' target="_blank">' . $linkTextOn . '</a>';
        $output[] = '</li>';
        return implode("\n", $output);
    }
    
    function getPinterestBookmark($size, $linknofollow, $linkText) {
        $linkTextOn = ($linkText ? JText::sprintf("MOD_COALAWEBSOCIALLINKS_BOOKMARK", "Pinterest") : '');
        $output[] = '<li>';
        $output[] = '<a class="pinterest' . $size . '" href="javascript:selectPinImage()" title="' . JText::sprintf("MOD_COALAWEBSOCIALLINKS_BOOKMARK", "Pinterest") . '" ' . $linknofollow . '>' . $linkTextOn . '</a>';
        $output[] = '</li>';
        return implode("\n", $output);
    }

    function getEmailBookmark($title, $link, $size, $linkText, $desc, $siteName) {
        $linkTextOn = ($linkText ? JText::sprintf("MOD_COALAWEBSOCIALLINKS_EMAIL_BM", "Email") : '');
        
        $body[] = JText::sprintf("COM_CWSOCIALLINKS_MAIL_MSG_SITE", $siteName);
        $body[] = JText::sprintf("COM_CWSOCIALLINKS_MAIL_MSG_TITLE", $title);
        if ($desc && $desc != ''){
            $body[] = JText::sprintf("COM_CWSOCIALLINKS_MAIL_MSG_DESC", $desc);
        }
        $body[] = JText::sprintf("COM_CWSOCIALLINKS_MAIL_MSG_LINK", $link);
        
        $emailBody = implode("%0D%0A", $body);
        
        $output[] = '<li>';
        $output[] = '<a class="gmail' . $size . '" href="mailto:?subject=' . str_replace(' ', '&nbsp;', JText::_("COM_CWSOCIALLINKS_MAIL_MSG_INTRO")) . '&amp;body=' . str_replace(' ', '&nbsp;', $emailBody) . '" title="' . JText::sprintf("MOD_COALAWEBSOCIALLINKS_EMAIL_BM", "Email") . '" >' . $linkTextOn . '</a>';
        $output[] = '</li>';
        return implode("\n", $output);
    }
    
    function getWhatsappBookmark($title, $link, $size, $linknofollow, $linkText) {
        $linkTextOn = ($linkText ? JText::sprintf("MOD_COALAWEBSOCIALLINKS_BOOKMARK", "WhatsApp") : '');
        $output[] = '<li>';
        $output[] = '<a class="whatsapp' . $size . '" href="whatsapp://send?text='. $title . ': '. $link . '" data-action="share/whatsapp/share" title="' . JText::sprintf("MOD_COALAWEBSOCIALLINKS_BOOKMARK", "WhatsApp") . '" ' . $linknofollow . '>' . $linkTextOn . '</a>';
        $output[] = '</li>';
        return implode("\n", $output);
    }

    /* Follow Us functions */
    function getFacebookFollow($linkfacebook, $size, $linknofollow, $popupFollow, $linkText) {
        $linkTextOn = ($linkText ? JText::sprintf("MOD_COALAWEBSOCIALLINKS_FOLLOW", "Facebook") : '');
        $output[] = '<li>';
        $output[] = '<a class="'. $popupFollow . 'facebook' . $size . '" href="https://' . $linkfacebook . '" title="' . JText::sprintf("MOD_COALAWEBSOCIALLINKS_FOLLOW", "Facebook") . '" ' . $linknofollow . ' target="_blank">' . $linkTextOn . '</a>';
        $output[] = '</li>';
        return implode("\n", $output);
    }

    function getGoogleFollow($linkgoogle, $size, $linknofollow, $googleIcon, $popupFollow, $linkText) {
        $linkTextOn = ($linkText ? JText::sprintf("MOD_COALAWEBSOCIALLINKS_FOLLOW", "Google +") : '');
        $output[] = '<li>';
        $output[] = '<a class="' . $popupFollow . $googleIcon . $size . '" href="https://' . $linkgoogle . '" title="' . JText::sprintf("MOD_COALAWEBSOCIALLINKS_FOLLOW", "Google +") . '" ' . $linknofollow . ' target="_blank">' . $linkTextOn . '</a>';
        $output[] = '</li>';
        return implode("\n", $output);
    }

    function getLinkedinFollow($linklinkedin, $size, $linknofollow, $popupFollow, $linkText) {
        $linkTextOn = ($linkText ? JText::sprintf("MOD_COALAWEBSOCIALLINKS_FOLLOW", "Linkedin") : '');
        $output[] = '<li>';
        $output[] = '<a class="' . $popupFollow . 'linkedin' . $size . '" href="https://' . $linklinkedin . '" title="' . JText::sprintf("MOD_COALAWEBSOCIALLINKS_FOLLOW", "Linkedin") . '" ' . $linknofollow . ' target="_blank">' . $linkTextOn . '</a>';
        $output[] = '</li>';
        return implode("\n", $output);
    }

    function getTwitterFollow($linktwitter, $size, $linknofollow, $popupFollow, $linkText) {
        $linkTextOn = ($linkText ? JText::sprintf("MOD_COALAWEBSOCIALLINKS_FOLLOW", "Twitter") : '');
        $output[] = '<li>';
        $output[] = '<a class="' . $popupFollow . 'twitter' . $size . '" href="https://' . $linktwitter . '" title="' . JText::sprintf("MOD_COALAWEBSOCIALLINKS_FOLLOW", "Twitter") . '" ' . $linknofollow . ' target="_blank">' . $linkTextOn . '</a>';
        $output[] = '</li>';
        return implode("\n", $output);
    }

    function getRssFollow($linkrss, $size, $linknofollow, $popupFollow, $linkText) {
        $linkTextOn = ($linkText ? JText::sprintf("MOD_COALAWEBSOCIALLINKS_FOLLOW", "RSS") : '');
        $output[] = '<li>';
        $output[] = '<a class="' . $popupFollow . 'rss' . $size . '" href="' . $linkrss . '" title="' . JText::sprintf("MOD_COALAWEBSOCIALLINKS_FOLLOW", "RSS") . '" ' . $linknofollow . ' target="_blank">' . $linkTextOn . '</a>';
        $output[] = '</li>';
        return implode("\n", $output);
    }

    function getMyspaceFollow($linkmyspace, $size, $linknofollow, $popupFollow, $linkText) {
        $linkTextOn = ($linkText ? JText::sprintf("MOD_COALAWEBSOCIALLINKS_FOLLOW", "Myspace") : '');
        $output[] = '<li>';
        $output[] = '<a class="' . $popupFollow . 'myspace' . $size . '" href="https://' . $linkmyspace . '" title="' . JText::sprintf("MOD_COALAWEBSOCIALLINKS_FOLLOW", "Myspace") . '" ' . $linknofollow . ' target="_blank">' . $linkTextOn . '</a>';
        $output[] = '</li>';
        return implode("\n", $output);
    }

    function getVimeoFollow($linkvimeo, $size, $linknofollow, $popupFollow, $linkText) {
        $linkTextOn = ($linkText ? JText::sprintf("MOD_COALAWEBSOCIALLINKS_FOLLOW", "Vimeo") : '');
        $output[] = '<li>';
        $output[] = '        <a class="' . $popupFollow . 'vimeo' . $size . '" href="https://' . $linkvimeo . '" title="' . JText::sprintf("MOD_COALAWEBSOCIALLINKS_FOLLOW", "Vimeo") . '" ' . $linknofollow . ' target="_blank">' . $linkTextOn . '</a>';
        $output[] = '</li>';
        return implode("\n", $output);
    }

    function getYoutubeFollow($linkyoutube, $size, $linknofollow, $popupFollow, $linkText) {
        $linkTextOn = ($linkText ? JText::sprintf("MOD_COALAWEBSOCIALLINKS_FOLLOW", "Youtube") : '');
        $output[] = '<li>';
        $output[] = ' <a class="' . $popupFollow . 'youtube' . $size . '" href="https://' . $linkyoutube . '" title="' . JText::sprintf("MOD_COALAWEBSOCIALLINKS_FOLLOW", "Youtube") . '" ' . $linknofollow . ' target="_blank">' . $linkTextOn . '</a>';
        $output[] = '</li>';
        return implode("\n", $output);
    }

    function getDribbleFollow($linkdribbble, $size, $linknofollow, $popupFollow, $linkText) {
        $linkTextOn = ($linkText ? JText::sprintf("MOD_COALAWEBSOCIALLINKS_FOLLOW", "Dribbble") : '');
        $output[] = '<li>';
        $output[] = ' <a class="' . $popupFollow . 'dribbble' . $size . '" href="https://' . $linkdribbble . '" title="' . JText::sprintf("MOD_COALAWEBSOCIALLINKS_FOLLOW", "Dribbble") . '" ' . $linknofollow . ' target="_blank">' . $linkTextOn . '</a>';
        $output[] = '</li>';
        return implode("\n", $output);
    }

    function getDeviantartFollow($linkdeviantart, $size, $linknofollow, $popupFollow, $linkText) {
        $linkTextOn = ($linkText ? JText::sprintf("MOD_COALAWEBSOCIALLINKS_FOLLOW", "Deviantart") : '');
        $output[] = '<li>';
        $output[] = ' <a class="' . $popupFollow . 'deviantart' . $size . '" href="https://' . $linkdeviantart . '" title="' . JText::sprintf("MOD_COALAWEBSOCIALLINKS_FOLLOW", "Deviantart") . '" ' . $linknofollow . ' target="_blank">' . $linkTextOn . '</a>';
        $output[] = '</li>';
        return implode("\n", $output);
    }

    function getContactFollow($linkcontact, $linkTargetContact, $size, $linknofollow, $popupFollow, $linkText) {
        $linkTextOn = ($linkText ? JText::sprintf("MOD_COALAWEBSOCIALLINKS_CONTACT_F", "Email") : '');
        $output[] = '<li>';
        $output[] = ' <a class="' . $popupFollow . 'gmail' . $size . '" href="' . $linkcontact . '" title="' . JText::sprintf("MOD_COALAWEBSOCIALLINKS_CONTACT_F", "Email") . '" ' . $linknofollow . ' ' . $linkTargetContact . '>' . $linkTextOn . '</a>';
        $output[] = '</li>';
        return implode("\n", $output);
    }

    function getMailFollow($linkmail, $size, $linkText) {
        $linkTextOn = ($linkText ? JText::sprintf("MOD_COALAWEBSOCIALLINKS_EMAIL_F", "Email") : '');
        $output[] = '<li style="text-indent: 0px !important;">';
        $output[] = ' <a class="gmail' . $size . '" href="mailto:' . htmlspecialchars($linkmail) . '" title="' . htmlentities(JText::sprintf("MOD_COALAWEBSOCIALLINKS_EMAIL_F", "Email")) . '" rel="nofollow" >' . $linkTextOn . '</a>';
        $output[] = '</li>';
        return implode("\n", $output);
    }

    function getEbayFollow($linkebay, $size, $linknofollow, $popupFollow, $linkText) {
        $linkTextOn = ($linkText ? JText::sprintf("MOD_COALAWEBSOCIALLINKS_FOLLOW", "Ebay") : '');
        $output[] = '<li>';
        $output[] = ' <a class="' . $popupFollow . 'ebay' . $size . '" href="https://' . $linkebay . '" title="' . JText::sprintf("MOD_COALAWEBSOCIALLINKS_FOLLOW", "Ebay") . '" ' . $linknofollow . ' target="_blank">' . $linkTextOn . '</a>';
        $output[] = '</li>';
        return implode("\n", $output);
    }

    function getTuentiFollow($linktuenti, $size, $linknofollow, $popupFollow, $linkText) {
        $linkTextOn = ($linkText ? JText::sprintf("MOD_COALAWEBSOCIALLINKS_FOLLOW", "Tuenti") : '');
        $output[] = '<li>';
        $output[] = ' <a class="' . $popupFollow . 'tuenti' . $size . '" href="https://' . $linktuenti . '" title="' . JText::sprintf("MOD_COALAWEBSOCIALLINKS_FOLLOW", "Tuenti") . '" ' . $linknofollow . ' target="_blank">' . $linkTextOn . '</a>';
        $output[] = '</li>';
        return implode("\n", $output);
    }

    function getBehanceFollow($linkbehance, $size, $linknofollow, $popupFollow, $linkText) {
        $linkTextOn = ($linkText ? JText::sprintf("MOD_COALAWEBSOCIALLINKS_FOLLOW", "Behance") : '');
        $output[] = '<li>';
        $output[] = ' <a class="' . $popupFollow . 'behance' . $size . '" href="https://' . $linkbehance . '" title="' . JText::sprintf("MOD_COALAWEBSOCIALLINKS_FOLLOW", "Behance") . '" ' . $linknofollow . ' target="_blank">' . $linkTextOn . '</a>';
        $output[] = '</li>';
        return implode("\n", $output);
    }

    function getDesignmooFollow($linkdesignmoo, $size, $linknofollow, $popupFollow, $linkText) {
        $linkTextOn = ($linkText ? JText::sprintf("MOD_COALAWEBSOCIALLINKS_FOLLOW", "Designmoo") : '');
        $output[] = '<li>';
        $output[] = ' <a class="' . $popupFollow . 'designmoo' . $size . '" href="https://' . $linkdesignmoo . '" title="' . JText::sprintf("MOD_COALAWEBSOCIALLINKS_FOLLOW", "Designmoo") . '" ' . $linknofollow . ' target="_blank">' . $linkTextOn . '</a>';
        $output[] = '</li>';
        return implode("\n", $output);
    }

    function getFlickrFollow($linkflickr, $size, $linknofollow, $popupFollow, $linkText) {
        $linkTextOn = ($linkText ? JText::sprintf("MOD_COALAWEBSOCIALLINKS_FOLLOW", "Flickr") : '');
        $output[] = '<li>';
        $output[] = ' <a class="' . $popupFollow . 'flickr' . $size . '" href="https://' . $linkflickr . '" title="' . JText::sprintf("MOD_COALAWEBSOCIALLINKS_FOLLOW", "Flickr") . '" ' . $linknofollow . ' target="_blank">' . $linkTextOn . '</a>';
        $output[] = '</li>';
        return implode("\n", $output);
    }

    function getLastfmFollow($linklastfm, $size, $linknofollow, $popupFollow, $linkText) {
        $linkTextOn = ($linkText ? JText::sprintf("MOD_COALAWEBSOCIALLINKS_FOLLOW", "Last.fm") : '');
        $output[] = '<li>';
        $output[] = ' <a class="' . $popupFollow . 'lastfm' . $size . '" href="https://' . $linklastfm . '" title="' . JText::sprintf("MOD_COALAWEBSOCIALLINKS_FOLLOW", "Last.fm") . '" ' . $linknofollow . ' target="_blank">' . $linkTextOn . '</a>';
        $output[] = '</li>';
        return implode("\n", $output);
    }

    function getPinterestFollow($linkpinterest, $size, $linknofollow, $popupFollow, $linkText) {
        $linkTextOn = ($linkText ? JText::sprintf("MOD_COALAWEBSOCIALLINKS_FOLLOW", "Pinterest") : '');
        $output[] = '<li>';
        $output[] = ' <a class="' . $popupFollow . 'pinterest' . $size . '" href="https://' . $linkpinterest . '" title="' . JText::sprintf("MOD_COALAWEBSOCIALLINKS_FOLLOW", "Pinterest") . '" ' . $linknofollow . ' target="_blank">' . $linkTextOn . '</a>';
        $output[] = '</li>';
        return implode("\n", $output);
    }

    function getTumblrFollow($linktumblr, $size, $linknofollow, $popupFollow, $linkText) {
        $linkTextOn = ($linkText ? JText::sprintf("MOD_COALAWEBSOCIALLINKS_FOLLOW", "Tumblr") : '');
        $output[] = '<li>';
        $output[] = ' <a class="' . $popupFollow . 'tumblr' . $size . '" href="https://' . $linktumblr . '" title="' . JText::sprintf("MOD_COALAWEBSOCIALLINKS_FOLLOW", "Tumblr") . '" ' . $linknofollow . ' target="_blank">' . $linkTextOn . '</a>';
        $output[] = '</li>';
        return implode("\n", $output);
    }

    function getInstagramFollow($linkinstagram, $size, $linknofollow, $popupFollow, $linkText) {
        $linkTextOn = ($linkText ? JText::sprintf("MOD_COALAWEBSOCIALLINKS_FOLLOW", "Instagram") : '');
        $output[] = '<li>';
        $output[] = ' <a class="' . $popupFollow . 'instagram' . $size . '" href="https://' . $linkinstagram . '" title="' . JText::sprintf("MOD_COALAWEBSOCIALLINKS_FOLLOW", "Instagram") . '" ' . $linknofollow . ' target="_blank">' . $linkTextOn . '</a>';
        $output[] = '</li>';
        return implode("\n", $output);
    }

    function getXingFollow($linkxing, $size, $linknofollow, $popupFollow, $linkText) {
        $linkTextOn = ($linkText ? JText::sprintf("MOD_COALAWEBSOCIALLINKS_FOLLOW", "Xing") : '');
        $output[] = '<li>';
        $output[] = ' <a class="' . $popupFollow . 'xing' . $size . '" href="https://' . $linkxing . '" title="' . JText::sprintf("MOD_COALAWEBSOCIALLINKS_FOLLOW", "Xing") . '" ' . $linknofollow . ' target="_blank">' . $linkTextOn . '</a>';
        $output[] = '</li>';
        return implode("\n", $output);
    }

    function getSpotifyFollow($linkspotify, $size, $linknofollow, $popupFollow, $linkText) {
        $linkTextOn = ($linkText ? JText::sprintf("MOD_COALAWEBSOCIALLINKS_FOLLOW", "Spotify") : '');
        $output[] = '<li>';
        $output[] = ' <a class="' . $popupFollow . 'spotify' . $size . '" href="https://' . $linkspotify . '" title="' . JText::sprintf("MOD_COALAWEBSOCIALLINKS_FOLLOW", "Spotify") . '" ' . $linknofollow . ' target="_blank">' . $linkTextOn . '</a>';
        $output[] = '</li>';
        return implode("\n", $output);
    }

    function getBloggerFollow($linkblogger, $size, $linknofollow, $popupFollow, $linkText) {
        $linkTextOn = ($linkText ? JText::sprintf("MOD_COALAWEBSOCIALLINKS_FOLLOW", "Blogger") : '');
        $output[] = '<li>';
        $output[] = ' <a class="' . $popupFollow . 'blogger' . $size . '" href="https://' . $linkblogger . '" title="' . JText::sprintf("MOD_COALAWEBSOCIALLINKS_FOLLOW", "Blogger") . '" ' . $linknofollow . ' target="_blank">' . $linkTextOn . '</a>';
        $output[] = '</li>';
        return implode("\n", $output);
    }

    function getTripadvisorFollow($linktripadvisor, $size, $linknofollow, $popupFollow, $linkText) {
        $linkTextOn = ($linkText ? JText::sprintf("MOD_COALAWEBSOCIALLINKS_FOLLOW", "Tripadvisor") : '');
        $output[] = '<li>';
        $output[] = ' <a class="' . $popupFollow . 'tripadvisor' . $size . '" href="https://' . $linktripadvisor . '" title="' . JText::sprintf("MOD_COALAWEBSOCIALLINKS_FOLLOW", "Tripadvisor") . '" ' . $linknofollow . ' target="_blank">' . $linkTextOn . '</a>';
        $output[] = '</li>';
        return implode("\n", $output);
    }

    function getAndroidFollow($linkandroid, $size, $linknofollow, $popupFollow, $linkText) {
        $linkTextOn = ($linkText ? JText::sprintf("MOD_COALAWEBSOCIALLINKS_FOLLOW", "Android") : '');
        $output[] = '<li>';
        $output[] = ' <a class="' . $popupFollow . 'android' . $size . '" href="https://' . $linkandroid . '" title="' . JText::sprintf("MOD_COALAWEBSOCIALLINKS_FOLLOW", "Android") . '" ' . $linknofollow . ' target="_blank">' . $linkTextOn . '</a>';
        $output[] = '</li>';
        return implode("\n", $output);
    }

    function getGithubFollow($linkgithub, $size, $linknofollow, $popupFollow, $linkText) {
        $linkTextOn = ($linkText ? JText::sprintf("MOD_COALAWEBSOCIALLINKS_FOLLOW", "Github") : '');
        $output[] = '<li>';
        $output[] = ' <a class="' . $popupFollow . 'github' . $size . '" href="https://' . $linkgithub . '" title="' . JText::sprintf("MOD_COALAWEBSOCIALLINKS_FOLLOW", "Github") . '" ' . $linknofollow . ' target="_blank">' . $linkTextOn . '</a>';
        $output[] = '</li>';
        return implode("\n", $output);
    }

    /* Follow Us Custom functions */
    function getCustomoneFollow($linkcustomone, $linkTargetCustomone, $size, $linknofollow, $textcustomone, $popupFollow, $linkText) {
        $linkTextOn = ($linkText ? $textcustomone : '');
        $output[] = '<li>';
        $output[] = ' <a class="' . $popupFollow . 'customone' . $size . '" href="' . $linkcustomone . '" title="' . $textcustomone . '" ' . $linknofollow . ' ' . $linkTargetCustomone . '>' . $linkTextOn . '</a>';
        $output[] = '</li>';
        return implode("\n", $output);
    }

    //Create Custom style
    public static function getCustomoneStyle($themes_icon, $iconcustomone, $size, $module_unique_id) {
        $doc = JFactory::getDocument();
        $styles = "#" . $module_unique_id . " .cw-social-mod-icons-" . $themes_icon . "  a.customone" . $size . " {background:url(" . $iconcustomone . ") 0 0 no-repeat !important;}";
        $styles .= "#" . $module_unique_id . " .cw-social-mod-icons-".$themes_icon ." a.customone" . $size . ":hover {background:url(" . $iconcustomone . ") 0 0 no-repeat !important;}";
        $doc->AddStyledeclaration($styles);
    }

    /**
     * Check extension dependencies are available
     *
     * @return boolean
     */
    public static function checkDependencies()
    {
        $checkOk = false;
        $minVersion = '0.1.5';

        // Load the version.php file for the CW Gears plugin
        $version_php = JPATH_SITE . '/plugins/system/cwgears/version.php';
        if (!defined('PLG_CWGEARS_VERSION') && JFile::exists($version_php)) {
            include_once $version_php;
        }

        $loadcount_php = JPATH_SITE . '/plugins/system/cwgears/helpers/loadcount.php';
        $mobiledetect_php = JPATH_SITE . '/plugins/system/cwgears/helpers/cwmobiledetect.php';
        if (
            JPluginHelper::isEnabled('system', 'cwgears', true) == true &&
            JFile::exists($version_php) &&
            version_compare(PLG_CWGEARS_VERSION, $minVersion, 'ge') &&
            JFile::exists($loadcount_php) &&
            JFile::exists($mobiledetect_php)
        ) {

            if (!class_exists('Cwmobiledetect')) {
                JLoader::register('Cwmobiledetect', $mobiledetect_php);
            }

            if (!class_exists('CwGearsHelperLoadcount')) {
                JLoader::register('CwGearsHelperLoadcount', $loadcount_php);
            }

            $checkOk = true;
        }

        return $checkOk;
    }

}