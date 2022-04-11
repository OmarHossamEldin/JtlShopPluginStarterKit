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
        Route::resolveApi(Request::uri(), Request::type());
    }

    public function frontend_executions()
    {
        Route::execute('Frontend\PostController@index');
    }


    public function frontend_endpoints()
    {

        Route::post('/store/email-credentials', 'Admin\EmailCredentialsController@store');
        Route::post('/test/email', 'Admin\TestEmailCredentialsController@testEmailCredentials');
        Route::post('/get/email-credential', 'Admin\EmailCredentialsController@getEmailCredentials');
        Route::post('/update/email-credential', 'Admin\EmailCredentialsController@update');
        Route::post('/delete/email-credential', 'Admin\EmailCredentialsController@destroy');


        Route::post('/store/post', 'Admin\PostController@store');
        Route::post('/update/post', 'Admin\PostController@update');
        Route::post('/get/post', 'Admin\PostController@getPostData');
        Route::post('/delete/post', 'Admin\PostController@destroy');


        Route::post('/store/category', 'Admin\CategoryController@store');
        Route::post('/update/category', 'Admin\CategoryController@update');
        Route::post('/get/category', 'Admin\CategoryController@getPostData');
        Route::post('/delete/category', 'Admin\CategoryController@destroy');


        Route::post('/store/api-credential', 'Admin\ApiCredentialsController@store');
        Route::post('/update/api-credential', 'Admin\ApiCredentialsController@update');
        Route::post('/get/api-credential', 'Admin\ApiCredentialsController@getCredentialData');
        Route::post('/delete/api-credential', 'Admin\ApiCredentialsController@destroy');

        Route::resolveApi(Request::uri(), Request::type());
    }
}
