<?php

namespace Plugin\JtlShopPluginStarterKit\Src\Requests;

use Plugin\JtlShopPluginStarterKit\Src\Traits\ValidationTrait;
use Plugin\JtlShopPluginStarterKit\Src\Support\Http\Request;

class EmailCredentialUpdateRequest extends Request
{
    use ValidationTrait;

    public function rules()
    {
        return [
            'email' => 'required',
            'mail_host' => 'required',
            'username' => 'required',
            'password' => 'required',
            'port' => 'required'
        ];
    }
}