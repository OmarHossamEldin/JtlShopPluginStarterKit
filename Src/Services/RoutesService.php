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
        Route::execute('Admin\CategoryController@index');
        Route::execute('Admin\EmailCredentialsController@index');
        
    }

    public function backend_endpoints()
    {
        Route::post('/get/categories', 'Admin\CategoryController@index');
        Route::post('/categories', 'Admin\CategoryController@store');
        Route::post('/update/categories/{id}', 'Admin\CategoryController@update');
        Route::post('/delete/categories/{id}', 'Admin\CategoryController@destroy');

        Route::post('/get/posts', 'Admin\PostController@index');
        Route::post('/posts', 'Admin\PostController@store');
        Route::post('/update/posts/{id}', 'Admin\PostController@update');
        Route::post('/delete/posts/{id}', 'Admin\PostController@destroy');

        Route::post('/get/api-credentials', 'Admin\ApiCredentialsController@index');
        Route::post('/api-credentials', 'Admin\ApiCredentialsController@store');
        Route::post('/update/api-credentials/{id}', 'Admin\ApiCredentialsController@update');
        Route::post('/delete/api-credentials/{id}', 'Admin\ApiCredentialsController@destroy');

        Route::post('/get/email-credentials', 'Admin\EmailCredentialsController@index');
        Route::post('/email-credentials', 'Admin\EmailCredentialsController@store');
        Route::post('/update/email-credentials/{id}', 'Admin\EmailCredentialsController@update');
        Route::post('/delete/email-credentials/{id}', 'Admin\EmailCredentialsController@destroy');

        Route::post('/test/email', 'Admin\TestEmailCredentialsController@testEmailCredentials');


        Route::resolveApi(Request::uri(), Request::type());
    }

    public function frontend_executions()
    {
        Route::execute('Frontend\PostController@index');
    }


    public function frontend_endpoints()
    {

        Route::resolveApi(Request::uri(), Request::type());
    }
}
