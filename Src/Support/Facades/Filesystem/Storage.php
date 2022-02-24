<?php

namespace Plugin\JtlShopPluginStarterKit\Src\Support\Facades\Filesystem;

class Storage
{
    public static function load_resources()
    {
        $loadingPathFrom = Directory::get_resources();
        $loadingPathTo = Directory::get_root() . '/mediafiles/Resources';
        exec("cp -r $loadingPathFrom $loadingPathTo");
    }

    public static function unload_resources()
    {
        $unLoadingPath = Directory::get_root() . '/mediafiles/Resources';
        exec("rm -r $unLoadingPath");
    }
}