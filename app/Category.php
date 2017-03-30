<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;
    protected $dates=['deleted_at'];
    protected $table='categories';
    protected $fillable=['name','parent_id'];
    protected $hidden=['pivot'];
    public function parent()
    {
        return $this->belongsTo(Category::class,'parent_id','id');
    }
    public function childs()
    {
        return $this->hasMany(Category::class,'parent_id','id');
    }
    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }

}