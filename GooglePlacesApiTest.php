<?php

/**
 * This file contains unit test for the API wrapper.
 * @author mushfiq
 */
require_once 'googleplaces.class.php';
require_once 'configuration.php';

class GooglePlacesApiTest extends PHPUnit_Framework_TestCase {

    /**
     * this method is constructor for the test class 
     * which is initiating the API wrapper 
     */
    public function __construct() {
        $this->googlePlaces = new GooglePlaces(array(
            'apiKey' => API_KEY
        ));
    }

    /**
     * this test method is checking whether the API wrapper 
     * returing the json with results array list or not
     * and asserting the resutls
     */
    public function testGooglePlcaeAPIWrapperResults() {
        $query['query'] = "Krankenhaüs im Stuttgart";
        $places = $this->googlePlaces->getLocationsByTextSearch($query);
        $decored_data = json_decode($places, true);
        $this->assertEquals(1, !!($decored_data{'results'}));
    }

}
