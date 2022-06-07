<?php

namespace MvcCore\Jtl\Requests\Backend\Email;

use MvcCore\Jtl\Traits\ValidationTrait;
use MvcCore\Jtl\Support\Http\Request;

class EmailCredentialStoreRequest extends Request
{
    use ValidationTrait;

    public string $type = 'form';
    
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
