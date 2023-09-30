<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Solicitud extends Model
{
    use SoftDeletes;
    public $timestamps = false;
    
    //relacion con producto
    public function productos(){
        return $this->belongsToMany('App\Models\Producto');
    }

    //relacion con personas
    public function persona(){
        return $this->belongsTo('App\Models\Persona');
    }

}
