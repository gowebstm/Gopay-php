<?php

require 'vendor/autoload.php'; 
use GopaySdk\Gopay\Gopay;

$gopay = new Gopay();

$apiKey = '7110eda4d09e062aa5e4a390b0a572ac0d2c0220';
$apiToken = '8cb2237d0679ca88db6464eac60da96345513964';
$domain = 'gomatka.co';

$accessGopay = $gopay->accessGopay();
$accessGopay->authKey($apiKey)
            ->authToken($apiToken)
            ->authDomain($domain);

$verificationResult = $accessGopay->verify();
var_dump($verificationResult);

$checkout = $gopay->paymentInit();
try {
    $checkout->createOrder('John Doe', '9876543210', 'john@example.com', 'gomatka.co', 1, 'Product description', 'https://example.com/return');
    echo "Order created successfully.";
} catch (\Exception $e) {
    echo "Error creating order: " . $e->getMessage();
}

// $checkout = $gopay->paymentStatus();
// try {
//     $checkout->checkOrderStatus('TW006004513','gomatka.co');
//     echo "Order Status - ";
// } catch (\Exception $e) {
//     echo "Error creating order: " . $e->getMessage();
// }

?>
