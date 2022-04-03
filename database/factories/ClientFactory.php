<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Client::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $numCin = random_int(100, 200). ' ' .random_int(200, 300).' '.random_int(300, 400).' '.random_int(400, 500);
        return [
            'nom' => $this->faker->name,
            'adresse' => $this->faker->address,
            'phone' => $this->faker->phoneNumber,
            'fax' => '',
            'numCin' => $numCin,
            'dateCin' => 'xx/xx/xxxx',
            'lieuCin' => 'Unknow',
            'dateDuplicata' => '',
        ];
    }
}
