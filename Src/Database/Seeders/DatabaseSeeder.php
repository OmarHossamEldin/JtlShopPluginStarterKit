<?php

namespace Plugin\JtlShopPluginStarterKit\Src\Database\Seeders;

use Plugin\JtlShopPluginStarterKit\Src\Database\Initialization\Seeder;
class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            CategoriesSeeder::class,
            PostsSeeder::class,
        ]);
    }
}
