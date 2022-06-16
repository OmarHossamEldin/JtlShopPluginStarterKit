<?php

namespace MvcCore\Jtl\Middlewares;

use MvcCore\Jtl\Support\Facades\Authentication\CsrfAuthentication;
use MvcCore\Jtl\Support\Facades\Middleware\BaseMiddleware;
use MvcCore\Jtl\Support\Facades\Localization\Translate;
use MvcCore\Jtl\Support\Http\Request;
use MvcCore\Jtl\Support\Http\Header;
use MvcCore\Jtl\Helpers\Response;

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
