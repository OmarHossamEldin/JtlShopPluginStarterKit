<?php

namespace Plugin\JtlShopPluginStarterKit\Src\Support\Http;

class Server
{
    public static function base_url(): string
    {
        return isset($_SERVER['HTTPS']) ? 'https://' : 'http://' . $_SERVER['HTTP_HOST'];
    }

    public static function previous_url(): string
    {
        return $_SERVER['HTTP_REFERER'];
    }

    public static function make_link($url): string
    {
        return self::base_url() . $url;
    }
}
