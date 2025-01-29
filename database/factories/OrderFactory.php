<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'status_id' => 1,
            'user_id' => fake()->numberBetween(1, 30),
            'products' => $this->generateProducts(),
        ];
    }

    private function generateProducts(): array
    {
        $productsCount = fake()->numberBetween(1, 5);

        $products = [];

        for ($i = 0; $i < $productsCount; $i++) {
            $products[] = [
                'id' => fake()->numberBetween(1, 100),
                'title' => fake()->word(),
                'description' => fake()->sentence(),
                'cost' => fake()->randomFloat(2, 0, 10000),
                'count' => fake()->randomNumber(3),
            ];
        }

        return $products;
    }
}
