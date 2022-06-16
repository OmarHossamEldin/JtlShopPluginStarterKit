<?php

namespace MvcCore\Jtl\Exceptions;

class UnsupportedValidationRuleException extends \Exception
{
    protected $message = "Unsupported Validation Rule Has Been Used";

    public function __construct()
    {
        $debugger = new Debugger();
        $debugger->log($this->message);
    }
}
