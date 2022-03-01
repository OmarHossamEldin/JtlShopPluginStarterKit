<?php

namespace Plugin\JtlShopPluginStarterKit\Src\Exceptions;

use Plugin\JtlShopPluginStarterKit\Src\Support\Debug\Debugger;

class InvalidRequestException extends \Exception
{
    protected $message = "this request is not found";
    
    public function __construct()
    {
        $debugger = new Debugger();
        $debugger->log($this->message);
    }
}
