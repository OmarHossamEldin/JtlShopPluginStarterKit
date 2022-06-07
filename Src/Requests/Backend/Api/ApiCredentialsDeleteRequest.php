<?php

namespace MvcCore\Jtl\Requests\Backend\Api;

use MvcCore\Jtl\Traits\ValidationTrait;
use MvcCore\Jtl\Support\Http\Request;

class ApiCredentialsDeleteRequest extends Request
{
    use ValidationTrait;

    public function rules()
    {
        return [
            'apiCredentialId' => 'required',
        ];
    }
}
