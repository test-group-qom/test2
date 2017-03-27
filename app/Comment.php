<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table='comments';
    protected $fillable=['post_id','parent_id','text','from','email'];
    public function childs()
    {
        return $this->hasMany(Comment::class,'parent_id','id');
    }
    public function parent()
    {
        return $this->belongsTo(Comment::class,'parent_id','id');
    }
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
