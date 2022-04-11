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
    public function index()
    {
        $smarty   = Shop::Smarty();
        $emailCredential     = new EmailCredential();
        $emailCredentials    = $emailCredential->select('id', 'email', 'mail_host', 'username', 'password', 'port')->get();
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

    /**
     * update a post
     *
     * @param EMailCredentialUpdateRequest $request
     * @param integer $pluginId
     * @return void
     */
    public function update(EMailCredentialUpdateRequest $request)
    {
        $checkCredentials = new CheckApiCredentials;
        $checkCredentials->handle();

        $validatedData = $request->validated();
        $post = new EmailCredential();
        $post->update([
            'email' => $validatedData['email'],
            'mail_host' => $validatedData['mail_host'],
            'username' => $validatedData['username'],
            'password' => $validatedData['password'],
            'port' => $validatedData['port'],
        ], $validatedData['emailCredentialId']);
        return Response::json([
            'message' => 'email credentials are updated successfully',
        ], 201);
    }

    
    public function destroy(deleteEmailCredentialsRequest $request)
    {
        $validatedData = $request->validated();
        $emailCredential = new EmailCredential();
        $emailCredential->delete($validatedData['emailCredentialId']);
        return Response::json(['message' => 'Mail Credentials Deleted Successfully.'], 204);
    }

    /**
     * get email data
     *
     * @param getCredentialRequest $request
     * @param integer $pluginId
     * @return void
     */
    public function getEmailCredentials(getEmailCredentialsRequest $request)
    {
        $validatedData = $request->validated();
        $credential = new EmailCredential();
        $credentialData = $credential->select('id', 'email', 'mail_host', 'username', 'password', 'port')
            ->where('id', $validatedData['emailCredentialId'])
            ->get();

        $emailCredential = (object)$credentialData[0];

        return Response::json([
            'emailCredential' => $emailCredential,
        ], 200);
    }
}
