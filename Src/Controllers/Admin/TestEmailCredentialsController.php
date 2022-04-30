<?php

namespace Plugin\JtlShopPluginStarterKit\Src\Controllers\Admin;

use Plugin\JtlShopPluginStarterKit\Src\Support\Http\Request;
use Plugin\JtlShopPluginStarterKit\Src\Models\EmailCredential;
use JTL\Shop;
use Plugin\JtlShopPluginStarterKit\Src\Helpers\Response;
use Plugin\JtlShopPluginStarterKit\Src\Mail\Mail;
use Plugin\JtlShopPluginStarterKit\Src\Requests\TestEmailCredentialRequest;
use Plugin\JtlShopPluginStarterKit\Src\Validations\Alerts;


class TestEmailCredentialsController
{
    public function index()
    {
    }


    public function testEmailCredentials(TestEmailCredentialRequest $request)
    {

        $validatedData = $request->validated();

        $emailCredential = new EmailCredential();
        $emailCredentials = $emailCredential->select('mail_host', 'username')->get();

        if (!!$emailCredentials === false) {
            Alerts::show('warning', ['Please enter your email credentials']);
        }

        $mail = new Mail;
        $testEmail = $mail->sendTestEmail($validatedData['sender'], $validatedData['reciever']);
        //Here send test email

        $message = $testEmail['message'];
        $status = $testEmail['status'];

        return Response::json(["message" => "$message"], $status);
    }
}
