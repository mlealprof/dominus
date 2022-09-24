<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{
    use HasFactory;
    protected $table = "alunos";

    public function turmas(){
        return $this->belongsToMany(Turma::class);
    }
}
