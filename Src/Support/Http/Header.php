<?php

namespace MvcCore\Jtl\Support\Http;

class Header
{
    public static function get_headers(): array
    {
        return getallheaders();
    }

    public static function get(String $key): string
    {
        return self::get_headers()[$key];
    }

    public static function has(String $key): bool
    {
        return array_key_exists($key, self::get_headers());
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
