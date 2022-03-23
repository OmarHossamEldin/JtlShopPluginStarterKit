<?php

namespace Plugin\JtlShopPluginStarterKit\Src\Models;

use Plugin\JtlShopPluginStarterKit\Src\Database\Orm\Model;

class Post extends Model
{
    protected $table = 'tec_see_posts';

    protected $primaryKey  = 'id';

    protected $fillable = [
        'title',
        'body',
        'image_path'
    ];
}
