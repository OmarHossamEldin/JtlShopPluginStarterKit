<?php

namespace MvcCore\Jtl\Support\Facades\Middleware;

class RegisterMiddlewares
{
    private static $middlewares = [];

    private static $calledMiddleware = [];

    private static $singleRouteMiddleware = [];

    public static function register(array $middlewares)
    {
        self::$middlewares = $middlewares;
    }

    public static function get_middleware(string $middleware)
    {
        return self::$middlewares[$middleware];
    }

    public static function list_registered_middlewares(): array
    {
        return self::$middlewares;
    }

    public static function register_middleware_to_call(string $middlewareKey): bool
    {
        $middleware = self::$middlewares[$middlewareKey];
        self::$calledMiddleware[$middlewareKey] = $middleware;
        return true;
    }

    public static function register_route_middleware_to_call(string $middlewareKey): bool
    {
        $middleware = self::$middlewares[$middlewareKey];
        self::$singleRouteMiddleware[$middlewareKey] = $middleware;
        return true;
    }

    public static function get_route_middleware_to_call(): array
    {
        return self::$singleRouteMiddleware;
    }

    public static function list_called_middlewares(): array
    {
        return self::$calledMiddleware;
    }
}
