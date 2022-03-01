<?php

namespace Plugin\JtlShopPluginStarterKit\Src\Middlewares;

use Plugin\JtlShopPluginStarterKit\Src\Support\Http\Header;
use Plugin\JtlShopPluginStarterKit\Src\Helpers\Redirect;
use Plugin\JtlShopPluginStarterKit\Src\Support\Http\Server;

class VerifyAjaxRequest
{
    public static function handle()
    {
        if (!!stripos(Server::previous_url(), 'paypal')) {
            return;
        }
        if (!(Header::has('Content-Type') && Header::get('Content-Type') === 'application/json')) {
            Redirect::to('/404');
        }
    }     
}
