<?php

namespace MvcCore\Jtl\Exceptions;

use MvcCore\Jtl\Support\Debug\Debugger;

class RelationClassException extends \Exception
{
    protected $message = "Relation Class Exception";
    
    public function __construct()
    {
        $debugger = new Debugger();
        $debugger->log($this->message);
    }
}
