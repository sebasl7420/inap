<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ajuste extends Model
{
    // MUCHOS AJUSTES A UN PRODUCTO
    public function producto(){
        return $this->belongsto('App\Models\Producto');
    }

}
