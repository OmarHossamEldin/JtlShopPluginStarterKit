<?php

namespace Plugin\JtlShopPluginStarterKit\Src\Models;

use Plugin\JtlShopPluginStarterKit\Src\Database\Orm\Model;

class TokenParameter extends Model
{
    protected $table    = 'tec_see_token_parameters';

    protected $primaryKey  = 'id';

    protected $fillable = [
        'token_name',
        'token_type',
        'token_expiration',
    ];
}
