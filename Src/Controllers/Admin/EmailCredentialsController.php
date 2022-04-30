<?php

namespace Plugin\JtlShopPluginStarterKit\Src\Controllers\Admin;

use Plugin\JtlShopPluginStarterKit\Src\Support\Http\Request;
use Plugin\JtlShopPluginStarterKit\Src\Helpers\Response;
use Plugin\JtlShopPluginStarterKit\Src\Models\EmailCredential;
use Plugin\JtlShopPluginStarterKit\Src\Requests\EmailCredentialStoreRequest;
use Plugin\JtlShopPluginStarterKit\Src\Requests\EmailCredentialUpdateRequest;
use JTL\Shop;
use Plugin\JtlShopPluginStarterKit\Src\Database\Migrations\EmailCredentialsTable;
use Plugin\JtlShopPluginStarterKit\Src\Middlewares\CheckApiCredentials;
use Plugin\JtlShopPluginStarterKit\Src\Requests\deleteEmailCredentialsRequest;
use Plugin\JtlShopPluginStarterKit\Src\Requests\getEmailCredentialsRequest;
use Plugin\JtlShopPluginStarterKit\Src\Validations\Alerts;
use Plugin\JtlShopPluginStarterKit\Src\Support\Debug\Debugger;


class EmailCredentialsController
{
    public function index(Request $request)
    {
        $currentPage = isset($request->all()['page']) ? $request->all()['page'] : 1;
        $emailCredential     = new EmailCredential();
        $emailCredentials    = $emailCredential->select(
            'id',
            'email',
            'mail_host',
            'username',
            'password',
            'port',
        )->paginate(10, $currentPage);

        return Response::json($emailCredentials, 200);
    }


    public function store(EMailCredentialStoreRequest $request)
    {


        $validatedData = $request->validated();
        $emailCredentials = new EmailCredential();

        $searchForExistedCredentials = $emailCredentials->all();

        if (count($searchForExistedCredentials) >= 1) {
            Alerts::show('warning', ['Forbidden: You can only add one credential']);
        }
        $emailCredentials->create([
            'email' => $validatedData['email'],
            'mail_host' => $validatedData['mail_host'],
            'username' => $validatedData['username'],
            'password' => $validatedData['password'],
            'port' => $validatedData['port'],
        ])->first();
        return Response::json([
            'message' => 'email Credentials is created successfully',
            'emailCredentials' => $emailCredentials,
        ], 201);
    }

    /**
     * update a post
     *
     * @param EMailCredentialUpdateRequest $request
     * @param integer $pluginId
     * @return void
     */
    public function update(EMailCredentialUpdateRequest $request)
    {

        $validatedData = $request->validated();
        $params = $request->get_route_params();
        $emailCredentials = new EmailCredential();
        $emailCredentials = $emailCredentials->update([
            'email' => $validatedData['email'],
            'mail_host' => $validatedData['mail_host'],
            'username' => $validatedData['username'],
            'password' => $validatedData['password'],
            'port' => $validatedData['port'],
        ], $params['id'])->first();
        return Response::json([
            'message' => 'email Credentials updated successfully',
            'emailCredentials' => $emailCredentials
        ], 206);
    }


    public function destroy(Request $request)
    {
        $params = $request->get_route_params();
        $emailCredential = new EmailCredential();
        $emailCredential->delete($params['id']);
        return Response::json([], 204);
    }
}
