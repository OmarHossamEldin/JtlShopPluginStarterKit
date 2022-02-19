<?php

namespace Plugin\JtlShopPluginStarterKit\Src\Support\Facades\Localization;

use JTL\Shop;

class Lang
{
    public static function get(): string
    {
        $lang =  Shop::getLanguageID();

        switch ($lang) {
            case 1:
                $lang = 'de';
                break;
            case 2:
                $lang = 'en';
                break;
            default:
                $lang = 'de';
        };
        return $lang;
    }
}
