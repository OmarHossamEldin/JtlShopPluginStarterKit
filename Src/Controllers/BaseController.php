<?php

namespace Plugin\JtlShopStarterKite\Src\Controllers;

use Plugin\JtlShopStarterKite\Src\Support\RequestType;

class BaseController
{
    protected $request;

    public function __construct()
    {
        if(RequestType::get() === 'POST')
        {
            $this->request = array_map(fn($item) => $item, $_POST);
        }

        if(RequestType::get() === 'GET')
        {
            $this->request = array_map(fn($item) => $item, $_GET);
        }
    }    
}
