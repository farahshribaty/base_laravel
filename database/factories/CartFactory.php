<?php

namespace Database\Factories;

use App\Models\Cart;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cart>
 */
class CartFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Cart::class;
    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween(1,20),
            'sub_total' => $this->faker->randomFloat(2, 10, 100),
            'delivery_fees' => $this->faker->randomFloat(2, 1, 10),
            'overall_total' => $this->faker->randomFloat(2, 20, 200),
            'cart_items_count' => $this->faker->randomNumber(),
        ];
    }
}
