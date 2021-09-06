<?php
$query = new \Square\Models\TerminalCheckoutQuery();

$body = new \Square\Models\SearchTerminalCheckoutsRequest();
$body->setQuery($query);

$api_response = $client->getTerminalApi()->searchTerminalCheckouts($body);

if ($api_response->isSuccess()) {
    $result = $api_response->getResult();
} else {
    $errors = $api_response->getErrors();
}
?>