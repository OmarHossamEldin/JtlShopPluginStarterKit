<?php

namespace MvcCore\Jtl\Middlewares;

use MvcCore\Jtl\Support\Facades\Localization\Translate;
use JTL\Shop;

class Localization
{
    public static function handle()
    {
        $smarty        = Shop::Smarty();

        $translations['frontend'] = Translate::getTranslations('frontend');

        $smarty->assign('translations', $translations);
    }
}
