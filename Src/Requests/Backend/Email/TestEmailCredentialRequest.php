<?php

namespace MvcCore\Jtl\Requests\Backend\Email;

use MvcCore\Jtl\Traits\ValidationTrait;
use MvcCore\Jtl\Support\Http\Request;

class TestEmailCredentialRequest extends Request
{
    use ValidationTrait;

    public string $type = 'form';
    
    public function rules()
    {
        return [
            'sender' => 'required',
            'reciever' => 'required',
        ];
    }
    
}
