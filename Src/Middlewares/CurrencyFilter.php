<?php

namespace MvcCore\Jtl\Middlewares;

use MvcCore\Jtl\Helpers\Response;
use MvcCore\Jtl\Support\Facades\Localization\Currency;
use MvcCore\Jtl\Support\Facades\Middleware\BaseMiddleware;
use MvcCore\Jtl\Support\Facades\Localization\Lang;
use MvcCore\Jtl\Support\Http\Header;

class CurrencyFilter extends BaseMiddleware
{
    public function handle()
    {
        if (Header::has('Content-Currency')) {
            Currency::set(Header::get('Content-Currency'));
        }
    }
}
