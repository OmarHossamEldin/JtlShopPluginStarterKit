<?php

namespace Plugin\JtlShopPluginStarterKit\Src\Exceptions;

class UnsupportedRequestType extends \Exception
{
    protected $message = "Unsupported Request Type";

    public function __construct()
    {
        $debugger = new Debugger();
        $debugger->log($this->message);
    }
}
