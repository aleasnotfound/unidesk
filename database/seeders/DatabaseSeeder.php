<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Akun Admin
        User::create([
            'name' => 'Admin UniDesk',
            'email' => 'admin@unidesk.com',
            'password' => Hash::make('admin123'), // PW admin
        ]);
    }
}