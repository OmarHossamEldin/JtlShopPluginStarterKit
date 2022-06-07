<?php

namespace MvcCore\Jtl\Controllers\Admin;

use MvcCore\Jtl\Support\Http\Request;
use MvcCore\Jtl\Models\Category;
use JTL\Shop;
use MvcCore\Jtl\Helpers\Response;
use MvcCore\Jtl\Middlewares\CheckApiCredentials;
use MvcCore\Jtl\Models\Post;
use MvcCore\Jtl\Requests\CategoryStoreRequest;
use MvcCore\Jtl\Requests\CategoryUpdateRequest;
use MvcCore\Jtl\Requests\deleteCategoryRequest;
use MvcCore\Jtl\Requests\getCategoryDetailsRequest;
use MvcCore\Jtl\Support\Debug\Debugger;
use MvcCore\Jtl\Support\Http\Session;
use MvcCore\Jtl\Validations\Alerts;

class CategoryController
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
        $category     = new Category();
        $categories    = $category->select(
            'id',
            'name',
            'description',
        )->paginate(10, $currentPage);

        return Response::json($categories, 200);
    }

    /**
     * store a post
     *
     * @param PostStoreRequest $request
     * @param integer $pluginId
     * @return void
     */
    public function store(CategoryStoreRequest $request)
    {
        /*         $checkCredentials = new CheckApiCredentials;
        $checkCredentials->handle(); */
        $validatedData = $request->validated();
        $category = new Category();
        $category->create([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
        ])->first();
        return Response::json([
            'message' => 'category is created successfully',
            'category' => $category,
        ], 201);
    }

    /**
     * update category
     *
     * @param CategoryUpdateRequest $request
     * @param integer $pluginId
     * @return void
     */
    public function update(CategoryUpdateRequest $request)
    {
        $validatedData = $request->validated();
        $params = $request->get_route_params();
        $category = new Category();
        $category = $category->update([
            "name" => $validatedData["name"],
            "description" => $validatedData["description"],
        ], $params['id'])->first();
        return Response::json(['message' => 'category updated successfully', 'category' => $category], 206);
    }

    /**
     * delete category
     *
     * @param deleteCategoryRequest $request
     * @param integer $pluginId
     * @return void
     */
    public function destroy(Request $request)
    {
        $params = $request->get_route_params();
        $category = new Category();
        $post = new Post;
         $posts = $post->select('id')->where('tec_see_category_id', $params['id'])->get();
        if (count($posts) > 0) {
            return Response::json(['error' => 'there is data related to this has category'], 422);
        }
        $category->delete($params['id']);
        return Response::json([], 204);

    }

        /**
     * list categories
     *
     * @param Request $request
     * @return Response
     */
    public function all(Request $request)
    {
        $category = new Category();
        $categories = $category->select('id', 'name')->get();
        return Response::json($categories, 200);
    }
}
