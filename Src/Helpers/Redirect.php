<?php

namespace Plugin\JtlShopStarterKite\Src\Helpers;

class Redirect
{
    public static function to($url)
    {
        header('Location:' . $url);
        exit();
    }
}
