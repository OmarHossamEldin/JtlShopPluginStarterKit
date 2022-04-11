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
use Plugin\JtlShopPluginStarterKit\Src\Requests\PostUpdateRequest;
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
    public function index(Request $request)
    {
        $smarty   = Shop::Smarty();
        $post     = new Post();


        $posts    = $post->select('id', 'title', 'body')
            ->with('category:name,description')->get();
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
        $post->create([
            'title' => $validatedData['title'],
            'body' => $validatedData['body'],
            'tec_see_category_id' => $validatedData['tec_see_category_id'],
        ]);

        return Response::json([
            'message' => 'post is created successfully',
        ], 201);
    }

    /**
     * update a post
     *
     * @param PostUpdateRequest $request
     * @param integer $pluginId
     * @return void
     */
    public function update(PostUpdateRequest $request)
    {
        $checkCredentials = new CheckApiCredentials;
        $checkCredentials->handle();

        $validatedData = $request->validated();
        $post = new Post();
        $post->update([
            'title' => $validatedData['title'],
            'body' => $validatedData['body'],
            'tec_see_category_id' => $validatedData['tec_see_category_id'],
        ], $validatedData['postId']);
        return Response::json([
            'message' => 'post is updated successfully',
        ], 201);
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
        return Response::json([
            'message' => 'post is deleted successfully',
        ], 201);
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
        $postData = $post->select('id', 'title', 'body', 'tec_see_category_id')
            ->where('id', $validatedData['postId'])
            ->get();

        $post = (object)$postData[0];
        //post_id

        return Response::json([
            'post' => $post,
        ], 200);
    }
}
