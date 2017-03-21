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
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function person()
    {
        return $this->belongsTo(Person::class);
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}