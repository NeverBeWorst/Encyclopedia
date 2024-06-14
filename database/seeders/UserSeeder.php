<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'login' => 'admin',
            'email' => 'rinat2004leshoz@gmail.com',
            'password' => '12345678',
            'role' => 'admin',
            'avatar' => 'admin.png',
            'about_me' => 'Пользователь для администрации и служебного персонала.',
            'status' => 'active',
        ]);
    }
}
