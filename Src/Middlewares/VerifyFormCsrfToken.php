<?php

namespace Plugin\JtlShopPluginStarterKit\Src\Middlewares;

use Plugin\JtlShopPluginStarterKit\Src\Support\Facades\Authentication\CsrfAuthentication;
use Plugin\JtlShopPluginStarterKit\Src\Support\Facades\Localization\Translate;
use Plugin\JtlShopPluginStarterKit\Src\Helpers\ArrayValidator;
use Plugin\JtlShopPluginStarterKit\Src\Support\Http\Request;
use Plugin\JtlShopPluginStarterKit\Src\Validations\Alerts;

class VerifyFormCsrfToken
{
    public static function handle()
    {
        if ((Request::type() === 'POST') || (Request::type() === 'PUT') || (Request::type() === 'DELETE')) {
            $request = new Request();
            $requestData = $request->all();
            $arrayValidator = new ArrayValidator($requestData);
            if ($arrayValidator->array_keys_exists('jtl_token')) {
                if (!CsrfAuthentication::validate_token($requestData['jtl_token'])) {
                    Alerts::show('danger', ['message' => Translate::translate('messages', 'unauthenticated')]);
                }
            } else {
                Alerts::show('danger', ['message' => Translate::translate('messages', 'unauthenticated')]);
            }
        }
    }
}
