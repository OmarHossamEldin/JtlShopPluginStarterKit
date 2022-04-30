<?php

namespace Plugin\JtlShopPluginStarterKit\Src\Middlewares;

use Plugin\JtlShopPluginStarterKit\Src\Helpers\Response;
use Plugin\JtlShopPluginStarterKit\Src\Support\Facades\Localization\Currency;
use Plugin\JtlShopPluginStarterKit\Src\Support\Facades\Middleware\BaseMiddleware;
use Plugin\JtlShopPluginStarterKit\Src\Support\Facades\Localization\Lang;
use Plugin\JtlShopPluginStarterKit\Src\Support\Http\Header;

class CurrencyFilter extends BaseMiddleware
{
    public function handle()
    {
        if (Header::has('Content-Currency')) {
            Currency::set(Header::get('Content-Currency'));
        }
    }
}
