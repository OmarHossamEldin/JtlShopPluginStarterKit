<?php

namespace MvcCore\Jtl\Database\Seeders;

use MvcCore\Jtl\Support\Facades\Faker\Faker;
use MvcCore\Jtl\Models\Category;

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
