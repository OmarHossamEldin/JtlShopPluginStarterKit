<?php

namespace MvcCore\Jtl\Exceptions;

use MvcCore\Jtl\Support\Debug\Debugger;

class DatabaseQueryException extends \Exception
{
    protected $message = "database query exception";

    public function __construct()
    {
        $debugger = new Debugger();
        $debugger->log($this->message);
    }
}
