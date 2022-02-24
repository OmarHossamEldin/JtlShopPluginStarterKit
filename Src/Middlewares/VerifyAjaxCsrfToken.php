<?php

namespace Plugin\JtlShopPluginStarterKit\Src\Middlewares;

use Plugin\JtlShopPluginStarterKit\Src\Support\Facades\Authentication\CsrfAuthentication;
use Plugin\JtlShopPluginStarterKit\Src\Support\Http\Request;
use Plugin\JtlShopPluginStarterKit\Src\Support\Http\Header;
use Plugin\JtlShopPluginStarterKit\Src\Helpers\Response;

class VerifyAjaxCsrfToken
{
    public static function handle()
    {
        if ((Request::type() === 'POST') || (Request::type() === 'PUT') || (Request::type() === 'DELETE')) {
            if (!(Header::has('jtl_token') && CsrfAuthentication::validate_token(Header::get('jtl_token')))) {
                return Response::json([
                    'message' => 'unauthenticated',
                ], 403);
            }
        }
    }
}
