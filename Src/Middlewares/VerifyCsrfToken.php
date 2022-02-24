<?php

namespace Plugin\JtlShopStarterKite\Src\Middlewares;

use Plugin\JtlShopStarterKite\Src\Helpers\RequestType;
use Plugin\JtlShopStarterKite\Src\Validations\Alerts;
use Plugin\JtlShopStarterKite\Src\Support\Lang;
use JTL\Helpers\Form;

class VerifyCsrfToken 
{
    public static function handel()
    {
        if((RequestType::get() === 'POST') && (Form::validateToken() === false))
        {
            Alerts::show('warning', Lang::get('messages', 'unauthenticated'), 'action');
        }
    }
}