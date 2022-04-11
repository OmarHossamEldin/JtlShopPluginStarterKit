<?php

namespace Plugin\JtlShopPluginStarterKit\Src\Requests;

use Plugin\JtlShopPluginStarterKit\Src\Traits\ValidationTrait;
use Plugin\JtlShopPluginStarterKit\Src\Support\Http\Request;

class getCategoryDetailsRequest extends Request
{
    use ValidationTrait;
    
    public function rules()
    {
        return [
            'categoryId' => 'required',
        ];
    }
    
}
