<?php

namespace MvcCore\Jtl\Requests\Backend\Category;

use MvcCore\Jtl\Traits\ValidationTrait;
use MvcCore\Jtl\Support\Http\Request;

class CategoryUpdateRequest extends Request
{
    use ValidationTrait;

    public string $type = 'form';
    
    public function rules()
    {
        return [
            'name' => 'required',
            'description' => 'nullable',
        ];
    }
    
}
