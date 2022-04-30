<?php

namespace Plugin\JtlShopPluginStarterKit\Src\Support\Facades\Filesystem;

class DirectoryComposer
{
    private string $pluginRoot;

    private string $shopRoot;

    private const LEVEL_TO_BACK_PLUGIN_PATH = 5;

    private const LEVEL_TO_BACK_SHOP_PATH = 7;

    public function __construct()
    {
        $this->pluginRoot = dirname(__FILE__, self::LEVEL_TO_BACK_PLUGIN_PATH);

        $this->shopRoot = dirname(__FILE__, self::LEVEL_TO_BACK_SHOP_PATH);
    }
    

    public function resources_root(): string
    {
        return "$this->pluginRoot/Src/Resources";
    }

    public function plugin_root(): string
    {
        return "$this->pluginRoot";
    }

    public function get_mediaFiles(): string
    {
        return "$this->shopRoot/mediafiles/";
    }

    public function get_logs(): string
    {
        return "$this->pluginRoot/Logs/";
    }
}
