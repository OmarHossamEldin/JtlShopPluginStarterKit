<?php

namespace MvcCore\Jtl\Models;

use Illuminate\Database\Eloquent\Model;

class ApiCredentials extends Model
{
    protected $table    = 'tec_see_api_credentials';

    protected $primaryKey  = 'id';

    protected $fillable = [
        'business_account',
        'client_id',
        'secret_key'
    ];
}
