<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        DB::table('brand')->insert([
            [
                'brand' => 'Optimum Nutrition',
                'id_supplier' => 1,
            ],
            [
                'brand' => 'MyProtein',
                'id_supplier' => 1,
            ],
            [
                'brand' => 'Dymatize',
                'id_supplier' => 2,
            ],
        ]);
    }
}