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

use GopaySdk\Gopay;

// Initialize GoPay instance
$gopay = new Gopay();

// Access GoPay and perform verification
$result = $gopay->accessGopay()
    ->authKey('auth_key')
    ->authToken('auth_token')
    ->authDomain('domain')
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

use GopaySdk\Gopay;

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
    $gopay->PaymentInit()
        ->createOrder($name, $phone, $email, $domain, $amount, $description);
    // Handle successful order creation
} catch (\Exception $e) {
    // Handle order creation failure
    echo "Order creation failed: " . $e->getMessage();
}

?>

```

## Response Code
| Code    | Description |
| -------- | ------- |
| 200 | Successful authentication    |
| 400 | Bad request authentication     |
| 401    | Missing required parameters    |
| 500    | Bad request error    |
