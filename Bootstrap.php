<?php

declare(strict_types=1);

namespace Plugin\JtlShopPluginStarterKit;

use JTL\Events\Dispatcher;
use JTL\Link\LinkInterface;
use JTL\Plugin\Bootstrapper;
use JTL\Smarty\JTLSmarty;
use MvcCore\Jtl\Services\InstallService;
use MvcCore\Jtl\Services\RoutesService;
use Shop;

require_once __DIR__ . '/vendor/autoload.php';
/**
 * Class Bootstrap
 * @package Plugin\JtlShopPluginStarterKit
 */
class Bootstrap extends Bootstrapper
{
    private RoutesService $routesService;
    private InstallService $installService;
    /**
     * @inheritdoc
     */
    public function boot(Dispatcher $dispatcher)
    {
        parent::boot($dispatcher);
        $this->routesService = new RoutesService();
        $this->installService = new InstallService();
        if (Shop::isFrontend()) {
            $dispatcher->listen('shop.hook.' . \HOOK_IO_HANDLE_REQUEST, fn (array $args) => $this->routesService->frontend_endpoints(), 1);
            $dispatcher->listen('shop.hook.' . \HOOK_SMARTY_FETCH_TEMPLATE, fn () => $this->routesService->frontend_executions(), 1);
        } else {
            $dispatcher->listen('shop.hook.' . \HOOK_IO_HANDLE_REQUEST_ADMIN, fn (array $args) => $this->routesService->backend_endpoints(), 1);
        }
    }

    /**
     * @inheritdoc
     */
    public function installed()
    {
        parent::installed();
        $this->installService = new InstallService();
        $this->installService->install();
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
            $this->installService = new InstallService();
            $this->installService->unInstall();
        }
    }
    /**
     * 
     * writing adminpanel routes for retriving data from database
     * @return string
     */
    public function renderAdminMenuTab(string $template, int $menuID, JTLSmarty $smarty): string
    {
        $this->routesService->backend_executions();
        $adminRender = new AdminRender($this->getPlugin());
        return $adminRender->renderPage($template, $smarty);
    }

    /**
     * writing frontend routes for retrieving data from database
     */
    public function prepareFrontend(LinkInterface $link, JTLSmarty $smarty): bool
    {
        parent::prepareFrontend($link, $smarty);
        return true;
    }
}
