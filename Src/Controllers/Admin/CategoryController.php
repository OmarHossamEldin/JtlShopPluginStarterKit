<?php

namespace Plugin\JtlShopPluginStarterKit\Src\Controllers\Admin;

use Plugin\JtlShopPluginStarterKit\Src\Support\Http\Request;
use Plugin\JtlShopPluginStarterKit\Src\Models\Category;
use JTL\Shop;
use Plugin\JtlShopPluginStarterKit\Src\Helpers\Response;
use Plugin\JtlShopPluginStarterKit\Src\Middlewares\CheckApiCredentials;
use Plugin\JtlShopPluginStarterKit\Src\Requests\CategoryStoreRequest;
use Plugin\JtlShopPluginStarterKit\Src\Requests\CategoryUpdateRequest;
use Plugin\JtlShopPluginStarterKit\Src\Requests\deleteCategoryRequest;
use Plugin\JtlShopPluginStarterKit\Src\Requests\getCategoryDetailsRequest;
use Plugin\JtlShopPluginStarterKit\Src\Support\Debug\Debugger;
use Plugin\JtlShopPluginStarterKit\Src\Support\Http\Session;
use Plugin\JtlShopPluginStarterKit\Src\Validations\Alerts;

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
        $smarty   = Shop::Smarty();
        $category     = new Category();

        $categories    = $category->select('id','name', 'description')->get();
        $smarty->assign('categories', $categories);
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
        $checkCredentials = new CheckApiCredentials;
        $checkCredentials->handle();

        $validatedData = $request->validated();
        $post = new Category();
        $post->create([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
        ]);
        Alerts::show('success', ['category' => 'Category is created successfully']);
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
        $checkCredentials = new CheckApiCredentials;
        $checkCredentials->handle();

        $validatedData = $request->validated();
        $post = new Category();
        $post->update([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
        ], $validatedData['categoryId']);
        return Response::json([
            'message' => 'category is updated successfully',
        ], 201);
    }

    /**
     * delete a post
     *
     * @param deleteCategoryRequest $request
     * @param integer $pluginId
     * @return void
     */
     public function destroy(deleteCategoryRequest $request)
    {
        $validatedData = $request->validated();
        $category = new Category();
        $category->delete($validatedData['categoryId']);
        return Response::json([
            'message' => 'category is deleted successfully',
        ], 201);
    }

    /**
     * get post data
     *
     * @param getPostDetailsRequest $request
     * @param integer $pluginId
     * @return void
     */    public function getPostData(getCategoryDetailsRequest $request)
    {
        $validatedData = $request->validated();
        $category = new Category();
        $categoryData = $category->select('id', 'name', 'description')
            ->where('id', $validatedData['categoryId'])
            ->get();

        $category = (object)$categoryData[0];
        //category_id

        return Response::json([
            'category' => $category,
        ], 200);
    }
}
