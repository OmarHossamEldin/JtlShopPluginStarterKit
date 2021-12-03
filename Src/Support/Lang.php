<?php

namespace Plugin\JtlShopStarterKite\Src\Support;

use JTL\Shop;

class Lang
{
    public static function get()
    {
        $lang = null;
        $lang ??=  Shop::getLanguageID();

        switch($lang){
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