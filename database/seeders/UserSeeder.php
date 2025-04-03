<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;

class UserSeeder extends Seeder
{

    public function run(): void
    {
        User::create([
            'name'=>'admin',
            'email'=>'admin@mail.com',
            'password'=>bcrypt('admin@123')
        ]);

        User::create([
            'name'=>'Lucas Gabriel',
            'email'=>'lucas@gmail.com',
            'password'=>bcrypt('Lucas@123')
        ]);

        User::create([
            'name'=>'Ana Raquel',
            'email'=>'ana@gmail.com',
            'password'=>bcrypt('ana@123')
        ]);
    }
}
