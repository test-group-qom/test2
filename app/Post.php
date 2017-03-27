<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';
    protected $fillable = ['title','user_id' ,'text'];
    
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function person()
    {
        return $this->belongsTo(User::class);
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
    public function files()
    {
        return $this->belongsToMany(File::class);
    }
    
}