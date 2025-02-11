<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = ['path', 'user_id'];
    public function imageable(){

        return $this->morphTo();
    }
}

