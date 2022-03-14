<?php

namespace Plugin\JtlShopPluginStarterKit\Src\Helpers;
class ArrayValidator
{
    private array $array;

    public function __construct(?array $array = [])
    {
        $this->array = $array;
    }

    public function array_keys_exists(...$keys): bool
    {
        $result = true;
        foreach ($keys as $key) {
            $result = array_key_exists($key, $this->array) ? true : ($result && array_key_exists($key, $this->array));
        }
        return $result;
    }

    public function keys_are_equal($array1 ,$array2)
    {
        return !array_diff_key($array1, $array2) && !array_diff_key($array2, $array1);
    }
}
