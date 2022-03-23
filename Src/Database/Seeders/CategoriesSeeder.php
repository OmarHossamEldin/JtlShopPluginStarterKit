<?php

namespace Plugin\JtlShopPluginStarterKit\Src\Database\Seeders;

use Plugin\JtlShopPluginStarterKit\Src\Support\Facades\Faker\Faker;
use Plugin\JtlShopPluginStarterKit\Src\Models\Category;

class CategoriesSeeder
{
    public function create()
    {
        $faker = new Faker();
        for ($i = 0; $i <= 7; $i++) {
            $category     = new Category();
            //$faker->fakerImage('categorys', "picture$i.jpg");
            $category->create([
                'name' => 'name' . $i,
                'description' => 'description' . $i,
                //'image_path' => "picture$i.jpg"
            ]);
        }
    }
}
