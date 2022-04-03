<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Centre;

class CentresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $centres = [
        ['lieu' => 'Antsiranana', 'code' => '00'],
        ['lieu' => 'Antanarivo', 'code' => '01'],
        ['lieu' => 'Mahajanga', 'code' => '03'],
        ['lieu' => 'Ambanja', 'code' => '06'],
        ['lieu' => 'Sambava', 'code' => '02'],
        ['lieu' => 'Tamatave', 'code' => '04'],
        ['lieu' => 'Ambositra', 'code' => '05'],
        ['lieu' => 'Toliara', 'code' => '07']
      ];
      foreach($centres as $centre){
        Centre::create([
          'lieu' => $centre['lieu'],
          'code' => $centre['code']
        ]);
      }
    }
}
