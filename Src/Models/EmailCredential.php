<?php

namespace Plugin\JtlShopPluginStarterKit\Src\Models;

use Plugin\JtlShopPluginStarterKit\Src\Database\Orm\Model;

class EmailCredential extends Model
{
    protected $table    = 'tec_see_email_credentials ';

    protected $primaryKey  = 'id';

    protected $fillable = [
        'email',
        'mail_host',
        'username',
        'password',
        'port'
    ];
}
