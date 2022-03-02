<?php

namespace Plugin\JtlShopPluginStarterKit\Src\Support\Facades\Localization;

use Plugin\JtlShopPluginStarterKit\Src\Support\Facades\Filesystem\Directory;

class Translate
{
    public static function translate($fileName, $key): string
    {
        $lang = Lang::get();
        $directory = new Directory();
        $fileName = require("{$directory->pluginRoot}/Src/Langs/{$lang}/{$fileName}.php");
        return $fileName[$key];
    }

    public static function getTranslations($fileName): array
    {
        $lang = Lang::get();
        $directory = new Directory();
        $fileName = require("{$directory->pluginRoot}/Src/Langs/{$lang}/{$fileName}.php");
        return $fileName;
    }
}
