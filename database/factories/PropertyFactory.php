<?php

namespace Database\Factories;

use App\Models\Property;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Property>
 */
class PropertyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(4),
        'description' => fake()->paragraph(),
        'rent_fee' => fake()->numberBetween(100000, 1000000),
        'agency_fee' => fake()->numberBetween(100000, 1000000),
        'address' => fake()->address(),
         'city' => fake()->city(),
         'type_of_house' => fake()->word(),
         'number_of_bedrooms' => fake()->numberBetween(1,10),
          'number_of_bathrooms' => fake()->numberBetween(1,10),
           'number_of_parking_spaces' => fake()->numberBetween(1,10),
           'is_furnished' => fake()->boolean(),
           'is_available' => fake()->boolean(),
        // Add every NOT NULL column from your properties table
        ];
    }
}
