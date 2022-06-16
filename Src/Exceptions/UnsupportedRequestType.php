<?php

namespace MvcCore\Jtl\Exceptions;

use MvcCore\Jtl\Support\Debug\Debugger;

class UnsupportedRequestType extends \Exception
{
    protected $message = "Unsupported Request Type";

    public function __construct()
    {
        $debugger = new Debugger();
        $debugger->log($this->message);
    }
}
