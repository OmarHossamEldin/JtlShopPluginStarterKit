<?php declare(strict_types=1);

namespace Plugin\JtlShopStarterKite;

use JTL\Events\Dispatcher;
use JTL\Link\LinkInterface;
use JTL\Plugin\Bootstrapper;
use JTL\Smarty\JTLSmarty;
use Plugin\JtlShopStarterKite\AdminRender;
use Plugin\JtlShopStarterKite\Src\Database\Migrations\PostsTable;
use Plugin\JtlShopStarterKite\Src\Support\Route;

/**
 * Class Bootstrap
 * @package Plugin\JtlShopStarterKite
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

        $postsTable = new PostsTable;
        $postsTable->up();
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
            $postsTable = new PostsTable;
            $postsTable->down();
        }
    }
    /**
     * 
     * writing adminpanel routes for retriving data from database
     * @return string
     */
    public function renderAdminMenuTab(string $template, int $menuID, JTLSmarty $smarty): string
    {
        Route::get('PostController@index', $smarty);
        
        $render = new AdminRender($this->getPlugin());
        return $render->renderPage($template, $menuID, $smarty);
    }

    /**
     * writing frontend routes for retrieving data from database
     */
    public function prepareFrontend(LinkInterface $link, JTLSmarty $smarty): bool
    {
        // Route::group(['VerifyAjaxRequest'], [
        //     ''
        // ]);

        parent::prepareFrontend($link, $smarty);
        return true;
    }
}
