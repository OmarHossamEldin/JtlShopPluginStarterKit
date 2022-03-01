<?php

namespace Plugin\JtlShopPluginStarterKit\Src\Exceptions;

use Plugin\JtlShopPluginStarterKit\Src\Support\Debug\Debugger;

class UnsupportedAuthenticationType extends \Exception
{
    protected $message = "Unsupported Authentication Type";
    
    public function __construct()
    {
        $debugger = new Debugger();
        $debugger->log($this->message);
    }
}
