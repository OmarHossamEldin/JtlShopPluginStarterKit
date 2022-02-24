<?php

namespace Plugin\JtlShopPluginStarterKit\Src\Support\Http;

class Header
{
    public const HEADERS = getallheaders();

    public static function get(String $key): string
    {
        return self::HEADERS[$key];
    }

    public static function has(String $key): bool
    {
        return array_key_exists($key, self::HEADERS);
    }

    public function set(String $key, String $content): self
    {
        header("$key: $content");
        return $this;
    }

    public function statusCode(int $statusCode)
    {
        http_response_code($statusCode);
    }
}
