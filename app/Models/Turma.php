<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Turma extends Model
{
    use HasFactory;

    public function cursos()
    {
        return $this->hasMany(Curso::class);
    }

    public function alunos(){
        return $this->belongsToMany(Aluno::class);
    }
}
