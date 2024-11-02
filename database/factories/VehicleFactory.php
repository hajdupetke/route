<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehicle>
 */
class VehicleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        fake()->addProvider(new \Faker\Provider\FakeCar(fake()));
        $vehicle_array = fake()->vehicleArray();

        return [
            'license_plate' => strtoupper(fake()->lexify('???')) . '-' . fake()->numerify('###'),
            'brand' => $vehicle_array['brand'],
            'model' => $vehicle_array['model'],
        ];
    }
}
