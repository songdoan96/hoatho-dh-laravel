<?php

namespace Database\Seeders;

use App\Models\Factory;
use Illuminate\Database\Seeder;

class FactorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            Factory::create([
                'line' => $i < 10 ? "XN1_0" . $i : "XN1_" . $i
            ]);
        }
        for ($i = 1; $i <= 10; $i++) {
            Factory::create([
                'line' => $i < 10 ? "XN2_0" . $i : "XN2_" . $i
            ]);
        }
    }
}
