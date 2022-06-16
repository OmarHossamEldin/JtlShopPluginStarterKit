<?php

namespace MvcCore\Jtl\Controllers\Admin;

use MvcCore\Jtl\Support\Http\Request;
use MvcCore\Jtl\Helpers\Response;
use MvcCore\Jtl\Models\EmailCredential;
use MvcCore\Jtl\Requests\Backend\Email\EmailCredentialStoreRequest;
use MvcCore\Jtl\Requests\Backend\Email\EmailCredentialUpdateRequest;
use JTL\Shop;
use MvcCore\Jtl\Database\Migrations\EmailCredentialsTable;
use MvcCore\Jtl\Middlewares\CheckApiCredentials;
use MvcCore\Jtl\Requests\Backend\Email\deleteEmailCredentialsRequest;
use MvcCore\Jtl\Requests\Backend\Email\getEmailCredentialsRequest;
use MvcCore\Jtl\Validations\Alerts;


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
