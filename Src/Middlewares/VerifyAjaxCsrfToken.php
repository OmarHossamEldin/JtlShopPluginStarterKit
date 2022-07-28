<?php

namespace MvcCore\Jtl\Middlewares;

use MvcCore\Jtl\Support\Facades\Authentication\CsrfAuthentication;
use MvcCore\Jtl\Support\Http\Request;
use MvcCore\Jtl\Helpers\Response;

class VerifyAjaxCsrfToken
{
    public static function handle()
    {
        if ((Request::type() === 'POST') || (Request::type() === 'PUT') || (Request::type() === 'DELETE')) {
            $request = new Request();
            $requestData = $request->all();
            if ((isset($requestData['jtl_token']) === false) || (empty(trim($requestData['jtl_token'])))) {
                return Response::json([
                    'message' => 'unauthenticated',
                ], 403);
            }
            if ( CsrfAuthentication::validate_token($requestData['jtl_token']) ) {
                return Response::json([
                    'message' => 'unauthenticated',
                ], 403);
            }
        }
    }
}
