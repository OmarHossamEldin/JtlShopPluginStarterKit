<?php

namespace MvcCore\Jtl\Backend\Post\Requests;

use MvcCore\Jtl\Traits\ValidationTrait;
use MvcCore\Jtl\Support\Http\Request;

class PostStoreRequest extends Request
{
    use ValidationTrait;

    public string $type = 'form';
    
    public function rules()
    {
        return [
            'title' => 'required',
            'body' => 'nullable',
            'tec_see_category_id' => 'required'
        ];
    }
    
}
