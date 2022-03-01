<?php

namespace Plugin\JtlShopPluginStarterKit\Src\Controllers\Admin;

use Plugin\JtlShopPluginStarterKit\Src\Requests\PostStoreRequest;
use Plugin\JtlShopPluginStarterKit\Src\Support\Http\Request;
use Plugin\JtlShopPluginStarterKit\Src\Models\Post;
use JTL\Shop;
use Plugin\JtlShopPluginStarterKit\Src\Support\Debug\Debugger;

class PostController
{
    /**
     * list posts
     *
     * @param Request $request
     * @param integer $pluginId
     * @return void
     */
    public function index(Request $request, int $pluginId)
    {
        $smarty   = Shop::Smarty();
        $post     = new Post();
        $posts    = $post->all();
        $smarty->assign('pluginId', $pluginId);
        $smarty->assign('posts', $posts);
    }

    /**
     * store a post
     *
     * @param PostStoreRequest $request
     * @param integer $pluginId
     * @return void
     */
    public function store(PostStoreRequest $request, int $pluginId)
    {
        $validatedData = $request->validated();
        $smarty   = Shop::Smarty();
        $post = new Post();
        $post->create($validatedData);
    }
}
