<?php

namespace MvcCore\Jtl\Models;

use Illuminate\Database\Eloquent\Model;

class ApiCredentials extends Model
{
    protected $table    = 'api_credentials';

    protected $primaryKey  = 'id';

    protected $fillable = [
        'business_account',
        'client_id',
        'secret_key'
    ];
}
