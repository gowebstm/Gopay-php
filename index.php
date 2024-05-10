<?php

require 'vendor/autoload.php'; 
use GopaySdk\Gopay\Gopay;

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

$checkout = $gopay->paymentInit();
try {
    $res = $checkout->createOrder('John Doe', '9876543210', 'john@example.com', 'example.com', 1000, 'Product description', 'https://example.com/return');
    $json = json_decode($res,true);
    echo "Order created successfully. ";
    echo "<pre>";
    print_r($json);
} catch (\Exception $e) {
    echo "Error creating order: " . $e->getMessage();
}

$checkout = $gopay->paymentStatus();
try {
    $res = $checkout->checkOrderStatus('TW006004513',$domain);
    $json = json_decode($res,true);
    echo "Order Status";
    echo "<pre>";
    print_r($json);
} catch (\Exception $e) {
    echo "Error creating order: " . $e->getMessage();
}

?>
