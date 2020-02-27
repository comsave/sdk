<?php

require_once dirname(__FILE__) . '/../vendor/autoload.php';

use \Comsave\SDK\WebserviceClientBuilder;

$wsClient = WebserviceClientBuilder::build(
    'your_username',
    'your_password'
);

$availableCountries = $wsClient->request(
    'GET',
    'countries.json'
);

$parsedResponse = json_decode($availableCountries->getBody(), true);

var_dump($parsedResponse['countries']);
var_dump($parsedResponse['success']);