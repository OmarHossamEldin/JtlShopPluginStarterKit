<?php

namespace Plugin\JtlShopPluginStarterKit\Src\Controllers\Admin;

use Plugin\JtlShopPluginStarterKit\Src\Models\Post;
use Plugin\JtlShopPluginStarterKit\Src\Support\Http\Request;
use JTL\Shop;

class PostController
{
    public function index(Request $request, int $pluginId)
    {
        $smarty   = Shop::Smarty();
        $post     = new Post();
        $posts    = $post->all();
        $smarty->assign('posts', $posts);
    }

    public function store(Request $request, int $pluginId)
    {
        
    }
}
