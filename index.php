<?php

require 'vendor/autoload.php'; 
use GopaySdk\Gopay;

$gopay = new Gopay();

$apiKey = 'your_api_key';
$apiToken = 'your_api_token';
$domain = 'your_domain';

$accessGopay = $gopay->accessGopay();
$accessGopay->authKey($apiKey)
            ->authToken($apiToken)
            ->authDomain($domain);

$verificationResult = $accessGopay->verify();
var_dump($verificationResult);

$checkout = $gopay->PaymentInit();
try {
    $checkout->createOrder('John Doe', '9876543210', 'john@example.com', 'example.com', 1000, 'Product description', 'https://example.com/return');
    echo "Order created successfully.";
} catch (\Exception $e) {
    echo "Error creating order: " . $e->getMessage();
}

?>
