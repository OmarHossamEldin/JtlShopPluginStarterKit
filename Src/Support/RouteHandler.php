<?php

namespace Plugin\JtlShopStarterKite\Src\Support;

class RouteHandler
{
    const CONTROLLERS_NAMESPACE = 'Plugin\JtlShopStarterKite\Src\Controllers';

    public static function call($handler, Object $smarty)
    {
        if (is_array($handler)) {
            [$class, $method] = $handler;
            $class = self::CONTROLLERS_NAMESPACE . '\\' . $class;
            if (class_exists($class)) {
                $class = new $class;
                if (method_exists($class, $method)) {
                    return call_user_func_array([$class, $method], [$smarty]);
                }
            }
        }
        if (is_string($handler)) {
            [$class, $method] = explode('@', $handler);
            $class = self::CONTROLLERS_NAMESPACE . '\\' . $class;
            if (class_exists($class)) {
                $class = new $class;
                if (method_exists($class, $method)) {
                    return call_user_func_array([$class, $method], [$smarty]);
                }
            }
        }
        if (is_callable($handler)) {
            return call_user_func_array($handler, [$smarty]);
        }
    }
}
