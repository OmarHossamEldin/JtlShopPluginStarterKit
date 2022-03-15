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
            Route::delete('posts', 'Admin\PostController@destroy');


            Route::post('api-credentials', 'Admin\ApiCredentialsController@create');
            Route::delete('api-credentials', 'Admin\ApiCredentialsController@destroy');
            Route::put('api-credentials', 'Admin\ApiCredentialsController@update');
        });
        
        //Route::get('get-post-data', 'Admin\PostController@getPostData');

        Route::execute('Admin\ApiCredentialsController@index', $pluginId);

        Route::resolve(Request::uri(), Request::type(), $pluginId);

        Route::execute('Admin\PostController@index', $pluginId);
    }

    public function frontEndRoutes($plugin)
    {
        $pluginId = $plugin->getId();

        Route::group(['VerifyAjaxRequest'], function () {
            Route::get('posts', 'Frontend\PostController@index');
            Route::post('get-post', 'Admin\PostController@getPostData');
            Route::post('get-credential', 'Admin\ApiCredentialsController@getCredentialData');  
        });

        Route::resolve(Request::uri(), Request::type(), $pluginId);
    }
}
