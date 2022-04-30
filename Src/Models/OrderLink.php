<?php

namespace Plugin\JtlShopPluginStarterKit\Src\Models;

use Plugin\JtlShopPluginStarterKit\Src\Database\Orm\Model;

class OrderLink extends Model
{
    protected $table    = 'tec_see_order_links';

    protected $primaryKey  = 'id';

    protected $fillable = [
        'order_id',
        'order_status',
        'order_link',
        'link_name',
        'order_method',
    ];
}
