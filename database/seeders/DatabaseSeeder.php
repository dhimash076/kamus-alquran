<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash; // PENTING: Ini agar Hash::make bisa terbaca
use App\Models\User;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {


        // 2. BUAT AKUN ADMIN
        User::create([
            'name' => 'Dhimas Admin',
            'email' => 'dhimas@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'admin', 
        ]);

        // Tambahkan user biasa untuk tes feedback (Opsional)
        User::create([
            'name' => 'User',
            'email' => 'user@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'user',
        ]);
    }
}