<?php

namespace MvcCore\Jtl\Exceptions;

use MvcCore\Jtl\Support\Facades\Exception\ExceptionHandler;

class GrammarException extends ExceptionHandler
{
    protected $message = "please check your grammar";
}
