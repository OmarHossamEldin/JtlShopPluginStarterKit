<?php

namespace Plugin\JtlShopStarterKite\Src\Middlewares;

use Plugin\JtlShopStarterKite\Src\Helpers\Header;
use Plugin\JtlShopStarterKite\Src\Helpers\Redirect;

class VerifyAjaxRequest 
{
    public static function handel()
    {
        if(Header::checkHeaderContain('Content-Type', 'application/json') === false)
        {
            Redirect::to('/404');
        }
    }
}