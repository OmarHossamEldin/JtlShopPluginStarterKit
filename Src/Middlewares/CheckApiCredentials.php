<?php

namespace Plugin\JtlShopPluginStarterKit\Src\Middlewares;

use Plugin\JtlShopPluginStarterKit\Src\Helpers\Response;
use Plugin\JtlShopPluginStarterKit\Src\Support\Facades\Middleware\BaseMiddleware;
use Plugin\JtlShopPluginStarterKit\Src\Models\ApiCredentials;
use Plugin\JtlShopPluginStarterKit\Src\Support\Debug\Debugger;
use Plugin\JtlShopPluginStarterKit\Src\Support\Http\Request;

class CheckApiCredentials
{
    public static function handle()
    {
        $request = new Request;
        $data = $request->all();

        if(!isset($data['page'])){
            $credential     = new ApiCredentials;

            $searchForCredentials    = $credential->select('client_id')->get();

            if (empty($searchForCredentials)) {
                return Response::json([
                    'message' => 'Note: You have to store Api credentials first.',
                ], 422);
            }
        }
        
    }
}
