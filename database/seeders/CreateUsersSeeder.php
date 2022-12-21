<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
               'name'=>'Administrativo',
               'email'=>'administrativo@email.com',
               'cpf' => '12345678905',
               'type'=>0,
               'password'=> bcrypt('123456'),
            ],
            [
               'name'=>'Gestor',
               'email'=>'gestor@email.com',
               'cpf' => '12345678904',
               'type'=>1,
               'password'=> bcrypt('123456'),
            ],
        ];

        foreach ($users as $key => $user) {
            User::create($user);
        }
    }
}
