<?php

namespace MvcCore\Jtl\Requests\Backend\Post;

use MvcCore\Jtl\Traits\ValidationTrait;
use MvcCore\Jtl\Support\Http\Request;

class PostDeleteRequest extends Request
{
    use ValidationTrait;

    public string $type = 'form';
    
    public function rules()
    {
        return [
            'postId' => 'required',
        ];
    }
    
}
