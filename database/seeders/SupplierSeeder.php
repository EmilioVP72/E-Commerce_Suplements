<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class SupplierSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        DB::table('supplier')->insert([
            [
                'name' => $faker->company,
                'phone' => $faker->phoneNumber,
                'email' => $faker->unique()->safeEmail,
            ],
            [
                'name' => $faker->company,
                'phone' => $faker->phoneNumber,
                'email' => $faker->unique()->safeEmail,
            ],
        ]);
    }
}