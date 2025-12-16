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
        $placeholderUrl = asset('images/logo_prov_1.png');
        $placeholderUrl2 = asset('images/logo_prov_2.png');

        DB::table('supplier')->insert([
            [
                'photo' => $placeholderUrl,
                'name' => $faker->company,
                'phone' => $faker->phoneNumber,
                'email' => $faker->unique()->safeEmail,
            ],
            [
                'photo' => $placeholderUrl2,
                'name' => $faker->company,
                'phone' => $faker->phoneNumber,
                'email' => $faker->unique()->safeEmail,
            ],
        ]);
    }
}