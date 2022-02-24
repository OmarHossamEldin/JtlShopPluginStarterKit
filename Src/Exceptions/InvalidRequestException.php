<?php

namespace Plugin\JtlShopPluginStarterKit\Src\Exceptions;

class InvalidRequestException extends \Exception
{
    protected $message = "this request is not found";
}
