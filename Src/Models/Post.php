<?php

namespace Plugin\JtlShopStarterKite\Src\Models;

class Post extends Model
{
    protected $table    = 'posts';
    
    protected $primaryKey  = 'id';

    protected $fillable = [
        'title',
        'body'
    ]; 
}