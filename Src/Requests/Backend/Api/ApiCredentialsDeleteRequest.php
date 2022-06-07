<?php

namespace MvcCore\Jtl\Backend\Api\Requests;

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
