<?php declare(strict_types=1);

namespace Plugin\JtlShopStarterKite;

use InvalidArgumentException;

/**
 * Class AdminRender
 * @package Plugin\JtlShopStarterKite
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
    public function renderPage(string $template, int $menuID, Object $smarty): string
    {
        $smarty->assign('menuID', $menuID);
        switch($template){
            case "All_Posts":       
                $template = 'post/index.tpl';
                break;
            default:
                throw new InvalidArgumentException('Cannot render tab ' . $template);
        }
        return $smarty->fetch($this->path . $template);
    }
}
