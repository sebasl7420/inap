<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Unidad extends Model
{
    use SoftDeletes;
    //una unidad a muchas personas
    public function personas(){
        return $this->hasMany('App\Models\Persona');
    }
}
