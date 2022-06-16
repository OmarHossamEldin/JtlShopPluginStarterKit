<?php

namespace MvcCore\Jtl\Middlewares;

use MvcCore\Jtl\Support\Facades\Authentication\CsrfAuthentication;
use MvcCore\Jtl\Support\Facades\Localization\Translate;
use MvcCore\Jtl\Helpers\ArrayValidator;
use MvcCore\Jtl\Support\Http\Request;
use MvcCore\Jtl\Validations\Alerts;

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
