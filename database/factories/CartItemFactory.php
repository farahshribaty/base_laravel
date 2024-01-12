<?php

namespace Database\Factories;

use App\Models\CartItem;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CartItem>
 */
class CartItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = CartItem::class;

    public function definition()
    {
        return [
            'cart_id' => $this->faker->numberBetween(1,20),
            'product_id' => $this->faker->numberBetween(1,20),
            'quantity' => $this->faker->randomNumber(),
        ];
    }
}
