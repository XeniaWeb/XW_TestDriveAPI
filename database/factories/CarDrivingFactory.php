<?php

namespace Database\Factories;

use App\Models\Car;
use App\Models\Driver;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CarDriving>
 */
class CarDrivingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'driver_id' => Driver::factory(),
            'car_id' => Car::factory(),
            'start_drive' => $this->faker->dateTimeThisMonth(),
        ];
    }
}
