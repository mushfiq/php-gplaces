# PHP Wrapper for Google Place API

## About

A PHP wrapper for the Google Place API  

## Requirements

- PHP 5.3.2 or higher
- cURL
- phpunit
- API KEY for Google Place API

## Get started

[Register your application](https://code.google.com/apis/console/) with your google account and create an application.
And then create an API Key using Create new Browser Key options.

> And set the API KEY to the configuration.php

### Initialize the class

```
<?php
    require_once 'googleplaces.class.php';
    
    $googlePlaces = new GooglePlaces(array(
      'apiKey'      => 'YOUR_APP_KEY'
    ));
?>
```

###Installing Depenedencies

If Composer is not installed into the system, install composer first by  following [this tutorial](http://code.tutsplus.com/tutorials/easy-package-management-with-composer--net-25530/). And then run the following command:

```
run composer install
```


###Run the Test case 
Navigate terminal to the project directory and simply run following command:

```
phpunit GooglePlacesApiTest.php 

```

###Example Calls

http://localhost/ag-location/index.php?place=Krankenhaus%20in%20Stuttgart

http://localhost/ag-location/index.php?place=Pubs%20in%20Stadtmitte%20Stuttgart
