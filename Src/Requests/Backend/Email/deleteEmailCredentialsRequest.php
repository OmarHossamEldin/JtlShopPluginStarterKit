<?php

namespace MvcCore\Jtl\Requests\Backend\Email;

use MvcCore\Jtl\Traits\ValidationTrait;
use MvcCore\Jtl\Support\Http\Request;

class deleteEmailCredentialsRequest extends Request
{
    use ValidationTrait;
    
    public function rules()
    {
        return [
            'emailCredentialId' => 'required',
        ];
    }
    
}
