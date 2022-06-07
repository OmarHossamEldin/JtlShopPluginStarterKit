<?php

namespace MvcCore\Jtl\Middlewares;

use MvcCore\Jtl\Support\Facades\Middleware\BaseMiddleware;
use MvcCore\Jtl\Support\Facades\Localization\Lang;
use MvcCore\Jtl\Support\Http\Header;

class ApiLocalization extends BaseMiddleware
{
    public function handle()
    {
        if (Header::has('Content-Lang')) {
            Lang::set(Header::get('Content-Lang') ?? null);
        }
    }
}
