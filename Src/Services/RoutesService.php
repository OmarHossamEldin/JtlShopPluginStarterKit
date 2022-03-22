<?php

namespace Plugin\JtlShopPluginStarterKit\Src\Services;

use Plugin\JtlShopPluginStarterKit\Src\Support\Facades\Router\Route;
use Plugin\JtlShopPluginStarterKit\Src\Support\Http\Request;

class RoutesService
{

    public function backend_executions()
    {
        Route::execute('Admin\ApiCredentialsController@index');
        Route::execute('Admin\PostController@index');
    }

    public function backend_endpoints()
    {
        Route::post('posts', 'Admin\PostController@store');
        Route::delete('posts', 'Admin\PostController@destroy');


        Route::post('api-credentials', 'Admin\ApiCredentialsController@create');
        Route::delete('api-credentials', 'Admin\ApiCredentialsController@destroy');
        Route::put('api-credentials', 'Admin\ApiCredentialsController@update');

        Route::resolveApi(Request::uri(), Request::type());
    }

    public function frontend_executions()
    {
        Route::execute('Frontend\PostController@index');
    }


    public function frontend_endpoints()
    {

        Route::post('/get-post/{id}', 'Admin\PostController@getPostData');
        Route::post('/get-credential/{id}', 'Admin\ApiCredentialsController@getCredentialData');

        Route::resolveApi(Request::uri(), Request::type());
    }
}
