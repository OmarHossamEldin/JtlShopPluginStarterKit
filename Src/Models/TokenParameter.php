<?php

namespace MvcCore\Jtl\Models;

use Illuminate\Database\Eloquent\Model;

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
