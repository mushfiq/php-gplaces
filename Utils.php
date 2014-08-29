<?php

/*
 * This file contains all the Utils method used though out the API wrapper.
 * 
 */

class Utils {

    /**
     * The call operator
     * @param string $error_message  Error details as string
     */
    public static function log_error($error_message) {
        ini_set("log_errors", 1);
        ini_set("error_log", "/tmp/php-error.log");
        error_log($error_message);
    }

    /**
     * The method clean API search string
     * @$query_str string user search input to the API
     * @return string cleaned string
     */
    public static function clean_user_query($query_str) {
        return htmlspecialchars($query_str, ENT_NOQUOTES, 'utf-8');
    }

    /**
     * The method convert API output to array by removing unwanted field 
     * and also addinf meta information like status and total number of plcases found.
     * @$places string API output as string
     * @return array API wrapper output in array format
     */
    public static function prepare_json_response($places) {
        $decored_data = json_decode($places, true);

        $results = $decored_data{'results'};
        $jsonResults = $places = array();

        foreach ($results as $value) {
            $place = array();

            header('Content-type: application/json');
            $place['name'] = $value{'name'};
            $place['address'] = $value{'formatted_address'};

            array_push($jsonResults, $place);
        }

        $places['results'] = $jsonResults;
        $places['meta'] = ['total' => count($jsonResults), 'status' => 'ok'];
        return $places;
    }

}
