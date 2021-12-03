<?php

namespace Plugin\JtlShopStarterKite\Src\Helpers;

class Response 
{
    public static function json($data, $statusCode=200)
    {
        header('Content-Type: application/json; charset=utf-8');
        http_response_code($statusCode);
        return json_encode($data);
    }
}