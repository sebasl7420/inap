<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Usuario extends Authenticable
{
    use SoftDeletes;
    use Notifiable;
    protected $table = "usuarios";

    public function persona(){
        return $this->hasOne('App\Models\Persona');
    }
}
