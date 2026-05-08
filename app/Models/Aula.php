<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Aula extends Model
{
    use HasFactory;

    protected $attributes = [
        'sala' => 'A definir',
        'carga_horaria' => 0,
        'limite_faltas' => 25,
    ];

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
