<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
      //\App\Models\Clients::factory(10)->create();
        $this->call([UsersTableSeeder::class]);
        $this->call([ConcoursTableSeeder::class]);
        $this->call([CentresTableSeeder::class]);
        $this->call([EcolesTableSeeder::class]);
        $this->call([MatieresTableSeeder::class]);
        $this->call([ParcoursTableSeeder::class]);
        $this->call([SallesTableSeeder::class]);
        $this->call([CandidatsTableSeeder::class]);
        $this->call([NotesTableSeeder::class]);
    }
}
