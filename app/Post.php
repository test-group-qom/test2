<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';
    protected $fillable = ['title', 'text'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}