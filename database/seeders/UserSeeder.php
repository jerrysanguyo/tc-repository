<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User; 

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'email'             =>  'jsanguyo1624@gmail.com',
            'password'          => bcrypt('admin1234'),
            'contact_number'    => '09271852710',
            'role'              => 'superadmin',
            'is_verified'       =>  1, 
            'email_verified_at' => now(),
        ]);
    }
}
