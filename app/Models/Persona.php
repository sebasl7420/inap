<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Persona extends Model
{
    use SoftDeletes;
    //MUCHAS PERSONAS UNA UNIDAD
    public function unidad(){
        return $this->belongsto('App\Models\Unidad');
    }

    //relacion con solicitud
    public function solicituds(){
        return $this->hasMany('App\Models\Solicitud');
    }

    public function usuario(){
        return $this->hasOne('App\Models\Usuario');
    }
}
