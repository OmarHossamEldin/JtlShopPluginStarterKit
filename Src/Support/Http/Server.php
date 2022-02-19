<?php

namespace Plugin\JtlShopPluginStarterKit\Src\Support\Http;

class Server
{
    public const BASE_URL = isset($_SERVER['HTTPS']) ? 'https://' : 'http://' . $_SERVER['HTTP_HOST'];

    public const PREVIOUS_URL = $_SERVER['HTTP_REFERER'];

    public static function make_link($url): string
    {
        return self::BASE_URL . $url;
    }
}
