<?php

namespace MvcCore\Jtl\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    protected $primaryKey  = 'id';

    protected $fillable = [
        'name',
        'description'
    ];

    public function posts()
    {
        return $this->hasMany(Post::class, 'tec_see_category_id');
    }
}
