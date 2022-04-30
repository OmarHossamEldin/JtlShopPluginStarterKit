<?php

namespace Plugin\JtlShopPluginStarterKit\Src\Requests;

use Plugin\JtlShopPluginStarterKit\Src\Traits\ValidationTrait;
use Plugin\JtlShopPluginStarterKit\Src\Support\Http\Request;

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
