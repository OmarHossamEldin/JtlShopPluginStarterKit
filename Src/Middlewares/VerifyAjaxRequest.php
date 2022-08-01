<?php

namespace MvcCore\Jtl\Middlewares;

use MvcCore\Jtl\Support\Facades\Middleware\BaseMiddleware;
use MvcCore\Jtl\Support\Facades\Localization\Translate;
use MvcCore\Jtl\Support\Http\Header;
use MvcCore\Jtl\Support\Http\Server;
use MvcCore\Jtl\Helpers\Response;

class VerifyAjaxRequest extends BaseMiddleware
{
    public function handle()
    {
        if (!!stripos(Server::previous_url(), 'paypal')) {
            return;
        }
        if (!(Header::has('Accept') && Header::get('Accept') === 'application/json')) {
            return Response::json([
                'message' => Translate::translate('messages', 'unauthenticated'),
            ], 403);
        }
    }
}
