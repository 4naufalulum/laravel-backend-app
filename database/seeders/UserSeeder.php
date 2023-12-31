<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Faker\Guesser\Name;
use GuzzleHttp\Promise\Create;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory(20)->create();
        User::Create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'email_verified_at' => now(),
            'role' => 'admin',
            'phone' => '6281338156281',
            'bio' => 'flutter dev',
            'password' => Hash::make('000000'),
        ]);

        User::Create([
            'name' => 'Super Admin',
            'email' => 'superadmin@example.com',
            'email_verified_at' => now(),
            'role' => 'superadmin',
            'phone' => '6281338156282',
            'bio' => 'laravel dev',
            'password' => Hash::make('000000'),
        ]);
    }
}
