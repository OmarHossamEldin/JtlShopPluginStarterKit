<?php

namespace MvcCore\Jtl\Support\Facades\Localization;

use JTL\Shop;

class Lang
{
    const GERMAN = 1;

    const ENGLISH = 2;

    public static function get(): string
    {
        $lang =  Shop::getLanguageID();

        switch ($lang) {
            case self::GERMAN:
                $lang = 'de';
                break;
            case self::ENGLISH:
                $lang = 'en';
                break;
            default:
                $lang = 'de';
        };
        return $lang;
    }


    public static function set(?string $lang = null): bool
    {
        switch ($lang) {
            case 'de':
                Shop::setLanguage(self::GERMAN);
                break;
            case 'en':
                Shop::setLanguage(self::ENGLISH);
                break;
            default:
                Shop::setLanguage(self::GERMAN);
        };
        return true;
    }
}
