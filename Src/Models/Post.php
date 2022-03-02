<?php

namespace Plugin\JtlShopPluginStarterKit\Src\Models;

use Plugin\JtlShopPluginStarterKit\Src\Database\Initialization\Model;

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
