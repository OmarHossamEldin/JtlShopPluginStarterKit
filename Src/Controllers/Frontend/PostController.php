<?php

namespace Plugin\JtlShopPluginStarterKit\Src\Controllers\Frontend;

use Plugin\JtlShopPluginStarterKit\Src\Support\Http\Request;
use Plugin\JtlShopPluginStarterKit\Src\Helpers\Response;
use Plugin\JtlShopPluginStarterKit\Src\Models\Post;
use JTL\Shop;

class PostController
{
    public function index(Request $request, int $pluginId)
    {
        $post     = new Post;
        $posts    = $post->all();
        return Response::json(['posts' => $posts]);
    }
}
