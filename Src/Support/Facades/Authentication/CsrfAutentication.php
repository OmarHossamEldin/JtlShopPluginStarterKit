<?php

namespace Plugin\JtlShopPluginStarterKit\Src\Support\Facades\Authentication;

use JTL\Session;
use JTL\Shop;

class CsrfAuthentication
{
    /**
     * generate jtl_token and store it in session
     *
     * @return string
     */
    public static function generate_token(): string
    {
        if (!!Session::get('jtl_token') === false) {
            $newToken = Shop::Container()->getCryptoService()->randomString(32);
            Session::set('jtl_token', $newToken);
            return $newToken;
        }
        return Session::get('jtl_token');
    }
    
    /**
     * validate token is valid or not
     *
     * @param string|null $token
     * @return boolean
     */
    public static function validate_token(?string $token = null): bool
    {
        return $token ? $token === Session::get('jtl_token') :  false;
    }
}
