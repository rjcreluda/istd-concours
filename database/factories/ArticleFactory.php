<?php

namespace Database\Factories;

use App\Models\Article;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Article::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $stock_min = [10, 15];
        return [
            'nom' => $this->faker->name,
            'marque' => '',
            'description' => $this->faker->sentence(),
            'photo' => '',
            'stockMinimal' => $stock_min[random_int(0, 1)],
            'qte' => 0,
            'categorie_id' => '',
        ];
    }
}
