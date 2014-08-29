<?php

/*
 * This is the entry point of the example application which is calling 
 * the Google place API wrapper.
 */

require 'configuration.php';
require 'googleplaces.class.php';
require 'Utils.php';

/**
 * this method is the entry point where user input 
 * is cleaned and then send to the API wrapper and finally display it as JSON
 * @param string $query_str user query
 * @return object json encoded object
 */
function _init($query_str) {

    $googlePlaces = new GooglePlaces(array(
        'apiKey' => API_KEY
    ));

    if (isset($query_str)) {
        $query['query'] = $query_str;
        $places = $googlePlaces->getLocationsByTextSearch($query);
        $jsonResults = Utils::prepare_json_response($places);
        echo json_encode($jsonResults);
    }
}

_init(Utils::clean_user_query($_GET['place']));
