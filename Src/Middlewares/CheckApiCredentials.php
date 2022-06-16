<?php

namespace MvcCore\Jtl\Middlewares;

use MvcCore\Jtl\Helpers\Response;
use MvcCore\Jtl\Support\Facades\Middleware\BaseMiddleware;
use MvcCore\Jtl\Models\ApiCredentials;
use MvcCore\Jtl\Support\Debug\Debugger;
use MvcCore\Jtl\Support\Http\Request;

class CheckApiCredentials
{
    public static function handle()
    {
        $request = new Request;
        $data = $request->all();

        if(count($data) > 3){
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
