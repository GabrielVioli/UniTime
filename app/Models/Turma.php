<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Turma extends Model
{
    protected $fillable = ['nome'];

    public function aulas()
    {
        return $this->hasMany(Aula::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}