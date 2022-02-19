<?php

namespace Plugin\JtlShopPluginStarterKit\Src\Support\Facades\Localization;

class Translate
{
    public static function translate($fileName,$key)
    { 
        $lang = Lang::get();
        $fileName = require_once(__DIR__ . "/../Langs/{$lang}/{$fileName}.php");
        return $fileName[$key];

    }

    public static function getTranslations($fileName)
    {
        $lang = Lang::get();
        $fileName = require_once(__DIR__ . "/../Langs/{$lang}/{$fileName}.php");
        return $fileName;
    }
}