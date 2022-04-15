<?php

namespace Plugin\JtlShopPluginStarterKit\Src\Middlewares;

use Plugin\JtlShopPluginStarterKit\Src\Support\Facades\Authentication\CsrfAuthentication;
use Plugin\JtlShopPluginStarterKit\Src\Support\Facades\Middleware\BaseMiddleware;
use Plugin\JtlShopPluginStarterKit\Src\Support\Facades\Localization\Translate;
use Plugin\JtlShopPluginStarterKit\Src\Support\Facades\Faker\Faker;
use Plugin\JtlShopPluginStarterKit\Src\Support\Http\Header;

class GuestMiddleware extends BaseMiddleware
{
    public function handle()
    {
        $header = new Header();
        $faker = new Faker();
        $token = $faker->fakerString->random_string(60);
        $header->set('token', $token);

        $smarty        = Shop::Smarty();

        $token = CsrfAuthentication::get_token();

        $smarty->assign('jtlToken', $token);

        $translations = Translate::getTranslations('frontend');

        $smarty->assign('translations', $translations);

    }
}
