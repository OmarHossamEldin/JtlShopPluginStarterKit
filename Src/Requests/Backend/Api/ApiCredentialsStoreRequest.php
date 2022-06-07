<?php

namespace MvcCore\Jtl\Backend\Api\Requests;

use MvcCore\Jtl\Traits\ValidationTrait;
use MvcCore\Jtl\Support\Http\Request;

class ApiCredentialsStoreRequest extends Request
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
