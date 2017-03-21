<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $table='persons';
    protected $fillable=['name','mail','password','token','access'];
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
