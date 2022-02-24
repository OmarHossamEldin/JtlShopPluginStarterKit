<?php

namespace Plugin\JtlShopPluginStarterKit\Src\Validations;

use Plugin\JtlShopPluginStarterKit\Src\Helpers\Redirect;
use JTL\Alert\Alert;
use JTL\Shop;

class Alerts
{
    public static function show(String $type, String $message, String $key)
    {
        switch ($type) {
            case 'warning':
                $type = Alert::TYPE_WARNING;
                break;
            case 'info':
                $type = Alert::TYPE_INFO;
                break;
            case 'light':
                $type = Alert::TYPE_LIGHT;
                break;
            case 'dark':
                $type = Alert::TYPE_DARK;
                break;
            case 'success':
                $type = Alert::TYPE_SUCCESS;
                break;
            case 'danger':
                $type = Alert::TYPE_DANGER;
                break;
            default:
                $type = Alert::TYPE_PRIMARY;
                break;
        }
        $alertHelper = Shop::Container()->getAlertService();
        $alertHelper->addAlert($type, "$key $message", $key, [
            'dismissable' => true,
            'saveInSession'=> true
        ]);
        Redirect::to($_SERVER['REQUEST_URI']);
    }
}
