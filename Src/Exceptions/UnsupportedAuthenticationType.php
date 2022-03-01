<?php

namespace Plugin\JtlShopPluginStarterKit\Src\Exceptions;

class UnsupportedAuthenticationType extends \Exception
{
    protected $message = "Unsupported Authentication Type";
    
    public function __construct()
    {
        $debugger = new Debugger();
        $debugger->log($this->message);
    }
}
