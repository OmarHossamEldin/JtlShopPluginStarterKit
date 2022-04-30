<?php

namespace Plugin\JtlShopPluginStarterKit\Src\Middlewares;

use Plugin\JtlShopPluginStarterKit\Src\Support\Facades\Middleware\BaseMiddleware;
use Plugin\JtlShopPluginStarterKit\Src\Support\Facades\Localization\Translate;
use Plugin\JtlShopPluginStarterKit\Src\Support\Http\Header;
use Plugin\JtlShopPluginStarterKit\Src\Support\Http\Server;
use Plugin\JtlShopPluginStarterKit\Src\Helpers\Response;

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
