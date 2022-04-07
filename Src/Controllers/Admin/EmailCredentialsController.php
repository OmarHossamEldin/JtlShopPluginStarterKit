<?php

namespace Plugin\JtlShopPluginStarterKit\Src\Controllers\Admin;

use Plugin\JtlShopPluginStarterKit\Src\Support\Http\Request;
use Plugin\JtlShopPluginStarterKit\Src\Helpers\Response;
use Plugin\JtlShopPluginStarterKit\Src\Models\EmailCredential;
use Plugin\JtlShopPluginStarterKit\Src\Requests\EmailCredentialStoreRequest;
use Plugin\JtlShopPluginStarterKit\Src\Requests\EmailCredentialUpdateRequest;
use JTL\Shop;
use Plugin\JtlShopPluginStarterKit\Src\Validations\Alerts;
use Plugin\JtlShopPluginStarterKit\Src\Support\Debug\Debugger;


class EmailCredentialsController
{
    public function index()
    {
        $smarty   = Shop::Smarty();
        $emailCredential     = new EmailCredential();
        $emailCredentials    = $emailCredential->select('id', 'email','mail_host', 'username', 'password', 'port')->get();
        $smarty->assign('emailCredentials', $emailCredentials);
    }


    public function store(EMailCredentialStoreRequest $request)
    {


        $validatedData = $request->validated();
        $emailCredential = new EmailCredential();

        $searchForExistedCredentials = $emailCredential->all();

        if (count($searchForExistedCredentials) >= 1) {
            Alerts::show('warning', ['Forbidden: You can only add one credential']);
        }
        $emailCredential = $emailCredential->create([
            'email' => $validatedData['email'],
            'mail_host' => $validatedData['mail_host'],
            'username' => $validatedData['username'],
            'password' => $validatedData['password'],
            'port' => $validatedData['port'],

        ]);

        return Response::json(["message" => "Record is created successfully"], 201);

    }

/*     public function update(EMailCredentialUpdateRequest $request)
    {
        $validatedData = $request->validated();
        $params = $request->get_route_params();
        $emailCredential = new EmailCredential();
        $emailCredential->update($validatedData, 'id');
        $emailCredential = $emailCredential->first($params['id']);
        return Response::json(['message' => 'Mail Credentials Update Successfully.', 'mail_host' => $emailCredential], 206);
    }

    public function destroy(Request $request)
    {
        $params = $request->get_route_params();
        $emailCredential = new EmailCredential();
        $emailCredential->delete('id');
        $emailCredential = $emailCredential->first($params['id']);
        return Response::json(['message' => 'Mail Credentials Deleted Successfully.'], 204);
    } */
}
