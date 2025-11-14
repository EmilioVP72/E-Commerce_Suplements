<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CatalogSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('catalog')->insert([
            [
                'catalog' => 'Catálogo de Verano 2025',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'catalog' => 'Catálogo de Invierno 2025',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
