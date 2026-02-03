<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'admin123',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin123'),
            'role_id' => '1',
            'is_active' => '1'
        ]);
        User::create([
            'name' => 'kasir123',
            'email' => 'kasir@gmail.com',
            'password' => bcrypt('kasir123'),
            'role_id' => '2',
            'is_active' => '1'
        ]);
        User::create([
            'name' => 'pekerja123',
            'email' => 'pekerja@gmail.com',
            'password' => bcrypt('pekerja123'),
            'role_id' => '3',
            'is_active' => '1'
        ]);
    }
}
