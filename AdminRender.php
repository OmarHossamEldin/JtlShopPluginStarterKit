<?php

declare(strict_types=1);

namespace Plugin\JtlShopPluginStarterKit;

use InvalidArgumentException;
use JTL\Smarty\JTLSmarty;

/**
 * Class AdminRender
 * @package Plugin\JtlShopPluginStarterKit
 */
class AdminRender
{
    /**
     * @var path
     */
    private $plugin;

    /**
     * @var path
     */
    private $path;

    /**
     * AdminRender constructor.
     * @param Object $plugin
     */
    public function __construct(Object $plugin)
    {
        $this->plugin = $plugin;
        $this->path   = $this->plugin->getPaths()->getAdminPath() . '/templates/';
    }

    /**
     * @param string    $template
     * @param int       $menuID
     * @param Object $smarty
     * @return string
     * @throws \SmartyException
     */
    public function renderPage(string $template, JTLSmarty $smarty): string
    {
        $smarty->assign('pluginPath', $this->plugin->getPaths()->getAdminURL());
        switch ($template) {
            case "All_Posts":
                $template = 'post/layout.tpl';
                break;
            default:
                throw new InvalidArgumentException('Cannot render tab ' . $template);
        }
        return $smarty->fetch($this->path . $template);
    }
}
