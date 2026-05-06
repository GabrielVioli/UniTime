<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aula extends Model
{
    protected $fillable = [
        'nome',
        'professor',
        'dia_semana',
        'horario_inicio',
        'horario_fim',
        'sala',
        'carga_horaria',
        'limite_faltas',
        'turma_id',
    ];

    public function turma()
    {
        return $this->belongsTo(Turma::class);
    }

    public function faltas()
    {
        return $this->hasMany(Falta::class);
    }
}