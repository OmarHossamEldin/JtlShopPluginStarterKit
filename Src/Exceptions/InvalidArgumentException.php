<?php

namespace MvcCore\Jtl\Exceptions;

use MvcCore\Jtl\Support\Facades\Exception\ExceptionHandler;

class InvalidArgumentException extends ExceptionHandler
{
    protected $message = "check function parameter please";
}
