<?php

namespace MvcCore\Jtl\Controllers\Frontend;

use MvcCore\Jtl\Support\Http\Request;
use MvcCore\Jtl\Helpers\Response;
use MvcCore\Jtl\Models\Post;
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
