<?php
$amount_money = new \Square\Models\Money();
$amount_money->setAmount(1500);
$amount_money->setCurrency('USD');

$device_options = new \Square\Models\DeviceCheckoutOptions('9fa747a2-25ff-48ee-b078-04381f7c828f');

$checkout = new \Square\Models\TerminalCheckout($amount_money, $device_options);
$checkout->setPaymentType('CARD_PRESENT');

$body = new \Square\Models\CreateTerminalCheckoutRequest('c2a9b317-df4b-4a8b-973d-d0e47726e4da', $checkout);

$api_response = $client->getTerminalApi()->createTerminalCheckout($body);

if ($api_response->isSuccess()) {
    $result = $api_response->getResult();
} else {
    $errors = $api_response->getErrors();
}
?>