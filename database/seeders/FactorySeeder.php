<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Factory;

class FactorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            Factory::create([
                'line' => $i < 10 ? "X1_0" . $i : "X1_" . $i
            ]);
        }
        for ($i = 1; $i <= 10; $i++) {
            Factory::create([
                'line' => $i < 10 ? "X2_0" . $i : "X2_" . $i
            ]);
        }
    }
}
