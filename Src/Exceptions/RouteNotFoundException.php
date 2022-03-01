<?php

namespace Plugin\JtlShopPluginStarterKit\Src\Exceptions;

use Plugin\JtlShopPluginStarterKit\Src\Support\Debug\Debugger;

class RouteNotFoundException extends \Exception
{
    protected $message = "This route is not found";
    
    public function __construct()
    {
        $debugger = new Debugger();
        $debugger->log($this->message);
    }
}
