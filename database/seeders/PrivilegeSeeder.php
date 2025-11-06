<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Privilege;


class PrivilegeSeeder extends Seeder
{
    public function run(): void
    {
        Privilege::firstOrCreate(
            ['privilege' => 'Administrador'],
            ['description' => 'Administrador del sistema web']
        );
        
        Privilege::firstOrCreate(
            ['privilege' => 'Cliente'],
                ['description' => 'Cliente estandar del sistema web']
        );
    }
}
