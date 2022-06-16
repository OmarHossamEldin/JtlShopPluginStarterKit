<?php

namespace MvcCore\Jtl\Services;

use MvcCore\Jtl\Exceptions\DatabaseQueryException;
use MvcCore\Jtl\Exceptions\RouteNotFoundException;
use MvcCore\Jtl\Helpers\Response;
use MvcCore\Jtl\Support\Facades\Router\Route;
use MvcCore\Jtl\Support\Http\Request;

class RoutesService
{

    public function backend_executions()
    {
    }

    public function backend_endpoints()
    {
        MiddlewaresService::load();

        Route::group(['Localization', 'Ajax',  'CsrfAuthentication','CheckApiCredentials'], function () {

            Route::post('/get/categories', 'Admin\CategoryController@index');
            Route::post('/categories', 'Admin\CategoryController@store');
            Route::post('/update/categories/{id}', 'Admin\CategoryController@update');
            Route::post('/delete/categories/{id}', 'Admin\CategoryController@destroy');
            Route::post('/get/categories/all', 'Admin\CategoryController@all');


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
        });
        try {
            Route::resolveApi(Request::uri(), Request::type());
        } catch (RouteNotFoundException $exception) {
            return Response::json(['message' => $exception->getMessage()], 404);
        } catch (DatabaseQueryException $exception) {
            return Response::json(['message' => $exception->getMessage()], 422);
        }
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
