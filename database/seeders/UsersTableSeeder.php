<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      \App\Models\User::create([
        'name' => 'Administrateur',
        'email' => 'admin@gmail.com',
        'login' => 'admin',
        'password' => bcrypt('password'),
        'type' => 'admin'
      ]);
        \App\Models\User::create([
        'name' => 'Contrôlleur',
        'email' => 'controle@gmail.com',
        'login' => 'controlleur',
        'password' => bcrypt('password'),
        'type' => 'controlleur'
      ]);
        \App\Models\User::create([
        'name' => 'Opérateur Saisie',
        'email' => 'os@gmail.com',
        'login' => 'operateur',
        'password' => bcrypt('password'),
        'type' => 'os'
      ]);
    }
}
