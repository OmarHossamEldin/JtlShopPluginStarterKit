<?php

namespace Plugin\JtlShopPluginStarterKit\Src\Controllers\Repository;

use Plugin\JtlShopPluginStarterKit\Src\Helpers\Response;
use Plugin\JtlShopPluginStarterKit\Src\Models\TokenParameter;
use Carbon\Carbon;
use Plugin\JtlShopPluginStarterKit\Src\Models\ApiCredentials;
use Plugin\JtlShopPluginStarterKit\Src\Support\Http\HttpRequest;

class CheckTokenExpiration
{

        public function check()
        {
                $tokenParameter = new TokenParameter;

                $searchForToken    = $tokenParameter
                        ->select('token_name', 'token_type', 'token_expiration', 'created_at')
                        ->orderBy('created_at', 'desc')->first();
                if (!!$searchForToken === false) {
                        return Response::json(['message' => 'settings of the plugin has to be set'], 422);
                }
                $expiry = $searchForToken[0]->token_expiration;
                $expiry = $expiry / 3600;
                $creationTime = $searchForToken[0]->created_at;


                $creationTime = Carbon::parse($creationTime);
                $currentTime = Carbon::now();
                $addedTime = $creationTime->addHours($expiry);

                $difference = $currentTime->diffInSeconds($addedTime, false);

                if ($difference < 0) {
                        $credential     = new ApiCredentials;
                        $credentials    = $credential->select('client_id', 'secret_key')->first();

                        $auth = base64_encode($credentials[0]->client_id . ':' . $credentials[0]->secret_key);
                        $curl = new HttpRequest('https://api-m.sandbox.paypal.com/v1/oauth2/token');

                        $checkCredentials = $curl->post(
                                'oauth2/token',
                                [
                                        'grant_type' => 'client_credentials'
                                ],
                                [
                                        "Content-Type: application/x-www-form-urlencoded",
                                        "Authorization: Basic $auth",
                                ],
                                'Basic'
                        );

                        $tokenParameter->create([
                                'token_name' => $checkCredentials['access_token'],
                                'token_type' => $checkCredentials['token_type'],
                                'token_expiration' => $checkCredentials['expires_in'],
                        ]);

                        $searchForToken[0]->token_name = $checkCredentials['access_token'];
                        $searchForToken[0]->token_type = $checkCredentials['token_type'];
                }

                $tokenName = $searchForToken[0]->token_name;
                $tokenType = $searchForToken[0]->token_type;

                return [
                        'tokenName' => $tokenName,
                        'tokenType' => $tokenType,
                ]; 
        }
}
