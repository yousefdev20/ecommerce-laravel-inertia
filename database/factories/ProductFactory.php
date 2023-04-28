<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     * @throws \Exception
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'description' => $this->faker->paragraph(2),
            'price' => $this->faker->randomFloat(2, 50, 5000),
            'image' => 'images/products/0'. random_int(1, 8) . '.jpeg',
            'status' => $this->faker->boolean(90),
        ];
    }
}
