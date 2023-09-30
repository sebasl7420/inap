<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categoria extends Model
{
    use SoftDeletes;
    //UNA CATEGORIA A MUCHOS PRODUCTOS
    public function productos(){
        return $this->hasMany('App\Models\Producto');
    }
    

}
