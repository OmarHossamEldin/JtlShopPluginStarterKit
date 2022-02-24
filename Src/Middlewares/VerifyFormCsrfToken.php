<?php

namespace Plugin\JtlShopPluginStarterKit\Src\Middlewares;

use Plugin\JtlShopPluginStarterKit\Src\Support\Facades\Authentication\CsrfAuthentication;
use Plugin\JtlShopPluginStarterKit\Src\Support\Facades\Localization\Lang;
use Plugin\JtlShopPluginStarterKit\Src\Support\Http\Request;
use Plugin\JtlShopPluginStarterKit\Src\Validations\Alerts;

class VerifyFormCsrfToken
{
    public static function handle()
    {
        if ((Request::type() === 'POST') || (Request::type() === 'PUT') || (Request::type() === 'DELETE')) {
            $request = new Request();
            if (CsrfAuthentication::validate_token($request->all()['jtl_token'])) {
                if ($request->all()['jtl_token'] && $request->all()['kPluginAdminMenu']) {
                    unset($request->all()['jtl_token'], $request->all()['kPluginAdminMenu']);
                }
            }
            Alerts::show('warning', Lang::get('messages', 'unauthenticated'), 'action');
        }
    }
}
