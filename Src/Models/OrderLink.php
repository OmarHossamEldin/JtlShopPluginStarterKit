<?php

namespace MvcCore\Jtl\Models;

use Illuminate\Database\Eloquent\Model;

class OrderLink extends Model
{
    protected $table    = 'order_links';

    protected $primaryKey  = 'id';

    protected $fillable = [
        'order_id',
        'order_status',
        'order_link',
        'link_name',
        'order_method',
    ];
}
