<?php

namespace Plugin\JtlShopPluginStarterKit\Src\Controllers\Admin;

use Plugin\JtlShopPluginStarterKit\Src\Requests\PostStoreRequest;
use Plugin\JtlShopPluginStarterKit\Src\Support\Http\Request;
use Plugin\JtlShopPluginStarterKit\Src\Models\Post;
use JTL\Shop;
use Plugin\JtlShopPluginStarterKit\Src\Helpers\Response;
use Plugin\JtlShopPluginStarterKit\Src\Middlewares\CheckApiCredentials;
use Plugin\JtlShopPluginStarterKit\Src\Requests\getPostDetailsRequest;
use Plugin\JtlShopPluginStarterKit\Src\Requests\PostDeleteRequest;
use Plugin\JtlShopPluginStarterKit\Src\Support\Debug\Debugger;
use Plugin\JtlShopPluginStarterKit\Src\Support\Http\Session;
use Plugin\JtlShopPluginStarterKit\Src\Validations\Alerts;

class PostController
{
    /**
     * list posts
     *
     * @param Request $request
     * @param integer $pluginId
     * @return void
     */
    public function index(Request $request,int $pluginId)
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
    public function store(PostStoreRequest $request)
    {
        $checkCredentials = new CheckApiCredentials;
        $checkCredentials->handle();

        $validatedData = $request->validated();
        $post = new Post();
        $post->create($validatedData);
        Alerts::show('success', ['post' => 'is created successfully']);
    }

    /**
     * delete a post
     *
     * @param PostDeleteRequest $request
     * @param integer $pluginId
     * @return void
     */
    public function destroy(PostDeleteRequest $request)
    {
        $validatedData = $request->validated();
        $post = new Post();
        $post->delete($validatedData['postId']);
        Alerts::show('success', ['post' => 'is deleted successfully']);
    }

    /**
     * get post data
     *
     * @param getPostDetailsRequest $request
     * @param integer $pluginId
     * @return void
     */
    public function getPostData(getPostDetailsRequest $request)
    {
        $validatedData = $request->validated();
        $post = new Post();
        $postData = $post->select('id', 'title', 'body')
            ->where('id', $validatedData['post_id'])
            ->get();

        $post = (object)$postData[0];
        //post_id

        return Response::json([
            'post' => $post,
        ], 200);
    }
}
