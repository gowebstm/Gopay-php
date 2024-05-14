# GoPay SDK - PHP

The GoPay SDK is a powerful tool for integrating GoPay payment functionality into your PHP applications. This SDK allows seamless integration with GoPay's payment gateway, providing a hassle-free experience for both developers and users.

## Requirements

PHP 7.4 or later

## Installation

### Composer

You can install the GoPay SDK via Composer. Run the following command in your project directory:

```bash
composer require gopay-sdk/gopay-sdk
```

### Usage

#### For Gopay Verification & Initialization

```php

<?php

require 'vendor/autoload.php';

use GopaySdk\Gopay\Gopay;

// Initialize GoPay instance
$gopay = new Gopay();

// Access GoPay and perform verification

$apiKey = 'your_api_key';
$apiToken = 'your_api_token';
$domain = 'your_domain';

$result = $gopay->accessGopay()
        ->authKey($apiKey)
        ->authToken($apiToken)
        ->authDomain($domain);
    ->verify();

    if ($result) {
        // Handle successful verification
        echo "Verification successful!";
    } else {
        // Handle verification failure
        echo "Verification failed!";
    }

?>

```

#### For Gopay Payment Initialization


```php

<?php

require 'vendor/autoload.php';

use GopaySdk\Gopay\Gopay;

// Initialize GoPay instance
$gopay = new Gopay();

// Create order for payment
$name = "John Doe";
$phone = "1234567890";
$email = "john@example.com";
$domain = "example.com";
$amount = 100; // Amount in cents
$description = "Product purchase";

try {
    $res = $checkout->createOrder('John Doe', '9876543210', 'john@example.com', 'example.com', 1000, 'Product description', 'https://example.com/return');
    $json = json_decode($res,true);
    echo "Order created successfully. ";
    echo "<pre>";
    print_r($json);
} catch (\Exception $e) {
    echo "Error creating order: " . $e->getMessage();
}

?>

```

#### For Gopay Payment Status Check

```php

<?php

require 'vendor/autoload.php'; 

use GopaySdk\Gopay\Gopay;

$gopay = new Gopay();

$apiKey = 'your_api_key';
$apiToken = 'your_api_token';
$domain = 'your_domain';
$transID = 'transaction_ID';

$checkout = $gopay->paymentStatus();
try {
    $res = $checkout->checkOrderStatus($transID,$domain,$apiKey,$apiToken);
    $json = json_decode($res,true);
    echo "Order Status";
    echo "<pre>";
    print_r($json);
} catch (\Exception $e) {
    echo "Error creating order: " . $e->getMessage();
}

?>


```

## Response Code for Gopay Verification
| Code    | Description |
| -------- | ------- |
| 200 | Successful authentication    |
| 400 | Bad request authentication     |
| 401    | Missing required parameters    |
| 500    | Bad request error    |

### For Android SDK Visit [Gopay-SDK(Kotlin)](https://github.com/gowebstm/Gopay-kotlin)