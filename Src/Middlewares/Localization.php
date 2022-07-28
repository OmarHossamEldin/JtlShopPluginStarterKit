<?php

namespace MvcCore\Jtl\Middlewares;

use MvcCore\Jtl\Support\Facades\Localization\Translate;
use MvcCore\Jtl\Database\Initialization\Database;
use JTL\Shop;

class Localization
{
    public static function handle()
    {
        $smarty        = Shop::Smarty();

        $translations['frontend'] = Translate::getTranslations('frontend');

        $smarty->assign('translations', $translations);
        
        $database = new Database();
        $database->connect();
    }
}
