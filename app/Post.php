<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;
    protected $dates=['deleted_at'];
    protected $table = 'posts';
    protected $fillable = ['title','user_id' ,'text'];
    protected $hidden=['pivot'];
    
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function user()
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