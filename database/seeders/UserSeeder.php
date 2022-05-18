<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Bambang Pamungkas',
            'username' => 'administrator',
            'email' => 'admin@mail.com',
            'password' => bcrypt('password'),
            'address' => 'Jl. Test 123',
            'phonenumber' => '082364732324',
            'jeniskelamin' => 'l',
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
            'is_admin' => 1,
        ]);
        User::create([
            'name' => 'User Pamungkas',
            'username' => 'user',
            'email' => 'user@mail.com',
            'password' => bcrypt('password'),
            'address' => 'Jl. Test 1234',
            'phonenumber' => '082364732324',
            'jeniskelamin' => 'p',
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
            'is_admin' => 0,
        ]);
    }
}