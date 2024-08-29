<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            "username" => "admin",
            "password" => Hash::make("admin@#")
        ]);
        User::create([
            "username" => "maymau",
            "password" => Hash::make("maymau@#")
        ]);
        User::create([
            "username" => "kehoach",
            "password" => Hash::make("kehoach@#")
        ]);
        User::create([
            "username" => "quandoc",
            "password" => Hash::make("quandoc@#")
        ]);
        User::create([
            "username" => "hoanthanh",
            "password" => Hash::make("hoanthanh@#")
        ]);
        User::create([
            "username" => "nguyenlieu",
            "password" => Hash::make("nguyenlieu@#")
        ]);
        User::create([
            "username" => "phulieu",
            "password" => Hash::make("phulieu@#")
        ]);
        User::create([
            "username" => "tocat",
            "password" => Hash::make("tocat@#")
        ]);
    }
}
