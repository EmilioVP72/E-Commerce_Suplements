<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Supplier;
use Faker\Factory as Faker;

class PurchaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $supplierIds = Supplier::pluck('id_supplier')->toArray();

        foreach (range(1, 10) as $index) {
            DB::table('purchase')->insert([
                'id_supplier' => $faker->randomElement($supplierIds),
                'total' => $faker->randomFloat(2, 100, 5000),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
