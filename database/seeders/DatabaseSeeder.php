<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::query()->delete();

        // Buat user Admin
        User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'phone' => '081234567890',
            'address' => 'Surabaya',
        ]);

        // Buat user Checker
        User::create([
            'name' => 'Checker User',
            'email' => 'checker@gmail.com',
            'password' => Hash::make('checker123'),
            'role' => 'checker',
            'phone' => '081234567891',
            'address' => 'Surabaya',
        ]);
    }
}
