<?php

namespace MvcCore\Jtl\Support\Http;

class Server
{
    public static function base_url(): string
    {
        $protocol = isset($_SERVER['HTTPS']) ? 'https://' : 'http://';
        $host = $_SERVER['HTTP_HOST'];
        return $protocol . $host;
    }

    public static function previous_url(): string
    {
        return $_SERVER['HTTP_REFERER'] ?? self::base_url();
    }

    public static function make_link($url): string
    {
        return self::base_url() . $url;
    }
}
