<?php

namespace Plugin\JtlShopStarterKite\Src\Support;

class MiddlewareHandler
{
    const MIDDLEWARES_NAMESPACE = 'Plugin\JtlShopStarterKite\Src\Middlewares';
    const METHOD = 'handel';

    public static function call(string $middleware)
    {
        if (is_string($middleware)) {
            $middleware = self::MIDDLEWARES_NAMESPACE . $middleware;

            if (class_exists($middleware)) {
                if (method_exists($middleware, self::METHOD)) {
                    return call_user_func([$middleware, self::METHOD]);
                }
            }
        }
    }
}
