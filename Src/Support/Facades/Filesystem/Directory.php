<?php

namespace Plugin\JtlShopPluginStarterKit\Src\Support\Facades\Filesystem;

class Directory
{
    public static function get_root(): string
    {
        return $_SERVER['DOCUMENT_ROOT'];
    }

    public static function get_resources(): string
    {
        return self::get_root()  . '/plugins/JtlShopPluginStarterKit/Src/Resources';
    }
}
