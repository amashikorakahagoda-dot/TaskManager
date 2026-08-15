<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DemoUserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Demo User',
            'email' => 'demo@example.com',
            'password' => Hash::make('password123'),
        ]);

        $this->command->info('Demo user created!');
        $this->command->info('Email: demo@example.com');
        $this->command->info('Password: password123');
    }
}