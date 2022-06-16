<?php

namespace MvcCore\Jtl\Database\Seeders;

use MvcCore\Jtl\Support\Facades\Faker\Faker;
use MvcCore\Jtl\Models\Post;

class PostsSeeder
{
    public function create()
    {
        $faker = new Faker();
        for ($i = 1; $i <= 7; $i++) {
            $post     = new Post();
            //$faker->fakerImage('posts', "picture$i.jpg");
            $post->create([
                'title' => 'title' . $i,
                'body' => 'body' . $i,
                'tec_see_category_id' => $i,
                'quantity' => $i * 20,
                //'image_path' => "picture$i.jpg"
            ]);
        }
    }
}
