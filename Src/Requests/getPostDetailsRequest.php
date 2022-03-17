<?php

namespace Plugin\JtlShopPluginStarterKit\Src\Requests;

use Plugin\JtlShopPluginStarterKit\Src\Traits\ValidationTrait;
use Plugin\JtlShopPluginStarterKit\Src\Support\Http\Request;

class getPostDetailsRequest extends Request
{
    use ValidationTrait;
    
    public function rules()
    {
        return [
            'post_id' => 'required',
        ];
    }
    
}
