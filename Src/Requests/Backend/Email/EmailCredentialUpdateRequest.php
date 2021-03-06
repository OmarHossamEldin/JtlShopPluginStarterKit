<?php

namespace MvcCore\Jtl\Requests\Backend\Email;

use MvcCore\Jtl\Traits\ValidationTrait;
use MvcCore\Jtl\Support\Http\Request;

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