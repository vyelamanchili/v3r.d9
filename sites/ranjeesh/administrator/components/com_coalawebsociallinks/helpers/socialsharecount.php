<?php

defined('_JEXEC') or die('Restricted access');

/**
 * @package             Joomla
 * @subpackage          CoalaWeb Social Links Component
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

class SocialShareCount {

    private $url;

    /**
     * Constructor
     * 
     * @param type $url
     */
    public function __construct($url) {
        $this->url = rawurlencode($url);
    }

    /**
     * Get facebook counts
     * https://developers.facebook.com/docs/facebook-login/access-tokens#apptokens
     * 
     * @access      public
     * @return      int         Total counts for Facebook
     */
    public function getFacebookCount() {
        $comParams = JComponentHelper::getParams('com_coalawebsociallinks');
        $appSecret = $comParams->get('fb_count_secret', '');
        $appId = $comParams->get('fb_count_id', '');
        $extraSecure = $comParams->get('extra_secure_facebook', '');
        
        $count = array();
        
        if ($appSecret && $appId) {
            $token = $appId . '|' . $appSecret;

            //Should we add an extra secure layer to the call?
            if ($extraSecure) {
                $appsecret_proof= hash_hmac('sha256', $token, $appSecret);
                $data = $this->processCurl('https://graph.facebook.com/v2.5?id=' . $this->url . '&fields=og_object{engagement{count}},share&access_token=' . $token . '&appsecret_proof=' . $appsecret_proof);
            } else {
                $data = $this->processCurl('https://graph.facebook.com/v2.5?id=' . $this->url . '&fields=og_object{engagement{count}},share&access_token=' . $token);
            }

            $response = json_decode($data, true);

            $count['share_count'] = isset($response['share']['share_count']) ? strval($response['share']['share_count']) : 0;
            $count['comment_count'] = isset($response['share']['comment_count']) ? strval($response['share']['comment_count']) : 0;
            $count['total_count'] = isset($response['og_object']['engagement']['count']) ? strval($response['og_object']['engagement']['count']) : 0;
        } else {
            $count['share_count'] = '0';
            $count['comment_count'] = '0';
            $count['total_count'] = '0';
        }

        return $count;
    }

    /**
     * Get linkedin count
     *
     * @access      public
     * @return      int          Total count for Linkedin
     */
    function getLinkedinShareCount() {
        $data = $this->processCurl("http://www.linkedin.com/countserv/count/share?url=$this->url&format=json");
        $response = json_decode($data, true);

        $count = isset($response['count']) ? intval($response['count']) : 0;

        return $count;
    }

    /**
     * Get google plus count
     *
     * @access      public
     * @return      int         Total count for Google +
     */
    public function getGooglePlusCount() {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, "https://clients6.google.com/rpc");
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_POSTFIELDS, '[{"method":"pos.plusones.get","id":"p","params":{"nolog":true,"id":"' . rawurldecode($this->url) . '","source":"widget","userId":"@viewer","groupId":"@self"},"jsonrpc":"2.0","key":"p","apiVersion":"v1"}]');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
        $curl_results = curl_exec($curl);
        curl_close($curl);
        $json = json_decode($curl_results, true);

        $count = isset($json[0]['result']['metadata']['globalCounts']['count']) ? intval($json[0]['result']['metadata']['globalCounts']['count']) : 0;

        return $count;
    }

    /**
     * Get Pinterest count
     *
     * @access      public
     * @return      int         Total count for Pinterest
     */
    public function getPinterestShareCount() {
        $return_data = $this->processCurl('http://api.pinterest.com/v1/urls/count.json?url=' . $this->url);
        $json_string = preg_replace('/^receiveCount\((.*)\)$/', "\\1", $return_data);
        $json = json_decode($json_string, true);

        $count = isset($json['count']) ? intval($json['count']) : 0;

        return $count;
    }

    /**
     * Get Delicious count
     *
     * @access      public
     * @return      int         Total count for delicious
     */
    public function getDeliciousShare() {
        $json_string = $this->processCurl('http://feeds.delicious.com/v2/json/urlinfo/data?url=' . $this->url);
        $json = json_decode($json_string, true);

        $count = isset($json[0]['total_posts']) ? intval($json[0]['total_posts']) : 0;

        return $count;
    }
    
      /**
     * Get Stumbleupon count
     *
     * @access      public
     * @return      int          Total count for Stumbleupon
     */
    public function getStumbleuponShareCount() {
        $data = $this->processCurl('https://www.stumbleupon.com/services/1.01/badge.getinfo?url=' . $this->url);

        $response = json_decode($data, true);
        $count = isset($response['result']['views']) ? intval($response['result']['views']) : 0;

        return $count;
    }

    /**
     * Get Reddit count
     *
     * @access      public
     * @return      int          Total count for Reddit
     */
    public function getRedditShareCount() {
        $score = $ups = $downs = 0; //initialize
        $data = $this->processCurl('http://www.reddit.com/api/info.json?&url=' . $this->url);

        if ($data) {
            $response = json_decode($data, true);
            foreach ($response['data']['children'] as $child) { // we want all children for this example
                $ups+= (int) $child['data']['ups'];
                $downs+= (int) $child['data']['downs'];
                //$score+= (int) $child['data']['score']; //if you just want to grab the score directly
            }
            $score = $ups - $downs;
        }

        return $score;
    }

    /**
     * Process request using curl
     * 
     * This wrapper function exists in order to circumvent PHP's strict obeying 
     * of HTTP error codes.  In this case, Facebook returns error code 400 which 
     * PHP obeys and wipes out the response.
     *
     * @access      private
     * @param       $url        string      Url to process
     * @return      mixed                   Curl processing result
     */
    private function processCurl($url) {
        $agent = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        if ($agent) {
            curl_setopt($ch, CURLOPT_USERAGENT, $agent);
        }
        curl_setopt($ch, CURLOPT_FAILONERROR, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10); //timeout in seconds
        $count = curl_exec($ch);

        //Stop errors from crashing page
        $err = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        
        curl_close($ch);
        
        if ($count) {
            return $count;
        } else {
            return FALSE;
        }
    }

}
