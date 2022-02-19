<?php

namespace Plugin\JtlShopPluginStarterKit\Src\Database\Seeders;


class DatabaseSeeder
{
    public function run()
    {
        $postSeeder = new PostsSeeder();
        $postSeeder->create();
    }
}
