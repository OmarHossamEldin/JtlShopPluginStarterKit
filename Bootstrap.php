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
        if (Shop::isFrontend()) {
            $routes = new RoutesService();
            $dispatcher->listen('shop.hook.' . \HOOK_IO_HANDLE_REQUEST, fn (array $args) => $routes->frontend_endpoints(), 1);
        }else{
            $routes = new RoutesService();
            $dispatcher->listen('shop.hook.' . \HOOK_IO_HANDLE_REQUEST_ADMIN, fn (array $args) => $routes->backend_endpoints(), 1);
        }
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
        $routes->backend_executions();

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
        $routes->frontend_executions();

        return true;
    }
}
