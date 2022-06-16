<?php

namespace MvcCore\Jtl\Support\Facades\Router;

class ParamsHandler
{
    private $reflection;

    public function __construct($class)
    {
        $this->reflection = new \ReflectionClass($class);
    }

    public function get_method_params($method, $pluginId): array
    {
        $methodParams = $this->reflection->getMethod($method)->getParameters();
        $initializedParams = [];
        foreach ($methodParams as $param) {
            // $parameterClassName = $param->getClass()->name;
            // $initializedParams[] = new $parameterClassName();
            $parameterClassName = $param->getType()->getName();
            if (class_exists($parameterClassName)) {
                $initializedParams[] = new $parameterClassName();
            } else {
                $initializedParams[] = $pluginId;
            }
        }
        unset($methodParams, $param);
        return $initializedParams;
    }
}
