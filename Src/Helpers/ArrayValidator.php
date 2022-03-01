<?php

namespace Plugin\JtlShopPluginStarterKit\Src\Helpers;

class ArrayValidator
{
    private array $array;

    public function __construct($array)
    {
        $this->array = $array;
    }

    public function array_keys_exists(...$keys): bool
    {
        foreach ($keys as $key) {
            $result = array_key_exists($key, $this->array);
        }
        return $result;
    }
}
