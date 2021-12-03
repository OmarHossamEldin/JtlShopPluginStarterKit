<?php

namespace Plugin\JtlShopStarterKite\Src\Helpers;

class Header
{
    public static function checkHeaderContain(String $key, String $content)
    {
        $headers = getallheaders();
        $header = array_key_exists($key, $headers) ? $headers[$key] : '';
        return $header === $content ? true : false;
    }
}
