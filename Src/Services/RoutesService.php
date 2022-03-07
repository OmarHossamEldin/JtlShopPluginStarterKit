<?php

namespace Plugin\JtlShopPluginStarterKit\Src\Services;

use Plugin\JtlShopPluginStarterKit\Src\Support\Facades\Router\Route;
use Plugin\JtlShopPluginStarterKit\Src\Support\Http\Request;

class RoutesService
{
    public function adminRoutes($plugin)
    {
        $pluginId = $plugin->getId();
        /* routes */
        Route::group(['VerifyFormCsrfToken'], function () {
            Route::post('posts', 'Admin\PostController@store');
        });
        
        //Route::get('get-post-data', 'Admin\PostController@getPostData');

        Route::resolve(Request::uri(), Request::type(), $pluginId);

        Route::execute('Admin\PostController@index', $pluginId);
    }

    public function frontEndRoutes($plugin)
    {
        $pluginId = $plugin->getId();

        Route::group(['VerifyAjaxRequest'], function () {
            Route::get('posts', 'Frontend\PostController@index');
            Route::post('fathy', 'Admin\PostController@getPostData');

        });


        Route::resolve(Request::uri(), Request::type(), $pluginId);
    }
}
