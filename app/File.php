<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    public function person()
    {
        return $this->belongsTo(Person::class);
    }
}
