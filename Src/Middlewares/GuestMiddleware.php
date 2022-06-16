<?php

namespace MvcCore\Jtl\Middlewares;

use MvcCore\Jtl\Support\Facades\Authentication\CsrfAuthentication;
use MvcCore\Jtl\Support\Facades\Middleware\BaseMiddleware;
use MvcCore\Jtl\Support\Facades\Localization\Translate;
use MvcCore\Jtl\Support\Facades\Faker\Faker;
use MvcCore\Jtl\Support\Http\Header;

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
