<?php

namespace Plugin\JtlShopPluginStarterKit\Src\Middlewares;

use Plugin\JtlShopPluginStarterKit\Src\Support\Facades\Localization\Translate;
use JTL\Shop;

class Localization
{
    public static function handle()
    {
        $smarty        = Shop::Smarty();

        $translations = Translate::getTranslations('frontend');

        $smarty->assign('translations', $translations);
    }
}
