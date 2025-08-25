<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        User::updateOrCreate(
            ['email' => 'pratikshya.gurung.xdezo@gmail.com'],
            [
                'first_name' => 'Super',
                'last_name' => 'Admin',
                'email' => 'pratikshya.gurung.xdezo@gmail.com',
                'password' => Hash::make('admin1234567'),
                'role' => 'admin',
            ]
        );
    }
}
