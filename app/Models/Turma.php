<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Turma extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'curso_id'];

    public function curso()
    {
        return $this->belongsTo(Curso::class);
    }

    public function aulas()
    {
        return $this->hasMany(Aula::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
