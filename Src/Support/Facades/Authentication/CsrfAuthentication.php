<?php

namespace MvcCore\Jtl\Support\Facades\Authentication;

use JTL\Session\AbstractSession;
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
        if (!!AbstractSession::get('jtl_token') === false) {
            $newToken = Shop::Container()->getCryptoService()->randomString(32);
            AbstractSession::set('jtl_token', $newToken);
            return $newToken;
        }
        return AbstractSession::get('jtl_token');
    }
    
    /**
     * validate token is valid or not
     *
     * @param string|null $token
     * @return boolean
     */
    public static function validate_token(?string $token = null): bool
    {
        return $token ? $token === AbstractSession::get('jtl_token') :  false;
    }

    public static function get_token(): string
    {
        return AbstractSession::get('jtl_token');
    }
}
