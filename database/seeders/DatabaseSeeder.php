<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed default Admin User
        User::create([
            'name' => 'Administrator',
            'username' => 'admin',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'role' => 'admin',
            'status' => 'aktif',
        ]);

        // Seed default Regular User
        User::create([
            'name' => 'Test User',
            'username' => 'user',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'role' => 'user',
            'status' => 'aktif',
        ]);

        // Seed Signatories / PPTK
        $this->call([
            PenandatanganSeeder::class,
        ]);
    }
}
