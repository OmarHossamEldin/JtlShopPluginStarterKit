<?php

namespace Plugin\JtlShopStarterKite\Src\Support;

class Route
{
    const CONTROLLERSNAMESPACE = 'Plugin\JtlShopStarterKite\Src\Controllers';

    public static function get(String $controllerMethod, Object $smarty = null)
    {
        if (RequestType::get() === 'GET' && RequestType::getNotEmpty()) {
            return RouteHandler::call($controllerMethod, $smarty);
        }
    }

    public static function post(String $controllerMethod, Object $smarty = null)
    {
        if (RequestType::get() === 'POST') {
            return RouteHandler::call($controllerMethod, $smarty);
        }
    }

    public static function group(array $middlewares, array $controllersMethods, Object $smarty = null)
    {
        array_map(function ($controllerMethod) use ($middlewares, $smarty) {
            array_map(function ($middleware) {
                MiddlewareHandler::call($middleware);
            }, $middlewares);
            return RouteHandler::call($controllerMethod, $smarty);
        }, $controllersMethods);
    }
}
