<?php

namespace Plugin\JtlShopPluginStarterKit\Src\Middlewares;

use Plugin\JtlShopPluginStarterKit\Src\Support\Http\Request;
use Plugin\JtlShopPluginStarterKit\Src\Support\Http\Header;
use Plugin\JtlShopPluginStarterKit\Src\Helpers\Redirect;

class VerifyAjaxRequest
{
    public static function handle()
    {
        $request = new Request();
        if (!!stripos($request->referral(), 'paypal')) {
            return;
        }
        if (!(Header::has('Content-Type') && Header::get('Content-Type') === 'application/json')) {
            Redirect::to('/404');
        }
    }     
}
