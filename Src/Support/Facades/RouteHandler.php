<?php

namespace Plugin\JtlShopPluginStarterKit\Src\Support\Facades;

use Plugin\JtlShopPluginStarterKit\Src\Support\Http\Request;

class RouteHandler
{
    private const CONTROLLERS_NAMESPACE = 'Plugin\\JtlShopPluginStarterKit\\Src\\Controllers\\';

    public static function call($handler, int $pluginId = null)
    {
        $request = new Request();
        if (is_array($handler)) {
            [$class, $method] = $handler;
            $class = self::CONTROLLERS_NAMESPACE  . $class;
            if (class_exists($class)) {
                $class = new $class;
                if (method_exists($class, $method)) {
                    return call_user_func_array([$class, $method], [$request, $pluginId]);
                }
            }
        }
        if (is_string($handler)) {
            [$class, $method] = explode('@', $handler);
            $class = self::CONTROLLERS_NAMESPACE . $class;
            if (class_exists($class)) {
                
                $class = new $class;
                if (method_exists($class, $method)) {
                    return call_user_func_array([$class, $method], [$request, $pluginId]);
                }
            }
        }
        if (is_callable($handler)) {   
            return call_user_func_array($handler, [$request, $pluginId]);
        }
    }
}
