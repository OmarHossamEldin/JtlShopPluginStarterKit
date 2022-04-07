<?php

namespace Plugin\JtlShopPluginStarterKit\Src\Support\Facades\Localization;

use Plugin\JtlShopPluginStarterKit\Src\Support\Facades\Filesystem\DirectoryComposer;

class Translate
{
    public static function translate($fileName, $key): string
    {
        $lang = Lang::get();
        $directory = new DirectoryComposer();
        $fileName = require("{$directory->pluginRoot}/Src/Langs/{$lang}/{$fileName}.php");
        return $fileName[$key];
    }

    public static function getTranslations($fileName): array
    {
        $lang = Lang::get();
        $directory = new DirectoryComposer();
        $fileName = require("{$directory->pluginRoot}/Src/Langs/{$lang}/{$fileName}.php");
        return $fileName;
    }
}
