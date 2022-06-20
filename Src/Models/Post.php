<?php

namespace MvcCore\Jtl\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'tec_see_posts';

    protected $primaryKey  = 'id';

    protected $fillable = [
        'title',
        'body',
        'tec_see_category_id',
        'quantity'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'tec_see_category_id');
    }
}
