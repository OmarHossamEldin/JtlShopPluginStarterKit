<?php

namespace MvcCore\Jtl\Database\Seeders;

use MvcCore\Jtl\Models\Category;

class CategoriesSeeder
{
    public function create()
    {
        for ($i = 0; $i <= 7; $i++) {
            Category::create([
                'name' => 'name' . $i,
                'description' => 'description' . $i,
            ]);
        }
    }
}
