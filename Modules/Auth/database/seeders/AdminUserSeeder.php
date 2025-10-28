<?php

namespace Modules\Auth\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Admin User
        $admin = User::create([
            'name' => 'Admin Valorent',
            'email' => 'admin@valorent.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        // Create Admin Profile
        $admin->profile()->create([
            'phone' => '081234567890',
            'address' => 'Jakarta, Indonesia',
            'birth_date' => '1990-01-01',
        ]);

        // Create Sample Regular User
        $user = User::create([
            'name' => 'John Doe',
            'email' => 'user@valorent.com',
            'password' => Hash::make('user123'),
            'role' => 'user',
            'email_verified_at' => now(),
        ]);

        // Create User Profile
        $user->profile()->create([
            'phone' => '081234567891',
            'address' => 'Bandung, Indonesia',
            'birth_date' => '1995-05-15',
        ]);
    }
}
