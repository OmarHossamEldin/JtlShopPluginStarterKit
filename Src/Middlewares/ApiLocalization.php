<?php

namespace Plugin\JtlShopPluginStarterKit\Src\Middlewares;

use Plugin\JtlShopPluginStarterKit\Src\Support\Facades\Middleware\BaseMiddleware;
use Plugin\JtlShopPluginStarterKit\Src\Support\Facades\Localization\Lang;
use Plugin\JtlShopPluginStarterKit\Src\Support\Http\Header;

class ApiLocalization extends BaseMiddleware
{
    public function handle()
    {
        if (Header::has('Content-Lang')) {
            Lang::set(Header::get('Content-Lang') ?? null);
        }
    }
}
