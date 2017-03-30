<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class File extends Model
{
    use SoftDeletes;
    protected $dates=['deleted_at'];
    protected $hidden=['pivot','created_at','updated_at'];
    protected $table='files';
    protected $fillable = ['name','extention','path'];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }
}
