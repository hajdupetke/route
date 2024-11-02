<?php

namespace Database\Factories;

use App\Enums\AssignmentStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehicle>
 */
class AssignmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'start_address' => fake('hu_HU')->bigCity() . ' ' . fake('hu_HU')->streetAddress(),
            'delivery_address' => fake('hu_HU')->smallerCity() . ' ' . fake('hu_HU')->streetAddress(),
            'recipient_name' => fake('hu_HU')->name(),
            'recipient_phone_number' => fake('hu_HU')->phoneNumber(),
            'status' => AssignmentStatus::cases()[array_rand(AssignmentStatus::cases())]
        ];
    }
}
