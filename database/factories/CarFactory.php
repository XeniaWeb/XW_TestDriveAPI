<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Car>
 */
class CarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $brands = ['Audi', 'Acura', 'Alfa Romeo', 'Opel', 'Nissan', 'Toyota', 'Ford', 'Mercedes', 'Renault', 'Volvo'];

        return [
            'brand' => $this->faker->randomElement($brands),
            'model' => $this->faker->text(15),
            'age_year' => random_int(1950, 2022),
        ];
    }
}
