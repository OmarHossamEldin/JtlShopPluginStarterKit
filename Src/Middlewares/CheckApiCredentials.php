<?php

namespace Plugin\JtlShopPluginStarterKit\Src\Middlewares;

use Plugin\JtlShopPluginStarterKit\Src\Helpers\Response;
use Plugin\JtlShopPluginStarterKit\Src\Support\Facades\Middleware\BaseMiddleware;
use Plugin\JtlShopPluginStarterKit\Src\Models\ApiCredentials;

class CheckApiCredentials
{
    public static function handle()
    {
            $credential     = new ApiCredentials;

            $searchForCredentials    = $credential->select('client_id')->get();

            if (empty($searchForCredentials)) {
                return Response::json([
                    'message' => 'Note: You have to store Api credentials first.',
                ], 422);
            }
        
    }
}
