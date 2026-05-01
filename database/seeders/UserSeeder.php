<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory(5)->create();

        User::create([
            'name' => 'Host Utama',
            'email' => 'host@utama.com',
            'email_verified_at' => now(),
            'no_hp' => '081234567890',
            'password' => bcrypt('Plmoki09'),
            'role' => 'host',
        ]);

    }
}
