<?php

namespace GopaySdk\Gopay;

class CheckOrderStatus
{
    private $checkOrderContext;
    private $checkOrderTxnID;

    private static $checkOrderInit;

    private const CHECK_ORDER_URL = "https://pay.gowebs.in/check-order.php";

    private function __construct($context = null)
    {
        $this->checkOrderContext = $context;
    }

    public static function getInstance(): self
    {
        if (self::$checkOrderInit === null) {
            self::$checkOrderInit = new self();
        }
        return self::$checkOrderInit;
    }

    public function checkOrderStatus($transID,$domain)
    {
        if (!isset($transID,$domain)) {
            throw new \Exception("Required parameters are not set properly. Check again.");
        }

        $apiKey = GopayCookieManager::getApiKey();
        $apiToken = GopayCookieManager::getApiToken();

        if (!$apiKey || !$apiToken) {
            throw new \Exception("API key or token not found.");
        }

        $url = self::CHECK_ORDER_URL .
            "?app_key=" . urlencode($apiKey) .
            "&token=" . urlencode($apiToken) .
            "&domain=" . urlencode($domain) .
            "&txnid=" . urlencode($transID);

        $ch = curl_init();

        curl_setopt_array($ch, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true
        ]);

        $response = curl_exec($ch);

        curl_close($ch);

        $responseData = json_decode($response, true);
        if (isset($responseData['status']) && $responseData['status']) {
            return $response;
        } else {
            throw new \Exception("Order creation failed.");
        }
    }
}
