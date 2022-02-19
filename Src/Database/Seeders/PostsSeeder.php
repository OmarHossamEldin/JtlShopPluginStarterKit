<?php

namespace Plugin\JtlShopPluginStarterKit\Src\Database\Seeders;

use Plugin\JtlShopPluginStarterKit\Src\Models\Post;

class PostsSeeder
{
    public function create()
    {
       
        for ($i = 0; $i <= 5; $i++) {
            $post     = new Post();
            $post->create([
                'title' => 'title' . $i,
                'body' => 'body' . $i
            ]);
        }
    }
}
