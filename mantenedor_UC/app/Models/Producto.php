<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Producto extends Model
{
    use SoftDeletes;

    // MUCHOS PRODUCTOS A UNA CATEGORIA
    public function categoria(){
        return $this->belongsTo('App\Models\Categoria');
    }

    //RELACION CON TABLA Ajuste UN PRODUCTO A MUCHOS AJUSTES
    public function ajustes(){
        return $this->hasMany('App\Models\Ajuste');
    }

    //RELACION CON TABLA solicitud MUCHOS PRODUCTOS  A MUCHAS SOLICITUDES
    public function solicituds(){
        return $this->belongsToMany('App\Models\Solicitud');
    }

}
 