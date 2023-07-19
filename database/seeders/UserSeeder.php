<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::query()->updateOrInsert([
            'username' => 'admin',
        ], [
            'password' => bcrypt('aA123456*'),
            'name' => 'کاربر مدیر'
        ]);
    }
}
