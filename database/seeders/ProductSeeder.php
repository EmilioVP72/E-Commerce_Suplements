<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use App\Models\Brand;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $brands = Brand::pluck('id_brand')->toArray();

        DB::table('product')->insert([
            [
                'product' => 'Gold Standard 100% Whey',
                'photo' => 'default.png',
                'sale_price' => $faker->randomFloat(2, 50, 100),
                'purchase_price' => $faker->randomFloat(2, 30, 60),
                'description' => $faker->paragraph,
                'how_to_use' => $faker->sentence,
                'warning' => $faker->sentence,
                'id_brand' => $faker->randomElement($brands),
            ],
            [
                'product' => 'ISO 100 Hydrolyzed',
                'photo' => 'default.png',
                'sale_price' => $faker->randomFloat(2, 60, 120),
                'purchase_price' => $faker->randomFloat(2, 40, 70),
                'description' => $faker->paragraph,
                'how_to_use' => $faker->sentence,
                'warning' => $faker->sentence,
                'id_brand' => $faker->randomElement($brands),
            ],
        ]);
    }
}