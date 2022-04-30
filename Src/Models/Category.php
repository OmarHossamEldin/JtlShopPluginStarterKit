<?php

namespace Plugin\JtlShopPluginStarterKit\Src\Models;

use Plugin\JtlShopPluginStarterKit\Src\Database\Orm\Model;

class Category extends Model
{
    protected $table = 'tec_see_categories';

    protected $primaryKey  = 'id';

    protected $fillable = [
        'name',
        'description',
        //'image_path'
    ];

    public function posts()
    {
        return $this->hasMany(Post::class, 'tec_see_category_id');
    }
}
