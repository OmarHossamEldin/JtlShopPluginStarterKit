<?php

namespace MvcCore\Jtl\Support\Http;

use MvcCore\Jtl\Helpers\ArrayValidator;

class Cookie
{
    public function add_items(array $items, $expiration)
    {
        foreach ($items as $key => $value) {
            setcookie($key, $value, $expiration);
        }
    }

    public function remove_items(string ...$items): bool
    {
        foreach ($items as $item) {
            setcookie($item, "", time() - 3600);
        }
        return true;
    }

    public function get_items(string ...$keys): array
    {
        $values = [];
        $arrayValidator = new ArrayValidator($_COOKIE);
        foreach ($keys  as $key) {
            if ($arrayValidator->array_keys_exists($key)) {
                if (isset($_COOKIE[$key])) {
                    $values[$key] = $_COOKIE[$key];
                }
            }
        }
        return $values;
    }

    public function get_cookie(): array
    {
        return $_COOKIE;
    }

    public function clear(): bool
    {
        $_COOKIE = [];
        return true;
    }
}
