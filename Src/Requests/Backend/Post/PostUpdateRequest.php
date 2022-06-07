<?php

namespace MvcCore\Jtl\Requests\Backend\Post\Requests;

use MvcCore\Jtl\Traits\ValidationTrait;
use MvcCore\Jtl\Support\Http\Request;

class PostUpdateRequest extends Request
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
