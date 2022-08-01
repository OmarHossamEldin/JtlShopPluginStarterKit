<?php

namespace MvcCore\Jtl\Validations;

use MvcCore\Jtl\Helpers\Redirect;
use JTL\Alert\Alert;
use JTL\Shop;

class Alerts
{
    public static function show(string $type, array $messages): void
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
        $alert = Shop::Container()->getAlertService();
        foreach ($messages as $key => $message) {
            $alert->addAlert($type, "$message", $key, [
                'dismissable' => true,
                'saveInSession' => true
            ]);
        }
        Redirect::back();
    }
}
