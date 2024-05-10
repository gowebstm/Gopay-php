<?php

namespace GopaySdk;

class AccessGopay
{
    private $accessGopayContext;

    private static $gopayToken;
    private static $gopayKey;
    private static $gopayDomain;
    private static $isVerified = false;
    private static $accessGopay;

    private const VERIFY_URL = "https://pay.gowebs.in/verify-domain.php";

    private function __construct($context = null)
    {
        $this->accessGopayContext = $context;
    }

    public static function getInstance(): AccessGopay
    {
        if (self::$accessGopay === null) {
            self::$accessGopay = new self();
        }
        return self::$accessGopay;
    }

    public function authToken($token): self
    {
        self::$gopayToken = $token;
        return $this;
    }

    public function authKey($key): self
    {
        self::$gopayKey = $key;
        return $this;
    }

    public function authDomain($domain): self
    {
        self::$gopayDomain = $domain;
        return $this;
    }

    public function verify()
    {
        $url = self::VERIFY_URL;
        $postData = [
            'authKey' => self::$gopayKey,
            'token' => self::$gopayToken,
            'domain' => self::$gopayDomain
        ];

        $ch = curl_init();

        curl_setopt_array($ch, [
            CURLOPT_URL => $url,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => http_build_query($postData),
            CURLOPT_RETURNTRANSFER => true
        ]);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);

        if ($httpCode === 200) {
            $data = json_decode($response, true);
            self::$isVerified = $data['code'] === 200;
            GopayCookieManager::saveCredentials($data['authKey'], $data['authToken'], $data['domain']);

            return $response;
        }

        return ['code' => $httpCode, 'message' => 'HTTP request failed'];
    }
}

?>