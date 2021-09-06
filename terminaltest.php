<?php

require 'autoload.php';

use Square\SquareClient;
use Square\Exceptions\ApiException;
use Square\Models\CreateCustomerRequest;
use Square\Environment;

$client = new SquareClient([
    "accessToken" => "EAAAEMcwm0zg-bCbyUyAONTRKy_8WfEoN5vVPuZzY1D56uhrlH8VZpdnHdNFK8FB",
    "environment" => Environment::SANDBOX
]);

$body = new \Square\Models\CreateCustomerRequest();
$body->setIdempotencyKey('947d4d00-d205-44dc-9c4a-ca81a009f1f1');
$body->setGivenName('testname');
$body->setFamilyName('testfname');

$api_response = $client->getCustomersApi()->createCustomer($body);

if ($api_response->isSuccess()) {
    $result = $api_response->getResult();
} else {
    $errors = $api_response->getErrors();
}