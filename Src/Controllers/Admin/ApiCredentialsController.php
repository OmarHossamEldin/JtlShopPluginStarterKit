<?php

namespace Plugin\JtlShopPluginStarterKit\Src\Controllers\Admin;

use Plugin\JtlShopPluginStarterKit\Src\Helpers\Redirect;
use Plugin\JtlShopPluginStarterKit\Src\Models\ApiCredentials;
use Plugin\JtlShopPluginStarterKit\Src\Models\TokenParameter;
use Plugin\JtlShopPluginStarterKit\Src\Requests\ApiCredentialsStoreRequest;
use Plugin\JtlShopPluginStarterKit\Src\Requests\ApiCredentialsUpdateRequest;
use Plugin\JtlShopPluginStarterKit\Src\Validations\Alerts;
use Plugin\JtlShopPluginStarterKit\Src\Support\Http\HttpRequest;
use Plugin\JtlShopPluginStarterKit\Src\Support\Http\Request;
use Plugin\JtlShopPluginStarterKit\Src\Support\Http\Server;
use JTL\Shop;
use Plugin\JtlShopPluginStarterKit\Src\Helpers\Response;
use Plugin\JtlShopPluginStarterKit\Src\Requests\ApiCredentialsDeleteRequest;
use Plugin\JtlShopPluginStarterKit\Src\Requests\getCredentialRequest;
use Plugin\JtlShopPluginStarterKit\Src\Support\Debug\Debugger;

class ApiCredentialsController
{
    public function index(Request $request)
    {
        $smarty   = Shop::Smarty();

        $currentPage = isset($request->all()['page']) ? $request->all()['page'] : 1;
        $credential     = new ApiCredentials;
        $credentials    = $credential->select(
            'id',
            'business_account',
            'client_id',
            'secret_key',
        )->paginate(10, $currentPage);

        return Response::json($credentials, 200);

    }

    public function store(ApiCredentialsStoreRequest $request)
    {
        $validatedData = $request->validated();

        $credential     = new ApiCredentials;
        $searchForExistedCredentials = $credential->all();

        if (count($searchForExistedCredentials) >= 1) {
            Alerts::show('warning', ['Forbidden: You can only add one credential']);
        //return Response::json(['message' => 'Credential is created successfully'], 201);

        }

        $username = $validatedData['client_id'];
        $password = $validatedData['secret_key'];
        $auth = base64_encode($username . ':' . $password);

        $curl = new HttpRequest("https://api-m.sandbox.paypal.com/v1/");

        $checkCredentials = $curl->post(
            "oauth2/token",
            "Basic",
            [
                "grant_type" => "client_credentials"
            ],
            [
                "Content-Type: application/x-www-form-urlencoded",
                "Authorization: Basic $auth",
            ]
        );
        
        if (isset($checkCredentials["error"])) {
            Alerts::show('warning', [$checkCredentials["error_description"]]);
        }

        $accessToken = $checkCredentials['access_token'];
        $tokenType = $checkCredentials['token_type'];
        $expiration = $checkCredentials['expires_in'];

        $tokenParameter = new TokenParameter;
        $tokenParameter->create([
            'token_name' => $accessToken,
            'token_type' => $tokenType,
            'token_expiration' => $expiration,
        ]);

        $credential->create(
            [
                'business_account' => $validatedData['business_account'],
                'client_id' => $validatedData['client_id'],
                'secret_key' => $validatedData['secret_key'],
            ]
        )->first();

        return Response::json([
            'message' => 'Credential is created successfully',
            'credential' => $credential,
        ], 201);

    }

    public function destroy(Request $request)
    {
        $params = $request->get_route_params();

        
        $tokenParameter = new TokenParameter;
        
        $searchForToken    = $tokenParameter
        ->select('id')
        ->orderBy('created_at', 'desc')->first();
        
        $tokenId = $searchForToken[0]->id;
        
        $tokenParameter->delete($tokenId);
        
        $credential     = new ApiCredentials;
        $credential->delete($params['id']);

        return Response::json([], 204);
    }


    public function update(ApiCredentialsUpdateRequest $request)
    {
        $validatedData = $request->validated();

        $params = $request->get_route_params();

        $credential     = new ApiCredentials;

        $username = $validatedData['client_id'];
        $password = $validatedData['secret_key'];
        $auth = base64_encode($username . ':' . $password);
        $curl = new HttpRequest('https://api-m.sandbox.paypal.com/v1/');

        $checkCredentials = $curl->post(
            'oauth2/token',
            'Basic',
            [
                'grant_type' => 'client_credentials'
            ],
            [
                "Content-Type: application/x-www-form-urlencoded",
                "Authorization: Basic $auth",
            ]
        );

        if (isset($checkCredentials['error'])) {
            Alerts::show('warning', ['Invalid: API credentials are invalid']);
        }

        $accessToken = $checkCredentials['access_token'];
        $tokenType = $checkCredentials['token_type'];
        $expiration = $checkCredentials['expires_in'];

        $tokenParameter = new TokenParameter;

        $searchForToken    = $tokenParameter
        ->select('id')
        ->orderBy('created_at', 'desc')->first();

        $tokenId = $searchForToken[0]->id;

        $tokenParameter->update([
            'token_name' => $accessToken,
            'token_type' => $tokenType,
            'token_expiration' => $expiration,
        ],$tokenId);

        $credential->update(
            [
                'business_account' => $validatedData['business_account'],
                'client_id' => $validatedData['client_id'],
                'secret_key' => $validatedData['secret_key'],
            ],
            $params['id']
        );
        return Response::json(['message' => 'Credential updated successfully', 'apiCredential' => $credential], 206);

    }
}
