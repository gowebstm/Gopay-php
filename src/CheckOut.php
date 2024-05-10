<?php

namespace GopaySdk\Gopay;

class CheckOut
{
    private $checkOutContext;
    private $checkOutTxnID;

    private static $checkOutInit;

    private const CREATE_ORDER_URL = "https://pay.gowebs.in/createorder.php";

    private function __construct($context = null)
    {
        $this->checkOutContext = $context;
    }

    public static function getInstance(): self
    {
        if (self::$checkOutInit === null) {
            self::$checkOutInit = new self();
        }
        return self::$checkOutInit;
    }

    public function createOrder($name, $phone, $email, $domain, $amount, $description, $returnUrl)
    {
        if (!isset($name, $phone, $domain, $amount)) {
            throw new \Exception("Required parameters are not set properly. Check again.");
        }

        if (!$this->validateMobileNumber($phone)) {
            throw new \Exception("Invalid mobile number.");
        }

        $apiKey = GopayCookieManager::getApiKey();
        $apiToken = GopayCookieManager::getApiToken();

        if (!$apiKey || !$apiToken) {
            throw new \Exception("API key or token not found.");
        }

        $transID = $this->generateTxnId();

        $url = self::CREATE_ORDER_URL .
            "?app_key=" . urlencode($apiKey) .
            "&token=" . urlencode($apiToken) .
            "&name=" . urlencode($name) .
            "&email=" . urlencode($email ?: "") .
            "&domain=" . urlencode($domain) .
            "&phone=" . urlencode($phone) .
            "&amount=" . urlencode($amount) .
            "&txnid=" . urlencode($transID) .
            "&description=" . urlencode($description ?: "") .
            "&return_url=" . urlencode($returnUrl);

        $ch = curl_init();

        curl_setopt_array($ch, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true
        ]);

        $response = curl_exec($ch);

        curl_close($ch);

        $responseData = json_decode($response, true);
        if (isset($responseData['status']) && $responseData['status']) {
            header("Location: " . $responseData['url']);
            exit;
        } else {
            throw new \Exception("Order creation failed.");
        }
    }

    private function generateTxnId()
    {
        $transID = implode("", array_map(function () {
            return mt_rand(0, 9);
        }, range(1, 9)));
        return "TW$transID";
    }

    private function validateMobileNumber($number)
    {
        $mobilePattern = '/^[6-9]\d{9}$/';
        return preg_match($mobilePattern, $number);
    }
}
