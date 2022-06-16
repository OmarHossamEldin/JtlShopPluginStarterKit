<?php

namespace MvcCore\Jtl\Requests\Backend\Category;

use MvcCore\Jtl\Traits\ValidationTrait;
use MvcCore\Jtl\Support\Http\Request;

class CategoryStoreRequest extends Request
{
    use ValidationTrait;

    public string $type = 'form';
    
    public function rules()
    {
        return [
            'name' => 'required',
            'description' => 'required',
        ];
    }
    
}
