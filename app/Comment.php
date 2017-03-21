<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table='comments';
    protected $fillable=['post_id','parent_id','text','from','mail'];
    public function childs()
    {
        return $this->hasMany(Comment::this,'parent_id','id');
    }
    public function parent()
    {
        return $this->belongsTo(Comment::childs(),'parent_id','id');
    }
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
