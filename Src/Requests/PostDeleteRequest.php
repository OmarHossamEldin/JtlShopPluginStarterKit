<?php

namespace Plugin\JtlShopPluginStarterKit\Src\Requests;

use Plugin\JtlShopPluginStarterKit\Src\Traits\ValidationTrait;
use Plugin\JtlShopPluginStarterKit\Src\Support\Http\Request;

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
