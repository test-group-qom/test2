<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;
    protected $dates=['deleted_at'];
    protected $table='comments';
    protected $fillable=['post_id','parent_id','text','from','email'];
    protected $hidden=['post_id','parent_id','deleted_at','updated_at'];
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
