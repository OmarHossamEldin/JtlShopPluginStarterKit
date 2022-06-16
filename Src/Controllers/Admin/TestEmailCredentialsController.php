<?php

namespace MvcCore\Jtl\Controllers\Admin;

use MvcCore\Jtl\Support\Http\Request;
use MvcCore\Jtl\Models\EmailCredential;
use JTL\Shop;
use MvcCore\Jtl\Helpers\Response;
use MvcCore\Jtl\Mail\Mail;
use MvcCore\Jtl\Requests\Backend\Email\TestEmailCredentialRequest;
use MvcCore\Jtl\Validations\Alerts;


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
