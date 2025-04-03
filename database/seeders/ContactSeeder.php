<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Contact;

class ContactSeeder extends Seeder
{

    public function run(): void
    {
        Contact::create([
            'user_id'=>2,
            'name'=>'Angela Martins',
            'contact'=>'123456789',
            'email'=>'angela@mail.com'
        ]);

        Contact::create([
            'user_id'=>2,
            'name'=>'Bruno Silva',
            'contact'=>'987654321',
            'email'=>'bruno@mail.com'
        ]);

        Contact::create([
            'user_id'=>2,
            'name'=>'Carla Oliveira',
            'contact'=>'456789123',
            'email'=>'carla@mail.com'
        ]);

        Contact::create([
            'user_id'=>3,
            'name'=>'Daniel Souza',
            'contact'=>'789123456',
            'email'=>'daniel@mail.com']);

        Contact::create([
            'user_id'=>3,
            'name'=>'Eduarda Lima',
            'contact'=>'321654987',
            'email'=>'eduarda@mail.com']);

        Contact::create([
            'user_id'=>3,
            'name'=>'Fernando Costa',
            'contact'=>'654987321',
            'email'=>'fernando@mail.com'
        ]);
    }
}
