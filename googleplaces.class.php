<?php

/*
 * Google Places API class
 * API Documentation: README.md
 * @author mushfiq
 * @version 0.0.1
 * 
 */
require 'NotImplementedException.php';

class GooglePlaces {

    /**
     * The API base URL
     */
    const API_URL = 'https://maps.googleapis.com/maps/api/place/';

    /**
     * Google Places API Key
     * @var string  
     */
    private $_apikey;

    /**
     * Default constructor
     * @param array|string  Google Places API configuration
     * @return void
     * @throws Exception
     */
    public function __construct($config) {
        if (true === is_array($config)) {
            $this->setApiKey($config['apiKey']);
        } else if (true === is_string($config)) {
            $this->setApiKey($config);
        } else {
            throw new Exception("Error: __construct() - Configuration data is missing.");
        }
    }

    /**
     * The call operator
     * @param string $type  API resource type (nearby/text/radarsearch)
     * @param array $query  Request parameters
     * @param type $method  Request type GET|POST
     * @param type $content_type Output Conntent type XML|JSON
     * @return mixed
     * @throws Exception
     */
    protected function _makeCall($type, $query = null, $method = "GET", $content_type = "json") {

        if (isset($query) && is_array($query)) {
            $query['key'] = $this->getApiKey();
            $queryString = http_build_query($query);
        } else {
            $queryString = NULL;
        }

        $apiCall = self::API_URL . $type . '/' . $content_type . '?' . $queryString;

        try {

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $apiCall);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json'));
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $jsonData = curl_exec($ch);

            if (false === $jsonData) {
                throw new Exception("Error: _makeCall() -cURL error" . curl_errno($ch));
            }
            curl_close($ch);

            return $jsonData;
        } catch (Exception $e) {
            Utils::log_error($e);
        }
    }

    public function setApiKey($apiKey) {
        $this->_apikey = $apiKey;
    }

    public function getApiKey() {
        return $this->_apikey;
    }

    public function getLocationsByTextSearch($query) {
        return $this->_makeCall('textsearch', $query);
    }

    public function getLocationsByRadarSearch() {
        throw new NotImplementedException;
    }

    public function getLocationsByNearBySearch() {
        throw new NotImplementedException;
    }

}
