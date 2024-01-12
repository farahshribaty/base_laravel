<?php

namespace Database\Factories;
use App\Models\Product;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Product::class;

    public function definition()
    {
        return [
            'category_id' => \App\Models\Category::factory(),
            'product_price' => $this->faker->randomFloat(2, 10, 100),
            'product_quantity' => $this->faker->randomNumber(2),
            'product_status' => $this->faker->randomElement(['active', 'inactive']),
            'product_main_image' => $this->faker->imageUrl(),
            'product_purchasing_count' => $this->faker->randomNumber(3),
        ];
    }
}
