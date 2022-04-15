<?php

namespace Plugin\JtlShopPluginStarterKit\Src\Middlewares;

use Plugin\JtlShopPluginStarterKit\Src\Support\Facades\Authentication\CsrfAuthentication;
use Plugin\JtlShopPluginStarterKit\Src\Support\Facades\Middleware\BaseMiddleware;
use Plugin\JtlShopPluginStarterKit\Src\Support\Facades\Localization\Translate;
use Plugin\JtlShopPluginStarterKit\Src\Support\Http\Request;
use Plugin\JtlShopPluginStarterKit\Src\Support\Http\Header;
use Plugin\JtlShopPluginStarterKit\Src\Helpers\Response;

class VerifyCsrfToken extends BaseMiddleware
{
    public function handle()
    {
        if ((Request::type() === 'POST') || (Request::type() === 'PUT') || (Request::type() === 'DELETE')) {

            if ((Header::has('Jtl-Token') === false) || (empty(Header::get('Jtl-Token')))) {
                return Response::json([
                    'message' => Translate::translate('messages', 'unauthenticated'),
                ], 403);
            }
            if (!CsrfAuthentication::validate_token(Header::get('Jtl-Token'))) {
                return Response::json([
                    'message' => Translate::translate('messages', 'unauthenticated'),
                ], 403);
            }
        }
    }
}
