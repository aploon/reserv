<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Materiel>
 */
class MaterielFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nom' => $this->faker->company(),
            'description' => $this->faker->text(),
            'num_serie' => $this->faker->buildingNumber(),
            'qte' => rand(5, 50),
            'categorie_id' => rand(1, 6)
        ];
    }
}
