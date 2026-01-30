<?php

namespace Database\Seeders;

use App\Constants\UserRole;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void {
        $this->createAdminUser();
    }

    private function createAdminUser(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@vanhfco.com',
            'password' => Hash::make('password'),
            'role' => UserRole::ADMIN,
        ]);
    }
}
