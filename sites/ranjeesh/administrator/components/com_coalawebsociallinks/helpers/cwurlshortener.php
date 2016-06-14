<?php

defined('_JEXEC') or die('Restricted access');

/**
 * @package             Joomla
 * @subpackage          CoalaWeb Social Links Component
 * @author              Steven Palmer
 * @author url          http://coalaweb.com
 * @author email        support@coalaweb.com
 * @license             GNU/GPL, see /assets/en-GB.license.txt
 * @copyright           Copyright (c) 2015 Steven Palmer All rights reserved.
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


class CwUrlShortenerHelper {

    private $url;
    private $shortUrl;
    private $apiKey;
    private $service;
    
    public function __construct($url, $options = array()){
        $this->url = $url;
        
        if(!empty($options)) {
            $this->bindOptions($options);
        }
    }
    
    private function bindOptions($options) {
        if(isset($options['api_key'])) {
            $this->apiKey = $options['api_key'];
        }
        
        if(isset($options['service'])) {
            $this->service = $options['service'];
        }

    }
    
    public function getUrl() {
        
        // Check for installed CURL library
        $installedLibraries = get_loaded_extensions();
        if(!in_array('curl', $installedLibraries)) {
            throw new Exception(JText::_("COM_CWSOCIALLINKS_MSG_CURL_NOT_INSTALLED"));
        }
        
        switch($this->service) {

            case "google":
                $this->getGoogleURL();
                break;

        }
        
        return $this->shortUrl;
    }
    
   
    
    /**
     * Create a short url withthe help of Google.
     */
    protected function getGoogleURL() {
        
        $postData = array(
        	'longUrl' => rawurldecode(html_entity_decode($this->url, ENT_COMPAT, 'UTF-8')),
        	'key'     => $this->apiKey
        );
        
        $jsonData = json_encode($postData);
        
        $curlObj = curl_init();
        curl_setopt($curlObj, CURLOPT_URL, 'https://www.googleapis.com/urlshortener/v1/url?key=' . $this->apiKey);
        curl_setopt($curlObj, CURLOPT_RETURNTRANSFER, 1);

        //As the API is on https, set the value for CURLOPT_SSL_VERIFYPEER to false.
        //This will stop cURL from verifying the SSL certificate.
        curl_setopt($curlObj, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curlObj, CURLOPT_HEADER, 0);
        curl_setopt($curlObj, CURLOPT_HTTPHEADER, array('Content-type:application/json'));
        curl_setopt($curlObj, CURLOPT_POST, 1);
        curl_setopt($curlObj, CURLOPT_POSTFIELDS, $jsonData);
        $response = curl_exec($curlObj);
        
        curl_close($curlObj);
        
        if(!empty($response)) {
            $json = json_decode($response);
            
            if(!empty($json->error)) {
                $errorMessage = "[Goo.gl service] Message: " . $json->error->message ."; Location: " . $json->error->errors[0]->location;
                throw new Exception($errorMessage);
            } else {
                $this->shortUrl = $json->id;
            }
        } else {
            throw new Exception(JText::_("COM_CWCONTACT_MSG_UNKNOWN_ERROR"));
        }
        
    }
}