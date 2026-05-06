<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            TurmaSeeder::class,
            AulaSeeder::class,
        ]);

        User::updateOrCreate(
            ['email' => 'admin@unitimes.com'],
            [
                'name' => 'Administrador',
                'password' => Hash::make('password'),
                'is_admin' => true,
                'turma_id' => null,
            ]
        );
    }
}