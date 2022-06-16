<?php

namespace MvcCore\Jtl\Database\Seeders;

use MvcCore\Jtl\Database\Initialization\Seeder;
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
