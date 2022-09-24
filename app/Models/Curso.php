<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;

    public function modulos(){
        return $this->hasMany(Modulo::class,'curso_id','id');
    }
}
