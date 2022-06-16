<?php

namespace MvcCore\Jtl\Exceptions;

use MvcCore\Jtl\Support\Debug\Debugger;

class UnsupportedAuthenticationType extends \Exception
{
    protected $message = "Unsupported Authentication Type";
    
    public function __construct()
    {
        $debugger = new Debugger();
        $debugger->log($this->message);
    }
}
