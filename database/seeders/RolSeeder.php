<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Rol;


class RolSeeder extends Seeder
{
    public function run(): void
    {
        Rol::firstOrCreate(
            ['rol' => 'Administrador']
        );
        
        Rol::firstOrCreate(
            ['rol' => 'Cliente']
        );
    }
}
