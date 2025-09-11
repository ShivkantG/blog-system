<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        //Admin
        if (!User::where('email', 'admin123@gmail.com')->exists()) {
            User::create([
                'name' => 'Admin',
                'email' => 'admin123@gmail.com',
                'password' => Hash::make('admin123'),
                'is_admin' => true,
            ]);
        }

        //  User
        if (!User::where('email', 'user123@gmail.com')->exists()) {
            User::create([
                'name' => 'Test User',
                'email' => 'user123@gmail.com',
                'password' => Hash::make('user123'),
                'is_admin' => false,
            ]);
        }
        if (!User::where('email', 'user456@gmail.com')->exists()) {
            User::create([
                'name' => 'Test User',
                'email' => 'user456@gmail.com',
                'password' => Hash::make('user456'),
                'is_admin' => false,
            ]);
        }
    }


}
