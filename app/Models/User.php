<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'turma_id',
        'is_admin',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function turma()
    {
        return $this->belongsTo(Turma::class);
    }

    public function faltas()
    {
        return $this->hasMany(Falta::class);
    }

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_admin' => 'boolean',
            'turma_id' => 'integer',
        ];
    }
}