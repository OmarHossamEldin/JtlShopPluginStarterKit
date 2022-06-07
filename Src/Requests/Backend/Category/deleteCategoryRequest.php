<?php

namespace MvcCore\Jtl\Backend\Category\Requests;

use MvcCore\Jtl\Traits\ValidationTrait;
use MvcCore\Jtl\Support\Http\Request;

class deleteCategoryRequest extends Request
{
    use ValidationTrait;
    
    public function rules()
    {
        return [
            'categoryId' => 'required',
        ];
    }
    
}
