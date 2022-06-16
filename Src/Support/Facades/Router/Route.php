<?php

namespace MvcCore\Jtl\Support\Facades\Router;

use MvcCore\Jtl\Exceptions\RouteNotFoundException;
use MvcCore\Jtl\Helpers\Response;
use MvcCore\Jtl\Support\Http\Request;

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
    public static function register(string $route, string $requestType, $action): void
    {
        self::$routes[$requestType][$route] = $action;
    }

    /**
     * resolve routes
     *
     * @param [string] $route
     * @param [string] $Request
     * @return RouteHandler
     */
    public static function resolve(string $fetch, string $requestType, ?int $pluginId = null)
    {
        if (!!stripos($fetch, '?') === false) {
            return;
        }
        $fetch = explode('?', $fetch)[1] ?? null;
        if (!$fetch) {
            return;
        }

        if (stripos($fetch, 'return') === 0) {
            $fetch = explode('=', $fetch)[1];
            $route = explode('&', $fetch)[0];
            $action = self::$routes[$requestType][$route] ?? null;
            if (!$action) {
                throw new RouteNotFoundException();
            }
            return RouteHandler::call($action, $pluginId);
        }

        if (stripos($fetch, 'redirect') === 0) {
            $fetch = explode('=', $fetch)[1];
            $route = explode('&', $fetch)[0];

            $action = self::$routes[$requestType][$route] ?? null;

            if (!$action) {
                throw new RouteNotFoundException();
            }
            return RouteHandler::call($action, $pluginId);
        }

        if (!!stripos($fetch, '&') === true) {
            $fetch = explode('&', $fetch)[1];
        } else {
            $route = explode('=', $fetch)[1];
            if ((int)$pluginId === (int)$route) {
                return;
            }
        }
        $route = explode('=', $fetch)[1];

        $action = self::$routes[$requestType][$route] ?? null;

        if (!$action) {
            throw new RouteNotFoundException();
        }
        return RouteHandler::call($action, $pluginId);
    }

    /**
     * resolve routes
     *
     * @param [string] $route
     * @param [string] $Request
     * @return RouteHandler
     */
    public static function resolveApi(string $route, string $requestType)
    {
        $route = explode('io.php', $route)[1];
        $request = new Request();
        if ($request->all()['io'] === 'request') {
            $action = self::$routes[$requestType][$route] ?? null;

            if (!$action) {
                $action = self::get_action($requestType, $route);

                if ($action === false) {
                    set_exception_handler(function ($exception) {
                        return Response::json(['message' => $exception->getMessage()], 404);
                    });
                    throw new RouteNotFoundException();
                }
            }
            return RouteHandler::call($action);
        }
    }

    /**
     * Undocumented function
     *
     * @param [type] ...$action
     * @return void
     */
    public static function get_action(...$action)
    {
        [$requestType, $route] = $action;

        // get the request uri
        $uri = $route;

        // trim slashes from request uri
        $uri = trim($uri, '/');
        // get all routes for request type
        $routes = self::$routes[$requestType] ?? [];

        //route params 
        $routeParams = false;

        foreach ($routes as $route => $action) {
            // trim slashes for registered routes
            $route = trim($route, '/');
            $routeNames = [];

            if (!$route) {
                continue;
            }
            // find all route names from route  and save it in $routeNames 
            if (preg_match_all('/\{(\w+)(:[^}]+)?}/', $route, $matches)) {
                $routeNames = $matches[1];
            }
            // convert route name intor regex pattern
            $routeRegex = "@^" . preg_replace_callback(
                '/\{(\w+)(:[^}]+)?}/',
                fn ($match) => isset($match[2]) ? "({$match[2]})" : '(\w+)',
                $route
            ) . "$@";

            // test and match current route against $routeRegex
            if (preg_match_all($routeRegex, $uri, $valueMatches)) {
                $values = [];
                for ($i = 1; $i < count($valueMatches); $i++) {
                    $values[] = $valueMatches[$i][0];
                }
                $routeParams = array_combine($routeNames, $values);
                $request = new Request();
                $request->set_route_params($routeParams);
                return $action;
            }
        }
        return false;
    }

    public static function execute($controllerMethod)
    {
        return RouteHandler::call($controllerMethod);
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
