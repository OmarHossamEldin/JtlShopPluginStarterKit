<?php

namespace Plugin\JtlShopPluginStarterKit\Src\Support\Facades;

use Plugin\JtlShopPluginStarterKit\Src\Exceptions\RouteNotFoundException;

class Route
{
    /**
     * plugin routes
     *
     * @var array
     */
    private static array $routes = [];

    /**
     * get request
     *
     * @param  $route
     * @param  $action
     * @return void
     */
    public static function get($route, $action): void
    {
        self::register($route, 'GET', $action);
    }

    /**
     * post request
     *
     * @param  $route
     * @param  $action
     * @return void
     */
    public static function post($route, $action): void
    {
        self::register($route, 'POST', $action);
    }

    /**
     * put request
     *
     * @param  $route
     * @param  $action
     * @return void
     */
    public static function put($route, $action): void
    {
        self::register($route, 'PUT', $action);
    }

    /**
     * patch request
     *
     * @param  $route
     * @param  $action
     * @return void
     */
    public static function patch($route, $action): void
    {
        self::register($route, 'PATCH', $action);
    }

    /**
     * delete request
     *
     * @param  $route
     * @param  $action
     * @return void
     */
    public static function delete($route, $action): void
    {
        self::register($route, 'DELETE', $action);
    }

    /**
     * register routes
     *
     * @param string $route
     * @param string $Request
     * @param  $action
     * @return void
     */
    public static function register(string $route, string $Request, $action): void
    {
        self::$routes[$Request][$route] = $action;
    }

    /**
     * resolve routes
     *
     * @param [string] $route
     * @param [string] $Request
     * @return RouteHandler
     */
    public static function resolve(string $fetch, string $request, ?int $pluginId = null)
    {
        if (!!strpos($fetch, '?') === false) {
            return;
        }
        $fetch = explode('?', $fetch)[1] ?? null;
        if (!$fetch) {
            return;
        }

        if (strpos($fetch, 'return') === 0) {
            $fetch = explode('=', $fetch)[1];
            $route = explode('&', $fetch)[0];
            $action = self::$routes[$request][$route] ?? null;

            if (!$action) {
                throw new RouteNotFoundException();
            }
            return RouteHandler::call($action, $pluginId);
        }
        if (!!strpos($fetch, '&') === true) {
            $fetch = explode('&', $fetch)[1];
        } else {
            $route = explode('=', $fetch)[1];
            if ($pluginId === (int)$route) {
                return;
            }
        }
        $route = explode('=', $fetch)[1];

        $action = self::$routes[$request][$route] ?? null;

        if (!$action) {
            throw new RouteNotFoundException();
        }
        return RouteHandler::call($action, $pluginId);
    }

    public static function execute($controllerMethod, int $pluginId = null)
    {
        return RouteHandler::call($controllerMethod, $pluginId);
    }

    public static function group(array $middlewares, callable $callback)
    {
        foreach ($middlewares as $middleware) {
            MiddlewareHandler::call($middleware);
        };
        return call_user_func($callback);
    }

    public static function  routes_list(): array
    {
        return self::$routes;
    }
}
