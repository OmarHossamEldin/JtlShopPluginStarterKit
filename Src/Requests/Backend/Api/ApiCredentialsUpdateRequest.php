<?php

namespace MvcCore\Jtl\Requests\Backend\Api;

use MvcCore\Jtl\Traits\ValidationTrait;
use MvcCore\Jtl\Support\Http\Request;

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
