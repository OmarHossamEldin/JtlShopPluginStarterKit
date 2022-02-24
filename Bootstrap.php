<?php

declare(strict_types=1);

namespace Plugin\JtlShopPluginStarterKit;

use JTL\Events\Dispatcher;
use JTL\Link\LinkInterface;
use JTL\Plugin\Bootstrapper;
use JTL\Smarty\JTLSmarty;
use Plugin\JtlShopPluginStarterKit\Src\Services\InstallService;
use Plugin\JtlShopPluginStarterKit\Src\Services\RoutesService;

/**
 * Class Bootstrap
 * @package Plugin\JtlShopPluginStarterKit
 */
class Bootstrap extends Bootstrapper
{
    /**
     * @inheritdoc
     */
    public function boot(Dispatcher $dispatcher)
    {
        parent::boot($dispatcher);
    }

    /**
     * @inheritdoc
     */
    public function installed()
    {
        parent::installed();

        $withInstall = new InstallService;
        $withInstall->install();
    }

    /**
     * 
     * it's migrate database tables when plugin 
     */

    public function enabled()
    {
    }

    public function uninstalled(bool $deleteData = false)
    {
        if ($deleteData === true) {
            $deleteTables = new InstallService;
            $deleteTables->unInstall();
        }
    }
    /**
     * 
     * writing adminpanel routes for retriving data from database
     * @return string
     */
    public function renderAdminMenuTab(string $template, int $menuID, JTLSmarty $smarty): string
    {
        $routes = new RoutesService;
        $routes->adminRoutes($this->getPlugin());

        $render = new AdminRender($this->getPlugin());
        return $render->renderPage($template, $smarty);
    }

    /**
     * writing frontend routes for retrieving data from database
     */
    public function prepareFrontend(LinkInterface $link, JTLSmarty $smarty): bool
    {
        parent::prepareFrontend($link, $smarty);

        $routes = new RoutesService;
        $routes->frontEndRoutes($this->getPlugin());

        return true;
    }
}
