<?php

namespace Plugin\JtlShopPluginStarterKit\Src\Validations;

use Plugin\JtlShopPluginStarterKit\Src\Support\Lang;

class ValidationMessage
{
    public static function get($key)
    {
        $lang = Lang::get();
        $messages = include(__DIR__ . "/../Langs/{$lang}/validations.php");
        return $messages[$key];
    }
}