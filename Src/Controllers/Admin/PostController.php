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
        $currentPage = isset($request->all()['page']) ? $request->all()['page'] : 1;
        $post     = new Post();
        $posts    = $post->select(
            'id',
            'title',
            'body',
            'quantity'
        )->with('category:name AS category,description')
            ->paginate(10, $currentPage);

           // $posts = $post->SelectCase($conditions,'Quantity is normal', 'title','quantity')->get();

        return Response::json($posts, 200);
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
        /*         $checkCredentials = new CheckApiCredentials;
        $checkCredentials->handle(); */

        $validatedData = $request->validated();
        $post = new Post();
        $post->create([
            'title' => $validatedData['title'],
            'body' => $validatedData['body'],
            'tec_see_category_id' => $validatedData['tec_see_category_id'],
            'quantity' => $validatedData['quantity'],

        ])->first();
        return Response::json([
            'message' => 'post is created successfully',
            'post' => $post,
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
        /*         $checkCredentials = new CheckApiCredentials;
        $checkCredentials->handle(); */

        $validatedData = $request->validated();
        $params = $request->get_route_params();
        $post = new Post();
        $post = $post->update([
            'title' => $validatedData['title'],
            'body' => $validatedData['body'],
            'tec_see_category_id' => $validatedData['tec_see_category_id'],
            'quantity' => $validatedData['quantity'],
        ], $params['id'])->first();
        return Response::json(['message' => 'post updated successfully', 'post' => $post], 206);
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
        $post = new Post();
        $params = $request->get_route_params();
        $post->delete($params['id']);
        return Response::json([], 204);
    }

}
