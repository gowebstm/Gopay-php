<?php

namespace GopaySdk\Gopay;

class GopayCookieManager
{
    public static function saveCredentials($authKey, $authToken, $domain)
    {
        setcookie('gopay_auth_key', $authKey, time() + (86400 * 30), "/");
        setcookie('gopay_auth_token', $authToken, time() + (86400 * 30), "/");
        setcookie('gopay_domain', $domain, time() + (86400 * 30), "/");
    }

    public static function getApiKey(): ?string
    {
        return $_COOKIE['gopay_auth_key'] ?? null;
    }

    public static function getApiToken(): ?string
    {
        return $_COOKIE['gopay_auth_token'] ?? null;
    }

    public static function getDomain(): ?string
    {
        return $_COOKIE['gopay_domain'] ?? null;
    }
}
?>