<?php

namespace Plugin\JtlShopPluginStarterKit\Src\Requests;

use Plugin\JtlShopPluginStarterKit\Src\Traits\ValidationTrait;
use Plugin\JtlShopPluginStarterKit\Src\Support\Http\Request;

class ApiCredentialsUpdateRequest extends Request
{
    use ValidationTrait;

    public function rules()
    {
        return [
            'business_account' => 'required',
            'client_id' => 'required',
            'secret_key' => 'required',
        ];
    }
}
