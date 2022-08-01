<?php

namespace MvcCore\Jtl\Database\Seeders;

use MvcCore\Jtl\Models\Post;

class PostsSeeder
{
    public function create()
    {
        for ($i = 1; $i <= 7; $i++) {
            Post::create([
                'title' => 'title' . $i,
                'body' => 'body' . $i,
                'tec_see_category_id' => $i,
                'quantity' => $i * 20
            ]);
        }
    }
}
