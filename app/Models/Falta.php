<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Falta extends Model
{
    protected $fillable = [
        'user_id',
        'aula_id',
        'quantidade',
        'presencas',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function aula()
    {
        return $this->belongsTo(Aula::class);
    }
}
