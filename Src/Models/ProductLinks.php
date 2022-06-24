<?php

namespace MvcCore\Jtl\Models;

use MvcCore\Jtl\Database\Initialization\Model;

class ProductLinks extends Model
{
    protected $table    = 'tec_see_product_links';

    protected $primaryKey  = 'id';

    protected $fillable = [
        'link',
        'type',
        'method',
        'product_id',
    ];
}
